<?php

function obtenerInventario() {
    require_once __DIR__.'\..\SERVICIOS\inventarioServices.php';
    session_start();
    $inventarioService = new InventarioService($pdo);
    $inventario = $inventarioService->getInventario();
    
    if ($inventario) {
        // Aquí puedes procesar los datos del inventario y mostrarlos en la vista
        // Por ejemplo, podrías convertirlo a JSON o renderizarlo en una tabla HTML
        return json_encode($inventario);
    } else {
        return json_encode(array("error" => "No se encontraron resultados."));
    }
}


?>