<?php
class IndicadoresDAO{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getIndicadoresCabecera(){
            $sql = "SELECT 
                        (SELECT COUNT(inventario_corr) FROM inventario) AS TOTAL_INVENTARIO,
                        (SELECT COUNT(id_inventario) FROM movimientos WHERE tipo_movimiento = 3) AS TOTAL_MANTENCIONES,
                        (SELECT COUNT(id_inventario) FROM movimientos WHERE tipo_movimiento = 5) AS TOTAL_INUTILIZABLE,
                        (SELECT COUNT(id_inventario) FROM movimientos WHERE tipo_movimiento = 2) AS TOTAL_DISPONIBLE;
                        ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getIndicadoresGrafico(){
            $sql = "SELECT 
                        COUNT(mantencion_corr) AS MANTENCIONES_AGENDADAS,
                        fecha_movimiento 
                    FROM 
                        `movimientos` 
                    WHERE 
                        tipo_movimiento = 3 
                    GROUP BY 
                        fecha_movimiento 
                    ORDER BY 
                        fecha_movimiento;
                        ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}
?>
