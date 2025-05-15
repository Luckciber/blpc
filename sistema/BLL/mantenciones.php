<?php

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

    function enviarProductoInutilizable($idProducto){
  session_start();

  require_once __DIR__.'\..\SERVICIOS\mantencionesServices.php';
  $inventarioService = new MantencionesService($pdo);
  $reducir = $inventarioService->moverInutilizable(inventario_corr: $idProducto);
  if ($reducir) {
    $_SESSION['alerta_modal'] = '
      <div class="modal show" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5)">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Proceso realizado con éxito</h5>
              <a href="mantenciones.php" class="close">&times;</a>
            </div>
            <div class="modal-body">
              <p>El producto ha marcado una unidad como inutilizable.</p>
            </div>
            <div class="modal-footer">
              <a href="listaMantenciones.php" class="btn btn-success">OK</a>
            </div>
          </div>
        </div>
      </div>';
      header('Location: ../../listaMantenciones.php');
  } else {
    $_SESSION['alerta_modal'] = '
      <div class="modal show" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5)">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Error</h5>
              <a href="mantenciones.php" class="close">&times;</a>
            </div>
            <div class="modal-body">
              <p>Se ha producido un error en backend servidor.</p>
            </div>
            <div class="modal-footer">
              <a href="listaMantenciones.php" class="btn btn-secondary">Cerrar</a>
            </div>
          </div>
        </div>
      </div>';
      header('Location: ../../listaMantenciones.php');
    }
  }
}
?>
