<?php

require_once 'DAO.php';
require_once 'Montagem.php';

class Convidado extends DAO {

    public function findAll() {
        $sql = $this->db->prepare("SELECT * FROM convidado ORDER BY nome");
        $sql->execute();
        return $sql->fetchAll();
    }
  
    public function findAllConf() {
        $sql = $this->db->prepare("SELECT * FROM convidado where status=1 ORDER BY nome");
        $sql->execute();
        return $sql->fetchAll();
             
    }
    
    
    
    public function findAllNaoContendo() {
        $sql = $this->db->prepare("SELECT * FROM convidado e WHERE e.idconvidado NOT IN(SELECT mesaconvidado.idconvidado FROM mesaconvidado)");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function findAllConvSemMesa() {
        $sql = $this->db->prepare("SELECT * FROM convidado where status=1 ORDER BY nome");
        $sql->execute();
        return $sql->fetchAll(); 
        $Montagem = new Montagem;
        // Ainda não sei como fazer
    
    }
    

    public function findByNome($q) {
        $sql = $this->db->prepare(
                "SELECT * "
                . "FROM convidado "
                . "WHERE nome LIKE :q "
                . "ORDER BY nome");
        $sql->execute([":q" => '%' . $q . '%']);
        return $sql->fetchAll();
    }

    
    public function findByCod($cod) {
        $sql = $this->db->prepare("SELECT * "
                . " FROM convidado"
                . " WHERE idconvidado=:cod");

        $sql->execute([':cod' => $cod]);
        return $sql->fetch();
        
        
        
    }
    
    
    public function findByCod1($cod) {
        $sql = $this->db->prepare("SELECT * "
                . " FROM convidado"
                . " WHERE idconvidado=:cod");

        $sql->execute([':cod' => $cod]);
       //return $sql->;
        return $sql->fetch();
    }
    
    

    public function insert($nome, $email, $telefone, $ladofamilia, $status) {
        $sql = $this->db->prepare("INSERT INTO convidado "
                . "(nome, email, telefone, ladofamilia, status) "
                . "VALUES (:nome, :email, :telefone, :ladofamilia, :status)");

        return $sql->execute([
                    ':nome' => $nome,
                    ':email' => $email,
                    ':telefone' => $telefone,
                    ':ladofamilia' => $ladofamilia,
                    ':status' => $status]);
    }

    public function update($cod, $nome, $email, $telefone, $ladofamilia, $status) {
        $sql = $this->db->prepare("UPDATE convidado "
                . " SET nome=:nome, "
                . " email=:email, "
                . " telefone=:telefone, "
                . " ladofamilia=:ladofamilia, "
                . " status=:status "
                . " WHERE idconvidado=:cod");

        return $sql->execute([
                    ':cod' => $cod,
                    ':nome' => $nome,
                    ':email' => $email,
                    ':telefone' => $telefone,
                    ':ladofamilia' => $ladofamilia,
                    ':status' => $status]);
    }
    

    

    public function delete($cod) {
        $sql = $this->db->prepare("DELETE FROM "
                . " convidado "
                . " WHERE idconvidado=:cod");

        return $sql->execute([':cod' => $cod]);
    }
    
    
    

}
