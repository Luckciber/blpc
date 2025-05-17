<?php

    class LoginDao{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function login($usuario, $password) {
            $sql = "SELECT usuario,permiso, nombre_usuario FROM usuario WHERE usuario = :usuario AND password = :password";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

?>