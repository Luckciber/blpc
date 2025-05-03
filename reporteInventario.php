<?php
require('vendor/fpdf186/fpdf.php');
require_once('sistema/bll/inventario.php');
$data = obtenerInventario();
$data = json_decode($data, true);


class PDF extends FPDF
{
    function Header()
    {
        // Título del informe
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Reporte de Inventario Herramientas',0,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'BLPC',0,1,'C');
        $this->Ln(5);
    }

    function Footer()
    {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Fecha: '.date('d/m/Y').' - Hora: '.date('H:i:s'),0,0,'C');
    }

    function FancyTable($header, $data)
    {
        // Colores, fuente y estilo del encabezado
        $this->SetFillColor(200,200,200);
        $this->SetTextColor(0);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');

        // Ancho de columnas
        $w = array(100, 40, 40);

        // Cabecera
        for($i=0; $i<count($header); $i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();

        // Restaurar colores y fuente
        $this->SetFillColor(240,240,240);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Datos
        $fill = false;
        foreach($data as $row) {
            $this->Cell($w[0],6,$row['descripcion'],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row['inventario_corr'],'LR',0,'C',$fill);
            $this->Cell($w[2],6,$row['stock_actual'],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }

        // Línea final
        $this->Cell(array_sum($w),0,'','T');
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// Encabezados de columnas
$header = array('Descripcion Herramienta', 'Codigo', 'Stock Actual');

// Generar tabla
$pdf->FancyTable($header, $data);

// Salida del PDF
$pdf->Output();
?>
