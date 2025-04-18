<?php

    class InventarioDAO{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getInventario(){
            $sql = "SELECT * FROM inventario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getInventarioById($inventario_corr){
            $sql = "SELECT * FROM inventario WHERE inventario_corr = :inventario_corr";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inventario_corr', $inventario_corr, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

?>