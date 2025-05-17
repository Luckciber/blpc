<?php

    interface iMantenciones{
        public function getMantenciones();
        public function getMantencionesById($mantenciones_corr);
        public function generarMantencion($inventario_corr);
        public function listarTipoMantencion();

        public function getMantencionesPorFechas($fecha_desde, $fecha_hasta);
    }

?>