<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('imagenes/Logo.png',10,5,22);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de Usuarios',1,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->cell(60, 10, utf8_decode('Nombre'), 1, 0, 'C', 0);
    $this->cell(60, 10, utf8_decode('Usuario'), 1, 0, 'C', 0);
    $this->cell(70, 10, utf8_decode('Fecha de Creación'), 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
require 'cn.php';
$consulta = "SELECT * FROM notas";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

while($row = $resultado->fetch_assoc()){
    $pdf->cell(60, 10, utf8_decode($row['titulo']), 1, 0, 'C', 0);
    $pdf->cell(60, 10, utf8_decode($row['descripcion']), 1, 0, 'C', 0);
    $pdf->cell(70, 10, utf8_decode($row['creacion']), 1, 1, 'C', 0);
}

$pdf->Output();
?>