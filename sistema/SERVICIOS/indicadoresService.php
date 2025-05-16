<?php
    require_once __DIR__.'\..\conexion.php';
    require_once __DIR__.'\..\INTERFACES\iIndicadores.php';
    require_once __DIR__.'\..\DAO\indicadoresDAO.php';

    class IndicadoresService implements IIndicadores{
        private $indicadoresDAO;

        public function __construct($pdo) {
          $this->indicadoresDAO = new IndicadoresDAO($pdo);
        }

        public function getIndicadoresCabecera() {
            return $this->indicadoresDAO->getIndicadoresCabecera();
        }

        public function getIndicadoresGrafico() {
            return $this->indicadoresDAO->getIndicadoresGrafico();
        }
    }

?>