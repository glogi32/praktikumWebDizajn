<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AuthController extends FrontController
{
    public function login(LoginRequest $request){
        $email = $request->input("tbEmail");
        $password = md5($request->input("tbPassword"));

        $user = User::with("role")->where([
            ["email","=", $email],
            ["password","=", $password]])->first();



        if(!empty($user)){
            session()->put("user",$user);
            $this->log("User logged in successfully",$request);
            return redirect()->back();
        }else{
            $this->log("Error on user login",$request);
            return redirect()->back()->with("errorLogin", "Wrong email or password!");
        }
    }

    public function signUp(SignUpRequest $request){
        $user = new User;
        $user->first_name = $request->input("firstName");
        $user->last_name = $request->input("lastName");
        $user->password = md5($request->input("password"));
        $user->phone = $request->input("phone");
        $user->email = $request->input("email");



        $user->role_id = 2;


        DB::beginTransaction();
        $image = $request->file("userImage");
        $image_name = time()."_".$image->getClientOriginalName();
        $directory = \public_path()."/img/users";
        $path = "img/users/".$image_name;

        try{

            $uploadImage = $image->move($directory,$image_name);



            $insertUser = $user->save();
            $userId = $user->id;


            $imageModel = new Image();
            $imageModel->alt = $image_name;
            $imageModel->src = $path;
            $imageModel->imageable_id = $userId;
            $imageModel->imageable_type = "user";


            $insertUserImage = $imageModel->save();

        }catch (\Exception $e){
            \Log::error($e->getMessage());

            if(File::exists($path)) {
                File::delete($path);
            }

            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.")->withInput();
        }

        if($insertUser && $insertUserImage){
            DB::commit();
            $this->log("User signed up successfully",$request);
            return redirect()->back()->with("signUpSuccess","Successful sign up, u can login now!");
        }else{

            DB::rollBack();

            if(File::exists($path)) {

                File::delete($path);
            }
            $this->log("Error on user sign up",$request);
            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.")->withInput();
        }


    }

    public function logout(Request $request){
        $this->log("User logged out successfully",$request);
        session()->forget("user");

        return redirect("/");
    }
}
