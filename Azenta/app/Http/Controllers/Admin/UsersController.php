<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\RoleModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UsersController extends BackController
{
    private $userModel;
    private $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = $this->userModel->getAllUsersWithRoles();

        return view("admin/pages/users",$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = "insert";

        $this->data['roles'] = $this->roleModel->getAll();
        return view("admin/pages/users",$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignUpRequest $request)
    {
        $firstName = $request->input("FirstName");
        $lastName = $request->input("LastName");
        $email = $request->input("Email");
        $password = $request->input("Password");
        $roleId = $request->input("Roles");



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
            \LogActivity::addToLog($request,"User failed adding new user!");
            \DB::rollBack();
            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.");
        }
        if($insertUserId && $insertImage){

            \DB::commit();
            \LogActivity::addToLog($request,"User successfully added new user!");
            return redirect()->back()->with("signUpSuccess","User added successfully!");
        }else{
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed adding new user!");
            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['form'] = "edit";
        $this->data['user'] = $this->userModel->getOneWithImage($id);
        $this->data['roles'] = $this->roleModel->getAll();
        return view("admin/pages/users",$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $firstName = $request->input("FirstName");
        $lastName = $request->input("LastName");
        $email = $request->input("Email");
        $password = $request->input("Password");
        $roleId = $request->input("Roles");
        $updated_at = time();


        \DB::beginTransaction();
        try {
            $image = $request->file("userImage");
            if($image) {
                $image_name = $image->getClientOriginalName() . "_" . time();
                $directory = \public_path() . "/img/users";
                $image->move($directory, $image_name);

                $user = $this->userModel->getOneWithImage($id);
                $this->deleteImage($user->src);

                $path = "img/users/" . $image_name;
                $Image = $this->userModel->updateUserImage($path, $image_name, $id, $updated_at);
            }

            $User = $this->userModel->updateUser($firstName, $lastName, $email, $password, $updated_at, $roleId,$id);


        }
        catch (QueryException $e){
            \Log::error($e->getMessage());
            \LogActivity::addToLog($request,"User failed update on users!");
            return redirect()->back()->with("editError" , "Server error on edit user, try again later.");
        }
        if($User){

            \DB::commit();
            \LogActivity::addToLog($request,"User successfully updated user!");
            return redirect()->back()->with("editSuccess","User changed successfully!");
        }else{
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed update on users!");
            return redirect()->back()->with("editError" , "Server error on edit user, try again later.");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        try{

            $delete = $this->userModel->deleteUser($id);
            if(!$delete){
                \LogActivity::addToLog($request,"User failed delete on users!");
                return response(["deleteError", "Error on deleting user, user not found!"],404);
            }
            \LogActivity::addToLog($request,"User successfully deleted user!");
            return response(["deleteSuccess","User successfully deleted"],200);
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
            \LogActivity::addToLog($request,"User failed delete on users!");
            return response(["deleteError", "Error on deleting user, try again later!"],500 );
        }
    }




}
