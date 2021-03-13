<?php

namespace app\models;
use app\models\Database;

class Cars {
    private $db;
    private $tableA = "automobili";
    private $tableS = "usluge";
    private $tableR = "rezervacije";

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    private function getNumOfCars(){
        return $this->db->executeQuery("SELECT COUNT(*) AS brojAuta FROM {$this->tableA}");
    }

    public function getAllByPage($page = 0){
        
        return $this->db->executeWithLimit($page,$this->tableA);
    }

    public function getNumOfLinks(){

        $broj_auta = $this->getNumOfCars();

        $broj_auta = intval($broj_auta[0]->brojAuta);

        $brojLinkova = ceil($broj_auta / 6);

        return $brojLinkova;
    }

    public function getAllCars(){
        return $this->db->executeQuery("SELECT * FROM {$this->tableA}");
    }

    public function getAllServices(){
        return $this->db->executeQuery("SELECT * FROM {$this->tableS}");
    }

    public function insertRezervation($pickupA,$dropoffA,$fromD,$toD,$idK,$idC){
        $query = "INSERT INTO {$this->tableR} VALUES(NULL,?,?,?,?,?,?)";
        return $this->db->executeOneRow($query,[$pickupA,$dropoffA,$fromD,$toD,$idK,$idC]);
    }
    
    public function deleteCar($id){
        return $this->db->executeOneRow("DELETE FROM {$this->tableA} WHERE auto_id = ?",[$id]);
    }
    public function updateSetDefaulMain(){
        return $this->db->executeOneRow("UPDATE {$this->tableA} SET pozadina=? WHERE pozadina=?",[0,1]);
    }

    public function updateMain($id){
        return $this->db->executeOneRow("UPDATE {$this->tableA} SET pozadina=1 WHERE auto_id =?",[$id]);
    }

    public function insertCar($name,$doors,$seats,$lugage,$transmision,$age,$price,$rating,$novaPutanja,$alt,$featured,$main){
        $query = "INSERT INTO {$this->tableA} VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->executeOneRow($query,[$name,$doors,$seats,$lugage,$transmision,$age,$price,$rating,$novaPutanja,$alt,$featured,$main]);
    }

    public function getAllReservationsById($id){
        return $this->db->executeQuery("SELECT * FROM {$this->tableR} r INNER JOIN {$this->tableA} a ON r.auto_id=a.auto_id WHERE r.korisnik_id=".$id);
    }

    public function deleteRezervation($id){
        return $this->db->executeOneRow("DELETE FROM {$this->tableR} WHERE id_rezervacije=?",[$id]);
    }

}