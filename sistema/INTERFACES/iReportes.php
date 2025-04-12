<?php

    interface IReportes{
        public function ReporteListaMovimientosPorIdInventario($id_inventario);
        public function ReporteListaMovimientosTodosInventario();
    }

?>