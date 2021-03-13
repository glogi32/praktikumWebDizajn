<?php

namespace app\models;
use app\models\Database;

class Blog {
    private $db;
    private $tableP = "postovi";
    private $tableK = "komentari";

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function insertPost($title,$text,$skracenTekst,$novaPutanja,$alt,$vremeObjave,$idK,$izabrani){
        $query = "INSERT INTO {$this->tableP} VALUES(NULL,?,?,?,?,?,?,?,?)";
        return $this->db->executeOneRow($query,[$title,$text,$skracenTekst,$novaPutanja,$alt,$vremeObjave,$idK,$izabrani]);
    }

    public function getAllByPage($page = 0){
        
        return $this->db->executeWithLimitPosts($page,$this->tableP);
    }
    
    private function getNumOfPosts(){
        return $this->db->executeQuery("SELECT COUNT(*) AS brojPostova FROM {$this->tableP}");
    }

    public function getNumOfLinks(){

        $broj_postova = $this->getNumOfPosts();

        $broj_postova = intval($broj_postova[0]->brojPostova);

        $brojLinkova = ceil($broj_postova / 3);

        return $brojLinkova;
    }

    public function getSinglePost($idP){
        return $this->db->executeQuery("SELECT *,p.slika AS slikaPost, k.slika AS slikaKorisnik, p.alt AS altPost,k.alt AS altKorisnik FROM postovi p INNER JOIN korisnici k ON p.korisnik_id=k.korisnik_id WHERE post_id=".$idP);
    }

    public function insertComment($message,$time,$idK,$idP){
        $query = "INSERT INTO {$this->tableK} VALUES(NULL,?,?,?,?)";
        return $this->db->executeOneRow($query,[$message,$time,$idK,$idP]);
    }

    public function getAllCommentsForPost($idP){
        return $this->db->executeQuery("SELECT * FROM {$this->tableK} km INNER JOIN korisnici k ON km.korisnik_id=k.korisnik_id WHERE km.post_id=".$idP);
    }

    public function getNumOfCom($idP){
        return $this->db->executeQuery("SELECT COUNT(*) as brojKomentara FROM {$this->tableK} WHERE post_id=".$idP);
    }

    public function getPostsBySearch($tekst){
        return $this->db->executeQuery("SELECT *,p.slika AS slikaPost,k.slika AS slikaKorisnik,p.alt AS altPost,k.alt AS altKorisnik FROM {$this->tableP} p INNER JOIN korisnici k ON p.korisnik_id=k.korisnik_id WHERE p.naslov LIKE '%{$tekst}%'");
    }

    public function getAllFeatured(){
        return $this->db->executeQuery("SELECT *,p.slika AS slikaPost,k.slika AS slikaKorisnik,p.alt AS altPost,k.alt AS altKorisnik FROM postovi p INNER JOIN korisnici k ON p.korisnik_id=k.korisnik_id WHERE p.izabrani = 1");
    }
    
}