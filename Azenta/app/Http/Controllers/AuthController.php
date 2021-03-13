<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login(LoginRequest $request){
        $email = $request->input("tbEmail");
        $password = $request->input("tbPassword");

        $user = $this->userModel->getByEmailAndPassword($email,$password);

        if($user){

            session()->put("user",$user);
            \LogActivity::addToLog($request,"User logged in successfully");
            return $user->role_id == "1" ? redirect("/admin/users") : redirect()->back();
        }else{
            \LogActivity::addToLog($request,"User failed log in");
            return redirect()->back()->with("errorLogin", "Wrong email or password!");
        }
    }


    public  function signUp(SignUpRequest $request){
        $firstName = $request->input("FirstName");
        $lastName = $request->input("LastName");
        $email = $request->input("Email");
        $password = $request->input("Password");


        $roleId = 2;

        \DB::beginTransaction();
            try {
                $image = $request->file("userImage");
                $image_name = $image->getClientOriginalName()."_".time();
                $directory = \public_path()."/img/users";
                $image->move($directory,$image_name);


                $path = "img/users/".$image_name;

                $insertUserId = $this->userModel->insertUser($firstName, $lastName, $email, $password, $roleId);
                $insertImage = $this->userModel->insertUserImage($path, $image_name,$insertUserId);

            }
            catch (QueryException $e){
                \Log::error($e->getMessage());
                \LogActivity::addToLog($request,"New user failed signed up");
                return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.");
            }
        if($insertUserId && $insertImage){
            \DB::commit();
            \LogActivity::addToLog($request,"New user successfully signed up");
            return redirect()->back()->with("signUpSuccess","Successful sign up, u can login now!");
        }else{
            \DB::rollBack();
            \LogActivity::addToLog($request,"New user failed signed up");
            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.");
        }

    }

    public function logout(Request $request){
        \LogActivity::addToLog($request,"User logged out successfully");
        session()->forget("user");
        return redirect("/home");
    }
}
