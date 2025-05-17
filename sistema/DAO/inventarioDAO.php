<?php

    class InventarioDAO{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getInventario(){
            $sql = "SELECT * FROM inventario ";
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

        public function editInventario($inventario_corr, $inventario_nombre, $inventario_descripcion, $inventario_cantidad){
            $sql = "UPDATE inventario SET inventario_nombre = :inventario_nombre, inventario_descripcion = :inventario_descripcion, inventario_cantidad = :inventario_cantidad WHERE inventario_corr = :inventario_corr";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inventario_corr', $inventario_corr, PDO::PARAM_INT);
            $stmt->bindParam(':inventario_nombre', $inventario_nombre, PDO::PARAM_STR);
            $stmt->bindParam(':inventario_descripcion', $inventario_descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':inventario_cantidad', $inventario_cantidad, PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function reducirInventario($inventario_corr){
            try {
                $this->pdo->beginTransaction();

                // 1. Actualiza el stock
                $sql = "UPDATE inventario SET stock_actual = stock_actual - 1 WHERE inventario_corr = :inventario_corr";
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
    }

?>