<?php

    class MantencionesDAO{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getMantenciones(){
            $sql = "SELECT 
                        movimientos.mantencion_corr as mantencion_corr,
                        inventario.inventario_corr as id_inventario,
                        inventario.descripcion as nombre_herramienta,
                        movimientos.fecha_movimiento as fecha_movimiento
                    FROM
                        inventario,
                        movimientos, 
                        tipo_movimiento
                    WHERE
                        movimientos.id_inventario = inventario.inventario_corr AND
                        movimientos.tipo_movimiento = tipo_movimiento.tipo_corr AND
                        tipo_movimiento = 3;";
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