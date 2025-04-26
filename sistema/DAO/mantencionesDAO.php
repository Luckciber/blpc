<?php

    class MantencionesDAO{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getMantenciones(){
            $sql = "SELECT * FROM movimientos WHERE tipo_movimiento = 3";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getMantencionesById($mantencion_corr){
            $sql = "SELECT * FROM movimientos WHERE mantencion_corr = :mantencion_corr";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':mantencion_corr', $mantencion_corr, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

?>