<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint N°02</title>
</head>

<body>
    <h2><b><center>Consulta BD para reporte para listar solo mantenciones</center></b></h2>
    <br><br>
    
    <center>
        <form method="post">
            <h3>
                <label for="tipo_herramienta">Tipo de herramienta:</label>
                <select id="tipo_herramienta" name="tipo_herramienta" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="man">Herramientas Manuales</option>
                    <option value="ina">Herramientas Inalámbricas</option>
                    <option value="ele">Herramientas Eléctricas</option>
                    <option value="hid">Herramientas Hidráulicas</option>
                    <option value="otr">Otras Herramientas</option>
                    <option value="Todas">Todas las Herramientas</option>
                </select>
            </h3>

            <h3>Desde: <input type="date" name="fecha_desde" value="<?php echo isset($_POST['fecha_desde']) ? $_POST['fecha_desde'] : ''; ?>" required></h3>
            <h3>Hasta: <input type="date" name="fecha_hasta" value="<?php echo isset($_POST['fecha_hasta']) ? $_POST['fecha_hasta'] : ''; ?>" required></h3>

            <h1>
                <input type="submit" name="btn_filtrar" value="Filtrar">
                <input type="submit" name="btn_limpiar" value="Limpiar Filtros">
            </h1>
        </form>
    </center>

    <?php
    error_reporting(0);

    include("../funciones.php"); 
    $cnn = Conectar();

    if (isset($_POST['btn_filtrar'])) {
        $tipo_herramienta = $_POST['tipo_herramienta'];
        $fecha_desde = $_POST['fecha_desde'];
        $fecha_hasta = $_POST['fecha_hasta'];

        // Armamos condición para tipo herramienta
        $condicion_tipo = "";
        if ($tipo_herramienta != "Todas" && $tipo_herramienta != "") {
            $condicion_tipo = "AND i.descripcion LIKE '%$tipo_herramienta%'";
        }

        // Consulta agrupada
        $sql = "SELECT 
                    i.descripcion,
                    SUM(i.stock_actual) AS stock_total
                FROM movimientos m
                LEFT JOIN inventario i ON m.id_inventario = i.inventario_corr
                WHERE m.fecha_movimiento BETWEEN '$fecha_desde' AND '$fecha_hasta'
                $condicion_tipo
                GROUP BY i.descripcion
                ORDER BY i.descripcion ASC";

        $rs = mysqli_query($cnn, $sql);

        if ($rs) {
            echo "<center><table border='1' cellpadding='10'>";
            echo "<tr style='background-color: #c0e4f3;'>";
            echo "<th>Descripción de Herramienta</th>";
            echo "<th>Stock Total</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($rs)) {
                echo "<tr>";
                echo "<td>" . ($row['descripcion'] ?? 'Sin descripción') . "</td>";
                echo "<td>{$row['stock_total']}</td>";
                echo "</tr>";
            }

            echo "</table></center>";
        } else {
            echo "<center><b>Error en la consulta: " . mysqli_error($cnn) . "</b></center>";
        }
    }

    if (isset($_POST['btn_limpiar'])) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>
    <br><br>
</body>
</html>