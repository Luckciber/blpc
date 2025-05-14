<?php

    class ReportesDao{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function ReporteListaMovimientosPorIdInventario($id_inventario) {
            $sql = "SELECT 
                        `mantencion_corr`, 
                        `id_inventario`, 
                        `fecha_movimiento`, 
                        `tipo_movimiento`,
                        inventario.descripcion,
                        tipo_movimiento.descripcion
                    FROM 
                        movimientos,
                        inventario,
                        tipo_movimiento
                    WHERE 
                        movimientos.id_inventario =inventario.inventario_corr AND
                        movimientos.tipo_movimiento = tipo_movimiento.tipo_corr AND
                        id_inventario = :id_inventario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id_inventario', $id_inventario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados como um array associativo

        }

        public function ReporteListaMovimientosTodosInventario() {
            $sql = "SELECT 
                        `mantencion_corr`, 
                        `id_inventario`, 
                        `fecha_movimiento`, 
                        `tipo_movimiento`,
                        inventario.descripcion,
                        tipo_movimiento.descripcion
                    FROM 
                        movimientos,
                        inventario,
                        tipo_movimiento
                    WHERE 
                        movimientos.id_inventario =inventario.inventario_corr AND
                        movimientos.tipo_movimiento = tipo_movimiento.tipo_corr";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados como um array associativo
        }
    }

?>