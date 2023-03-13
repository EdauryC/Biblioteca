<?php

//Conexiones
require('../fpdf/fpdf.php'); //A FPDF

require("../../modelo/prestamo.php");  //A base de datos
$carrera=new Prestamo; 
$con=$carrera->conexion();

$registros=$carrera->SelectAll('prestamo', $con);

class PDF extends FPDF
{

// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',16); 
    $this->SetTextColor(50, 50, 50);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Reporte de prestamos',0,0,'C');
    $this->SetDrawColor(61, 174, 233);
    $this->SetLineWidth(1);
    $this->Line(50, $this->GetY() + 10, 158, $this->GetY() + 10);
    // Salto de línea
    $this->Ln(15);

    $this->SetFont('Arial', 'B',10);
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(40, 40, 40);
    $this->SetDrawColor(88, 88, 88);
    $this->Cell(7, 10, 'ID', 0, 0, 'C', 1);
    $this->Cell(20, 10, utf8_decode('Status'), 0, 0, 'C', 1);
    $this->Cell(45, 10, utf8_decode('Fecha de préstamo'), 0, 0, 'C', 1);
    $this->Cell(50, 10, 'Fecha de vencimiento', 0, 0, 'C', 1);
    $this->Cell(35, 10, 'Usuario', 0, 0, 'C', 0);
    $this->Cell(35, 10, utf8_decode('Empleado'), 0, 1, 'C', 1);
    $this->SetDrawColor(61, 174, 233);
    $this->SetLineWidth(1);
    $this->Line(10.5, $this->GetY(), 201.5, $this->GetY());
    $this->Settextcolor(0, 0, 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    $this->Write(5, 'Libros');
    // Número de página
    $this->Cell(0,10,utf8_decode('').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->Setlinewidth(0.3);
$pdf->Setfillcolor(240, 240, 240);
$pdf->settextcolor(40, 40, 40);
$pdf->setdrawcolor(255, 255, 255);

while($row = $registros->fetch_assoc()){
    $pdf->Cell(7, 10, $row['id_prestamo'], 1, 0, 'C', 1);
    $pdf->Cell(20, 10, $row['status'], 1, 0, 'C', 1);
    $pdf->Cell(45, 10, $row['fecha_prestamo'], 1, 0, 'L', 1);
    $pdf->Cell(50, 10, $row['fecha_vencimiento'], 1, 0, 'L', 1);
    $pdf->Cell(35, 10, $row['usuario_id_usuario'], 1, 0, 'C', 1);
    $pdf->Cell(35, 10, $row['empleado_id_empleado'], 1, 1, 'C', 1);
 }

$pdf->Output();
?>