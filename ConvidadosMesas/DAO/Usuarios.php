<?php

require_once 'DAO.php';

class Usuarios extends DAO {

    public function findByLogin($login) {
        $sql = $this->db->prepare("SELECT * "
                . "FROM usuario "
                . "WHERE login=:login");

        $sql->execute([':login' => $login]);
        return $sql->fetch();
    }
    
    
    
    public function findAll() {
        $sql = $this->db->prepare("SELECT * FROM usuario ORDER BY nome");
        $sql->execute();
        return $sql->fetchAll();
        
        
    }
    
    
    
    public function findByCod($cod) {
        $sql = $this->db->prepare("SELECT * "
                . " FROM usuario"
                . " WHERE codusuario=:cod");

        $sql->execute([':cod' => $cod]);
        return $sql->fetch();
    }
    
 

    
    public function insert($login, $email, $senha) {
        $sql = $this->db->prepare("INSERT INTO usuario "
                . "(login, email, senha) VALUES "
                . "(:login, :email, :senha)");
        return $sql->execute([
            ':login' => $login,
            ':email' => $email,
            ':senha' => $senha
            
            // password_hash($senha, PASSWORD_DEFAULT)
        ]);
    }

}


?>