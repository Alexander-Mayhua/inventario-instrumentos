<?php
require_once('../fpdf/fpdf.php');

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "practica");
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Consulta de datos de préstamo
$query = "SELECT p.nombre, p.apellido, p.DNI, pi.fecha_prestamo, pi.fecha_devolucion, i.nombre AS instrumento, pi.tipo_transaccion, pi.estado_entrega 
          FROM PrestamoInstrumentos pi 
          JOIN Instrumentos i ON pi.instrumento_id = i.id 
          JOIN Usuario p ON pi.usuario_id = p.id";
$resultado = $mysqli->query($query);

// Crear el documento PDF
$pdf = new fpdf();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Reporte de Prestamos de Instrumentos', 0, 1, 'C');

// Agregar encabezado de columnas
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Nombre', 1);
$pdf->Cell(40, 10, 'Apellido', 1);
$pdf->Cell(30, 10, 'DNI', 1);
$pdf->Cell(30, 10, 'Instrumento', 1);
$pdf->Cell(30, 10, 'Fecha Prestamo', 1);
$pdf->Cell(30, 10, 'Fecha Devolucion', 1);
$pdf->Cell(30, 10, 'Estado', 1);
$pdf->Ln();

// Agregar datos de cada préstamo
$pdf->SetFont('Arial', '', 10);
while ($fila = $resultado->fetch_assoc()) {
    $pdf->Cell(40, 10, $fila['Nombre'], 1);
    $pdf->Cell(40, 10, $fila['Apellido'], 1);
    $pdf->Cell(30, 10, $fila['DNI'], 1);
    $pdf->Cell(30, 10, $fila['instrumento'], 1);
    $pdf->Cell(30, 10, $fila['fecha_prestamo'], 1);
    $pdf->Cell(30, 10, $fila['fecha_devolucion'], 1);
    $pdf->Cell(30, 10, $fila['estado_entrega'], 1);
    $pdf->Ln();
}

// Generar y descargar el PDF
$pdf->Output('D', 'Reporte_Prestamos_Instrumentos.pdf');
?>
