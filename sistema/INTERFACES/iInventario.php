<?php

    interface IInventario{
        public function getInventario();
        public function getInventarioById($inventario_corr);
        public function editInventario($inventario_corr, $inventario_nombre, $inventario_descripcion, $inventario_cantidad);
    }

?>