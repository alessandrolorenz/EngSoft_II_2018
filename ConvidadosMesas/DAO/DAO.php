<?php

class DAO {
    protected $db;
    
    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=listaemesas2", "root", "");
        
        $this->db->exec("SET CHARSET UTF8");
        
    }
}
