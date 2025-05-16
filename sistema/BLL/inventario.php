<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar_producto'])) {
        $idProducto = $_POST['eliminar_producto']; 
        productoDefectuoso($idProducto);
        exit;
    }
}
function obtenerInventario()   {
    require_once __DIR__.'\..\SERVICIOS\inventarioServices.php';
    session_start();
    $inventarioService = new InventarioService($pdo);
    $inventario = $inventarioService->getInventario();
    
    if ($inventario) {
        return json_encode($inventario);
    } else {
        return json_encode(array("error" => "No se encontraron resultados."));
    }
}

function productoDefectuoso($idProducto){
  session_start();

  require_once __DIR__.'\..\SERVICIOS\inventarioServices.php';
  $inventarioService = new InventarioService($pdo);
  $reducir = $inventarioService->reducirInventario(inventario_corr: $idProducto);
  if ($reducir) {
    $_SESSION['alerta_modal'] = '
      <div class="modal show" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5)">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Proceso realizado con éxito</h5>
              <a href="inventario.php" class="close">&times;</a>
            </div>
            <div class="modal-body">
              <p>El producto ha marcado una unidad como inutilizable.</p>
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
              <h5 class="modal-title">Error</h5>
              <a href="inventario.php" class="close">&times;</a>
            </div>
            <div class="modal-body">
              <p>Se ha producido un error en backend servidor.</p>
            </div>
            <div class="modal-footer">
              <a href="listaInventario.php" class="btn btn-secondary">Cerrar</a>
            </div>
          </div>
        </div>
      </div>';
      header('Location: ../../listaInventario.php');
    }
  }
function editarInventario($inventario_corr, $inventario_nombre, $inventario_descripcion, $inventario_cantidad) {
    require_once __DIR__.'\..\SERVICIOS\inventarioServices.php';
    session_start();
    $inventarioService = new InventarioService($pdo);
    $resultado = $inventarioService->editInventario($inventario_corr, $inventario_nombre, $inventario_descripcion, $inventario_cantidad);
    
    if ($resultado) {
        return json_encode(array("success" => "Inventario editado correctamente."));
    } else {
        return json_encode(array("error" => "Error al editar el inventario."));
    }
}


?>