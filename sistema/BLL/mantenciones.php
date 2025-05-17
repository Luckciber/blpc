<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['generar_mantencion'])) {
        $idProducto = $_POST['generar_mantencion'];
        generarMantencion($idProducto);
        exit;
    }
    if(isset($_POST['filtrar_tabla'])){
        obtenerMantencionesPorFecha($_POST['fecha_desde'], $_POST['fecha_hasta']);
    }
}

function generarMantencion($idProducto) {
    session_start();
    require_once __DIR__.'\..\SERVICIOS\mantencionesService.php';
    $mantencionesService = new MantencionesService($pdo);
    $generar = $mantencionesService->generarMantencion(inventario_corr: $idProducto);
    require_once __DIR__.'\..\SERVICIOS\inventarioServices.php';
    $inventarioService = new InventarioService($pdo);
    $reducir = $inventarioService->reducirInventario(inventario_corr: $idProducto);
    $procesoOK = false;

    if ($generar) {
        $procesoOK = true;
    } else {
        $procesoOK = false;
    }

    if ($procesoOK) {
        $_SESSION['alerta_modal'] = '
                <div class="modal show" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Proceso realizado con éxito</h5>
                                <a href="inventario.php" class="close">&times;</a>
                            </div>
                            <div class="modal-body">
                                <p>La mantención ha sido generada correctamente.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="listaInventario.php" class="btn btn-success">OK</a>
                            </div>
                        </div>
                    </div>
                </div>';
            header('Location: ../../listaInventario.php');
    } else {
        $_SESSION['alerta_modal'] = '
            <div class="modal show" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5)">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Proceso realizado con éxito</h5>
                            <a href="inventario.php" class="close">&times;</a>
                        </div>
                        <div class="modal-body">
                            <p>Se ha producido un error en backend servidor.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="listaInventario.php" class="btn btn-success">OK</a>
                        </div>
                    </div>
                </div>
            </div>';
        header('Location: ../../listaInventario.php');
    }
}

function obtenerMantenciones() {
    require_once __DIR__.'\..\SERVICIOS\mantencionesService.php';
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

function obtenerMantencionesPorFecha($fecha_desde, $fecha_hasta) {
    require_once __DIR__.'\..\SERVICIOS\mantencionesService.php';
    session_start();
    $mantencionesService = new MantencionesService($pdo);
    $mantenciones = $mantencionesService->getMantencionesPorFechas($fecha_desde, $fecha_hasta);
    
    if ($mantenciones) {
        // Aquí puedes procesar los datos del inventario y mostrarlos en la vista
        // Por ejemplo, podrías convertirlo a JSON o renderizarlo en una tabla HTML
        $_SESSION['refrescar_mantenciones'] = json_encode($mantenciones);
    } else {
        $_SESSION['refrescar_mantenciones'] = "<tr>No se encontraron datos.</tr>";
    }
    header('Location: ../../disenoConsulta1.php');
}

// Nueva función para obtener mantenciones con el estado
function obtenerMantencionesConEstado() {
    require_once __DIR__.'\..\SERVICIOS\mantencionesService.php';
    session_start();
    $mantencionesService = new MantencionesService($pdo);
    $mantenciones = $mantencionesService->getMantencionesConEstado();

    if ($mantenciones) {
        return json_encode($mantenciones);
    } else {
        return json_encode(array("error" => "No se encontraron resultados."));
    }
}

function listarTipoMantencion(){
    require_once __DIR__.'\..\SERVICIOS\mantencionesService.php';
    include __DIR__.'/../conexion.php';
    $mantencionesService = new MantencionesService($pdo);
    $listarTipo = $mantencionesService->listarTipoMantencion();
    if ($listarTipo) {
        return json_encode($listarTipo);
    } else {
        return json_encode(array('error'=> 'error'));
    }
}

?>
