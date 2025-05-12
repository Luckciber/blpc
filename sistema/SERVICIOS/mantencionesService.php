<?php
    require_once __DIR__.'\..\conexion.php';
    require_once __DIR__.'\..\INTERFACES\iMantenciones.php';
    require_once __DIR__.'\..\DAO\mantencionesDAO.php';

    class MantencionesService implements IMantenciones{
        private $mantencionesDAO;

        public function __construct($pdo) {
            $this->mantencionesDAO = new MantencionesDAO($pdo);
        }

        public function getMantenciones() {
            return $this->mantencionesDAO->getMantenciones();
        }

           // Nueva función para obtener mantenciones con el estado
        public function getMantencionesConEstado() {
            return $this->mantencionesDAO->getMantencionesConEstado();
        }

        public function getMantencionesById($mantenciones_corr) {
            return $this->mantencionesDAO->getMantencionesById($mantenciones_corr);
        }

        public function generarMantencion($inventario_corr) {
            return $this->mantencionesDAO->generarMantencion($inventario_corr);
        }
    }

?>

