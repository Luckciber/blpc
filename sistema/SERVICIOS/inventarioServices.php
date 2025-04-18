<?php
    require_once __DIR__.'\..\conexion.php';
    require_once __DIR__.'\..\INTERFACES\iInventario.php';
    require_once __DIR__.'\..\DAO\inventarioDAO.php';

    class InventarioService implements IInventario{
        private $inventarioDao;

        public function __construct($pdo) {
            $this->inventarioDao = new InventarioDao($pdo);
        }

        public function getInventario() {
            return $this->inventarioDao->getInventario();
        }

        public function getInventarioById($inventario_corr) {
            return $this->inventarioDao->getInventarioById($inventario_corr);
        }
    }

?>