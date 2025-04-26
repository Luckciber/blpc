<?php
require_once __DIR__.'\..\SERVICIOS\reportesServices.php';

session_start();

$reportesService = new ReportesService($pdo);

$reporte = $reportesService->ReporteListaMovimientosTodosMantenciones();
if ($reporte) {
    // Aquí puedes procesar los datos del reporte y mostrarlos en la vista
    // Por ejemplo, podrías convertirlo a JSON o renderizarlo en una tabla HTML
    return json_encode($reporte);
} else {
    return json_encode(array("error" => "No se encontraron resultados."));
}

?>