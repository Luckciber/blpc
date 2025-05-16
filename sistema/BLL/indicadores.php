<?php

    function indicadoresCabecera(){
        require_once __DIR__.'\..\SERVICIOS\indicadoresService.php';
            $indicadoresService = new IndicadoresService($pdo);
            $indicadores = $indicadoresService->getIndicadoresCabecera();
            if ($indicadores) {
                return json_encode($indicadores);
            } else {
                return json_encode(array("error" => "No se encontraron resultados."));
            }
    }

    function getIndicadoresGrafico(){
        include __DIR__.'\..\conexion.php';
        require_once __DIR__.'\..\SERVICIOS\indicadoresService.php';
            $indicadoresService = new IndicadoresService($pdo);
            $indicadores = $indicadoresService->getIndicadoresGrafico();
            if ($indicadores) {
                return json_encode($indicadores);
            } else {
                return json_encode(array("error" => "No se encontraron resultados."));
            }
    }

?>