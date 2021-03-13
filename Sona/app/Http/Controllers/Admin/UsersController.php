<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UserRequest;
use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UsersController extends FrontAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with("role")->get();
        $this->data["users"] = $users;

        foreach ($users as $u){
            $u->urlEdit = route("users.edit",$u->id);
        }



        return view("admin.pages.users",$this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $this->data["form"] = "add";
        $this->data["roles"] = $roles;

        return view("admin.pages.users",$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignUpRequest $request)
    {
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
            $imageModel->imageable_type = "App\Models\User";


            $insertUserImage = $imageModel->save();

        }catch (\Exception $e){
            \Log::error($e->getMessage());

            $this->deleteImage($path);

            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.")->withInput();
        }

        if($insertUser && $insertUserImage){
            DB::commit();
            return redirect()->back()->with("signUpSuccess","Successful adding up user, u can login now!");
        }else{

            DB::rollBack();

            $this->deleteImage($path);

            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.")->withInput();
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
        $user = User::with("image","role")->where("id",$id)->first();
        $this->data["form"] = "edit";
        $this->data["user"] = $user;
        $this->data["roles"] = Role::all();

        return view("admin.pages.users",$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::with("image")->find($id);

        $user->first_name = $request->input("firstName");
        $user->last_name = $request->input("lastName");
        $user->password = md5($request->input("password"));
        $user->phone = $request->input("phone");
        $user->email = $request->input("email");
        $user->role_id = $request->input("ddlRoles");




        DB::beginTransaction();
        $image = $request->file("userImage");
        $image_name = time()."_".$image->getClientOriginalName();
        $directory = \public_path()."/img/users";
        $path = "img/users/".$image_name;

        try{

            $uploadImage = $image->move($directory,$image_name);

            $insertUser = $user->save();


            $image = Image::find($user->image->id);

            $this->deleteImage($image->src);

            $image->alt = $image_name;
            $image->src = $path;
            $image->imageable_id = $id;
            $image->imageable_type = "App\Models\User";

            $insertUserImage = $image->save();

        }catch (\Exception $e){
            \Log::error($e->getMessage());

            $this->deleteImage($path);

            return redirect()->back()->with("editError" , "Server error on editing user, try again later.")->withInput();
        }

        if($insertUser && $insertUserImage){
            DB::commit();
            return redirect()->back()->with("editSuccess","Successful editing user!");
        }else{

            DB::rollBack();

            $this->deleteImage($path);

            return redirect()->back()->with("signUpError" , "Server error on sign up, try again later.")->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{
            $user = User::find($id);
            if(!$user){
                return response("",404);
            }
            $user->delete();
            return response("",204);

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return response("",500);
        }
    }
}
