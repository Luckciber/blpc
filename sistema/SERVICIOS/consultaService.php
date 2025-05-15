<?php
    require_once __DIR__.'\..\conexion.php';
    require_once __DIR__.'\..\INTERFACES\iConsulta.php';
    require_once __DIR__.'\..\DAO\consultaDAO.php';

    class consultaService implements IConsulta{
        private $consultaDAO;

        public function __construct($pdo) {
          $this->consultaDAO = new consultaDAO($pdo);
        }

        public function getConsulta($id_inventario) {
            return $this->consultaDAO->getConsulta($id_inventario);
        }

        public function getConsultaById($consulta_corr) {
            return $this->consultaDAO->getConsultaById($consulta_corr);
        }
  }


?>