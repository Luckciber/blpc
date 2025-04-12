<?php

require_once '../SERVICIOS/reportesServices.php';

session_start();

$reportesService = new ReportesService($pdo);

$reporte = $reportesService->ReporteListaMovimientosTodosInventario();
if ($reporte) {
    // Aquí puedes procesar los datos del reporte y mostrarlos en la vista
    // Por ejemplo, podrías convertirlo a JSON o renderizarlo en una tabla HTML
    echo json_encode($reporte);
} else {
    echo json_encode(array("error" => "No se encontraron resultados."));
}

?>