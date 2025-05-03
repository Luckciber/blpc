<?php
    require_once __DIR__.'\..\conexion.php';
    require_once __DIR__.'\..\INTERFACES\iConsulta.php';
    require_once __DIR__.'\..\DAO\consultaDAO.php';

    class DiseñoConsulta implements IConsulta{
        private $consultaDao;

        public function __construct($pdo) {
            $this->consultaDao = new ConsultaDao($pdo);
        }

//      public function ReporteListaMovimientosPorIdInventario($id_inventario) {
//          return $this->reportesDao->ReporteListaMovimientosPorIdInventario($id_inventario);
  //    }
    //  public function ReporteListaMovimientosTodosInventario() {
 //         return $this->reportesDao->ReporteListaMovimientosTodosInventario();
 //     }
//      public function ReporteListaMovimientosPorIdMantenciones($mantenciones_corr) {
//          return $this->reportesDao->ReporteListaMovimientosPorIdInventario($mantenciones_corr);
 //     }
//      public function ReporteListaMovimientosTodosMantenciones() {
 //         return $this->reportesDao->ReporteListaMovimientosTodosInventario();
 //     }
  }


?>