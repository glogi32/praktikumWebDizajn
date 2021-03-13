<?php

namespace app\models;

class Database {

    private $pdo;
    private static $db;

    public function __construct()
    {
        $this->connect();
    }
    
    private function connect(){
        $this->pdo = new \PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function instance(){
        if(self::$db == null){
            self::$db = new Database();
        }
        return self::$db;
    }

    public function executeQuery($query){
        return $this->pdo->query($query)->fetchAll();
    }

    public function executeOneRow($query,Array $params){
        $prepare = $this->pdo->prepare($query);
        return $prepare->execute($params);
    }
    
    public function executeWithLimit($limit,$table){
        $select = $this->pdo->prepare("SELECT * FROM {$table} LIMIT :limit,6");
        $select->bindParam(":limit",$limit, \PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll();
    }

    public function executeWithLimitPosts($limit,$table){
        $select = $this->pdo->prepare("SELECT *,p.slika AS post_slika FROM {$table} p INNER JOIN korisnici k ON p.korisnik_id=k.korisnik_id ORDER BY p.vreme_objave DESC LIMIT :limit,3");
        $select->bindParam(":limit",$limit, \PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll();
    }

}