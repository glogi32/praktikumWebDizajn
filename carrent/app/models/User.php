<?php

namespace app\models;
use app\models\Database;

class User {

    private $db;
    private $table = "korisnici";

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getOneUserByEmailAndPass($email,$password){
        $data = $this->db->executeQuery("SELECT * FROM {$this->table} WHERE email = '".$email."'"."AND password = '".$password."'");
        if(!count($data)){
            return null;
        }

        return $data[0];
    }

    public function addUser($ime,$prezime,$email,$password,$about,$uloga,$slika,$alt){

        $query = "INSERT INTO {$this->table}(ime, prezime, email, password, oAutoru, uloga_id, slika, alt) VALUES(?,?,?,?,?,?,?,?)";

        return $this->db->executeOneRow($query,[$ime,$prezime,$email,$password,$about,$uloga,$slika,$alt]);
    }

    public function getOneById($id){
        return $this->db->executeQuery("SELECT * FROM korisnici WHERE korisnik_id=".$id);
    }

    public function getAllWithRoles(){
        return $this->db->executeQuery("SELECT * FROM korisnici k INNER JOIN uloge u on k.uloga_id=u.uloga_id");
    }

    public function deleteUser($id){
        return $this->db->executeOneRow("DELETE FROM korisnici WHERE korisnik_id = ?",[$id]);
    }

    public function getAllRoles(){
        return $this->db->executeQuery("SELECT * FROM uloge");
    }

    public function updateUser($ime,$prezime,$email,$password,$uloga,$id){
        $query = "UPDATE korisnici SET ime=?,prezime=?,email=?,password=?,uloga_id=? WHERE korisnik_id=?";
        return $this->db->executeOneRow($query,[$ime,$prezime,$email,$password,$uloga,$id]);
    }

}