<?php

function obtenerConsulta() {
    include __DIR__.'\..\conexion.php';
    require_once __DIR__.'\..\SERVICIOS\consultaService.php';
    $consultaService = new consultaService($pdo);
    $consulta = $consultaService->getConsulta(); /*o inventario?*/
    
    if ($consulta) {
        // Aquí puedes procesar los datos del inventario y mostrarlos en la vista
        // Por ejemplo, podrías convertirlo a JSON o renderizarlo en una tabla HTML
        return json_encode($consulta);
    } else {
        return json_encode(array("error" => "No se encontraron resultados."));
    }
}

?>