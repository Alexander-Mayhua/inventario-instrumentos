<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../conexion/conexion.php'; //llamamos a la conexion BD
 
      $consulta_info = $conn->query("SELECT * FROM prestamoinstrumentos"); //traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('../img/insignia1.png', 250, 5, 40); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode("colegio esmeralda"), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : jr.maria jesus ruiz"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 966803941"), 0, 0, '', 0);
      $this->Ln(5);

      /* RUC */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("RUC : 20600669819"), 0, 0, '', 0);
      $this->Ln(10);



      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 95, 189);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE PRESTAMOS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(125, 173, 221); //colorFondo
      $this->SetTextColor(0, 0, 0); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(15, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('APELLIDO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('DNI'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('F-PRESTAMO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('F-ENTREGA'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('INSRUMENTOS'), 0, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('TIPO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('ESTADO'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../conexion/conexion.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte = $conn->query("SELECT prestamoinstrumentos.nombre, prestamoinstrumentos.apellido, prestamoinstrumentos.DNI, prestamoinstrumentos.fecha_prestamo, prestamoinstrumentos.fecha_devolucion, instrumentos.nombre AS 'nomInstrumento',prestamoinstrumentos.tipo_transaccion, prestamoinstrumentos.estado_entrega  FROM `prestamoinstrumentos` 
INNER JOIN instrumentos ON instrumentos.id=prestamoinstrumentos.instrumento_id");

while ($datos_reporte = $consulta_reporte->fetch_object()) {
   $i = $i + 1;
   /* TABLA */
   $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->nombre), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->apellido), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->DNI), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->	fecha_prestamo), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->	fecha_devolucion), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->nomInstrumento), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->tipo_transaccion), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->estado_entrega), 1, 1, 'C', 0);
  
}


$pdf->Output('Reporte prestamos.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)