<?php

    interface iMantenciones{
        public function getMantenciones();
        public function getMantencionesById($mantenciones_corr);
        public function generarMantencion($inventario_corr);
    }

?>