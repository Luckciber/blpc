
<?php
    require_once '../conexion.php';
    require_once '../INTERFACES/iReportes.php';
    require_once '../DAO/reportesDAO.php';

    class ReportesService implements IReportes{
        private $reportesDao;

        public function __construct($pdo) {
            $this->reportesDao = new ReportesDao($pdo);
        }

        public function ReporteListaMovimientosPorIdInventario($id_inventario) {
            return $this->reportesDao->ReporteListaMovimientosPorIdInventario($id_inventario);
        }
        public function ReporteListaMovimientosTodosInventario() {
            return $this->reportesDao->ReporteListaMovimientosTodosInventario();
        }
    }

?>