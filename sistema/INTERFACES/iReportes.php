<?php

    interface IReportes{
        public function ReporteListaMovimientosPorIdInventario($id_inventario);
        public function ReporteListaMovimientosTodosInventario();
        public function ReporteListaMovimientosTodosMantenciones();
        public function ReporteListaMovimientosPorIdMantencion($id_mantencion);
    }

?>