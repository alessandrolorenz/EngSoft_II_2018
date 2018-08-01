<?php

require_once 'DAO.php';

class Montagem extends DAO {

    public function findAll() {
        $sql = $this->db->prepare("SELECT mesaconvidado.idmontagem, mesaconvidado.idmesa, mesa.mesanumero, convidado.nome, mesa.descricao, convidado.idconvidado FROM mesaconvidado INNER JOIN mesa ON mesa.idmesa=mesaconvidado.idmesa INNER JOIN convidado on mesaconvidado.idconvidado=convidado.idconvidado ORDER BY idmesa");
        $sql->execute();
        return $sql->fetchAll();
    }
    
    public function findAll1() {
        $sql = $this->db->prepare("SELECT * FROM mesaconvidado INNER JOIN mesa ON mesa.idmesa=mesaconvidado.idmesa INNER JOIN convidado on mesaconvidado.idconvidado=convidado.idconvidado where  ORDER BY idmesa");
        $sql->execute();
        return $sql->fetchAll();
    }
    
    
    
    public function findAllNaoContendo() {
        $sql = $this->db->prepare("SELECT * FROM convidado e WHERE e.idconvidado NOT IN(SELECT mesaconvidado.idconvidado FROM mesaconvidado)");
        $sql->execute();
        return $sql->fetchAll();
    }
    
    
    
    
    
    

    public function findByNome($q) {
        $sql = $this->db->prepare(
                "SELECT mesaconvidado.idmesa, mesa.mesanumero, convidado.nome, mesa.descricao, convidado.idconvidado FROM mesaconvidado INNER JOIN mesa ON mesa.idmesa=mesaconvidado.idmesa INNER JOIN convidado on mesaconvidado.idconvidado=convidado.idconvidado "
                . "WHERE convidado.nome LIKE :q "
                . "ORDER BY idmesa");
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
                . " FROM mesaconvidado"
                . " WHERE idmontagem=:cod");

        $sql->execute([':cod' => $cod]);
        return $sql->fetch();
    }
    
     public function findByConv($idconvidado) {
        $sql = $this->db->prepare("SELECT * "
                . " FROM mesaconvidado"
                . " WHERE idconvidado=:idconvidado");

        $sql->execute([':idconvidado' => $idconvidado]);
        return $sql->fetch();
    }
    
    
    public function findCountConvidado($idmesa) {
        $sql = $this->db->prepare("select count(idconvidado) from mesaconvidado where idmesa = :idmesa"
//                . " FROM mesaconvidado"
//                . " WHERE idmontagem=:cod"
                );

       $sql->execute([':idmesa' => $idmesa]);
       return  $sql->fetchColumn(0);
       // return $sql->fetch;
       
         
        
    }
    
    
    
    

    public function insert($idmesa, $idconvidado) {
        $sql = $this->db->prepare("INSERT INTO mesaconvidado "
                . "(idmesa, idconvidado) "
                . "VALUES (:idmesa, :idconvidado)");

        return $sql->execute([
                    ':idmesa' => $idmesa,
                    ':idconvidado' => $idconvidado]);
    }
    
   

    public function update($cod, $idmesa, $idconvidado) {
        $sql = $this->db->prepare("UPDATE mesaconvidado "
                . " SET idmesa=:idmesa, "
                . " idconvidado=:idconvidado "
                . " WHERE idmontagem=:cod");

        return $sql->execute([
                    ':cod' => $cod,
                    ':idmesa' => $idmesa,
                    ':idconvidado' => $idconvidado]);
    }
    

    

    public function delete($cod) {
        $sql = $this->db->prepare("DELETE FROM "
                . " mesaconvidado "
                . " WHERE idconvidado=:cod");

        return $sql->execute([':cod' => $cod]);
    }
    
    
    

}
