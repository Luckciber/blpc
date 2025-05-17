<?php
require_once __DIR__.'\..\conexion.php';

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


        public function getMantencionesPorFechas($fecha_desde, $fecha_hasta){
            $sql = "SELECT 
                        movimientos.mantencion_corr as mantencion_corr,
                        inventario.inventario_corr as id_inventario,
                        inventario.descripcion as nombre_herramienta,
                        movimientos.fecha_movimiento as fecha_movimiento,
                        tipo_movimiento.descripcion AS tipo_herramienta
                    FROM
                        inventario,
                        movimientos, 
                        tipo_movimiento
                    WHERE
                        movimientos.id_inventario = inventario.inventario_corr AND
                        movimientos.tipo_movimiento = tipo_movimiento.tipo_corr AND
                        movimientos.fecha_movimiento BETWEEN :fecha_desde AND :fecha_hasta AND
                        tipo_movimiento = 3;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':fecha_desde', $fecha_desde, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_hasta', $fecha_hasta, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    // Nueva función para obtener mantenciones con el estado
    public function getMantencionesConEstado(){
        $sql = "SELECT
                    movimientos.mantencion_corr as mantencion_corr,
                    inventario.inventario_corr as id_inventario,
                    inventario.descripcion as nombre_herramienta,
                    movimientos.fecha_movimiento as fecha_movimiento,
                    CASE
                        WHEN movimientos.fecha_movimiento > '2023-01-01' THEN 1
                        ELSE 0
                    END as es_nuevo
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
        
        function generarMantencion($inventario_corr){
            $sql = "INSERT INTO movimientos (id_inventario, tipo_movimiento, fecha_movimiento) VALUES (:id_inventario, 3, NOW())";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_inventario', $inventario_corr, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function botonesFuncion($inventario_corr){
            try {
                $this->pdo->beginTransaction();
                $sql = "UPDATE mantenciones SET stock_actual = stock_actual - 1 WHERE inventario_corr = :inventario_corr";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':inventario_corr', $inventario_corr, PDO::PARAM_INT);
                $stmt->execute();

                // 2. Registra el movimiento
                $sql = "INSERT INTO movimientos (id_inventario, tipo_movimiento, fecha_movimiento) 
                        VALUES (:id_inventario, 5, NOW())";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id_inventario', $inventario_corr, PDO::PARAM_INT);
                $stmt->execute();

                // Finaliza la transacción
                $this->pdo->commit();
                return true;

            } catch (PDOException $e) {
                // Si algo falla, revierte todo
                $this->pdo->rollBack();
                throw $e;
            }
        }

        public function listarTipoMantencion(){
            try{
                $sql = "SELECT * FROM `tipo_movimiento`";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                return $e->getMessage();
            }
    }

    }


?>

