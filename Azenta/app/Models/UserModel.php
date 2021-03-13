<?php


namespace App\Models;


class UserModel
{
    private $tableUsers = "users";
    private $tableImagesUsers = "images_user";
    private $tableRoles = "roles";

    public function getByEmailAndPassword($email,$password){
        return \DB::table($this->tableUsers. " AS u")
            ->join($this->tableRoles. " AS r","u.role_id","=","r.role_id")
            ->where([
                ["email" ,"=",$email],
                ["password","=",md5($password)],
                ["isDeleted","=",0]
            ])->first();
    }

    public function insertUser($firstName, $lastName, $email, $password, $roleId){
        return \DB::table($this->tableUsers)
            ->insertGetId([
                "firstName" => $firstName,
                "lastName" => $lastName,
                "email" => $email,
                "password" => md5($password),
                "role_id" => $roleId
            ]);
    }

    public  function insertUserImage($path, $image_name,$userId){
        return \DB::table($this->tableImagesUsers)
            ->insertGetId([
                "src" => $path,
                "alt" => $image_name,
                "user_id" => $userId
            ]);
    }

    public function getAllUsersWithRoles(){
        return \DB::table($this->tableUsers." AS u")
            ->join($this->tableRoles." AS r","u.role_id","=","r.role_id")
            ->where("isDeleted","=",0)
            ->get();
    }

    public function getOneWithImage($id){
        return \DB::table($this->tableUsers. " AS u")
            ->join($this->tableImagesUsers. " AS ui","u.user_id","=","ui.user_id")
            ->where([
                ['ui.user_id',"=",$id],
                ["isDeleted","=",0]
            ])
            ->first();
    }

    public function updateUser($firstName, $lastName, $email, $password, $updated_at, $roleId,$id){
        return \DB::table($this->tableUsers)
            ->where("user_id",$id)
            ->update([
                "firstName" => $firstName,
                "lastName" => $lastName,
                "email" => $email,
                "password" => md5($password),
                "updated_at" => $updated_at,
                "role_id" => $roleId
            ]);
    }

    public function updateUserImage($path, $image_name,$id,$updated_at){
        return \DB::table($this->tableImagesUsers)
            ->where("user_id",$id)
            ->update([
                "src" => $path,
                "alt" => $image_name,
                "updated_at" => $updated_at
            ]);
    }

    public function deleteUser($id){
        return \DB::table($this->tableUsers)
            ->where("user_id",$id)
            ->update([
                "isDeleted" => 1
            ]);
    }

    public function getAllAgents(){
        return \DB::table($this->tableUsers. " AS u")
            ->join($this->tableImagesUsers. " AS ui","u.user_id","=","ui.user_id")
            ->where([
                ["role_id","=",3],
                ["isDeleted","=",0]
            ])
            ->get();
    }


}
