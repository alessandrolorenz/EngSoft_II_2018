<?php

require_once 'DAO.php';

class Mesa extends DAO {

    public function findAll() {
        $sql = $this->db->prepare("SELECT * FROM mesa ORDER BY mesanumero");
        $sql->execute();
        return $sql->fetchAll();
    }
    
    public function findAllConfirmado() {
        $sql = $this->db->prepare("SELECT * FROM mesa ORDER BY mesanumero");
        $sql->execute();
        return $sql->fetchAll();
    }
    
    
    public function findAllnumerodelugares() {
        $sql = $this->db->prepare("SELECT numerodelugares FROM mesa");
        $sql->execute();
        return $sql;
        //return $sql->fetchAll();
    
    }
    
    

    public function findById($q) {
        $sql = $this->db->prepare(
                    "SELECT * "
                . "FROM mesa "
                . "WHERE idmesa LIKE :q "
                . "ORDER BY mesanumero");
        $sql->execute([":q" => '%' . $q . '%']);
        return $sql->fetchAll();
    }
    
    public function findByDescricao($q) {
        $sql = $this->db->prepare(
                    "SELECT * "
                . "FROM mesa "
                . "WHERE descricao LIKE :q "
                . "ORDER BY mesanumero");
        $sql->execute([":q" => '%' . $q . '%']);
        return $sql->fetchAll();
    }
    

    public function findByCod($cod) {
        $sql = $this->db->prepare("SELECT * "
                . " FROM mesa"
                . " WHERE idmesa=:cod");

        $sql->execute([':cod' => $cod]);
        return $sql->fetch();
    }

    
    public function insert($mesanumero, $numerodelugares, $descricao) {
        $sql = $this->db->prepare("INSERT INTO mesa "
                . "(mesanumero, numerodelugares, descricao) "
                . "VALUES (:mesanumero, :numerodelugares, :descricao)");

        return $sql->execute([
                    ':mesanumero' => $mesanumero,
                    ':numerodelugares' => $numerodelugares,
                    ':descricao' => $descricao]);
    }
    
    
    

    public function update($cod, $mesanumero, $numerodelugares, $descricao) {
        $sql = $this->db->prepare("UPDATE mesa "
                . " SET mesanumero=:mesanumero, "
                . " numerodelugares=:numerodelugares, "
                . " descricao=:descricao "
                . " WHERE idmesa=:cod");

        return $sql->execute([
                    ':cod' => $cod,
                    ':mesanumero' => $mesanumero,
                    ':numerodelugares' => $numerodelugares,
                    ':descricao' => $descricao]);
    }
    

    

    public function delete($cod) {
        $sql = $this->db->prepare("DELETE FROM "
                . " mesa "
                . " WHERE idmesa=:cod");

        return $sql->execute([':cod' => $cod]);
    }
    
    
    

}
