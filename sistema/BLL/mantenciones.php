<?php
require_once __DIR__.'\..\SERVICIOS\mantencionesService.php';

function obtenerMantenciones() {
    //require_once __DIR__.'\..\SERVICIOS\mantencionesService.php';
    session_start();
    $mantencionesService = new MantencionesService($pdo);
    $mantenciones = $mantencionesService->getMantenciones();
    
    if ($mantenciones) {
        // Aquí puedes procesar los datos del inventario y mostrarlos en la vista
        // Por ejemplo, podrías convertirlo a JSON o renderizarlo en una tabla HTML
        return json_encode($mantenciones);
    } else {
        return json_encode(array("error" => "No se encontraron resultados."));
    }
}

// Nueva función para obtener mantenciones con el estado
function obtenerMantencionesConEstado() {
    session_start();
    $mantencionesService = new MantencionesService($pdo);
    $mantenciones = $mantencionesService->getMantencionesConEstado();

    if ($mantenciones) {
        return json_encode($mantenciones);
    } else {
        return json_encode(array("error" => "No se encontraron resultados."));
    }
}
?>
