<?php

function obtenerdConsulta() {
    require_once __DIR__.'\..\SERVICIOS\dConsulta.php';
    session_start();
    $diseñoConsulta = new diseñoConsulta($pdo);
    $consulta = $diseñoConsulta->getConsulta();
    
    if ($dConsultanes) {
        // Aquí puedes procesar los datos del inventario y mostrarlos en la vista
        // Por ejemplo, podrías convertirlo a JSON o renderizarlo en una tabla HTML
        return json_encode($consulta);
    } else {
        return json_encode(array("error" => "No se encontraron resultados."));
    }
}


?>