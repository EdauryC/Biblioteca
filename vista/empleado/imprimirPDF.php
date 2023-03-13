<?php

//Conexiones
require('../fpdf/fpdf.php'); //A FPDF

require("../../modelo/empleado.php");  //A base de datos
$carrera=new Empleado; 
$con=$carrera->conexion();

$registros=$carrera->SelectAll('empleado', $con);

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
    $this->Cell(30,10,'Reporte de Empleados',0,0,'C');
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
    $this->Cell(25, 10, utf8_decode('Cédula'), 0, 0, 'C', 1);
    $this->Cell(53, 10, 'Nombre', 0, 0, 'C', 1);
    $this->Cell(53, 10, 'Apellido', 0, 0, 'C', 1);
    $this->Cell(34, 10, utf8_decode('Usuario'), 0, 1, 'C', 1);
    $this->SetDrawColor(61, 174, 233);
    $this->SetLineWidth(1);
    $this->Line(10.5, $this->GetY(), 206.5, $this->GetY());
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
    $pdf->Cell(7, 10, $row['id_empleado'], 1, 0, 'C', 1);
    $pdf->Cell(25, 10, $row['n_cedula'], 1, 0, 'C', 1);
    $pdf->Cell(53, 10, $row['nombres'], 1, 0, 'L', 1);
    $pdf->Cell(53, 10, $row['apellidos'], 1, 0, 'L', 1);
    $pdf->Cell(34, 10, $row['usuario'], 1, 1, 'C', 1);
 }

$pdf->Output();
?>