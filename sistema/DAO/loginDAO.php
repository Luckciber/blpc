<?php

    class LoginDao{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function login($usuario, $password) {
            $sql = "SELECT * FROM usuario WHERE usuario = :usuario AND password = :password";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                return true; // Login bem-sucedido
            } else {
                return false; // Login falhou
            }
        }
    }

?>