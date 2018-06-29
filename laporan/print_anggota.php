<?php
include "../config/koneksi.php";

require('pdf/fpdf.php');
$pdf = new FPDF("L","cm","A4");


$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->MultiCell(19.5,0.5,'',0,'L'); 
$pdf->SetX(4);   
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->Image('../logo_kop.GIF',2,1.3,2,1.6);
$pdf->SetX(4); 
$pdf->MultiCell(19.5,0.5,'  " KOPERASI HEMAT PANGKAL KAYA "',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'  Alamat : Jl Raya Parigi No.840 parigi (Pangandaran)',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'  http://www.koperasihpk.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.2,0.7,"Laporan Seluruh Anggota",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Anggota', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Alamat', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kelamin', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Pekerjaan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Masuk', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Status', 1, 1, 'C');


$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($koneksi,"SELECT * FROM t_anggota");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(2, 0.8, $no , 1, 0, 'C');
    $pdf->Cell(3, 0.8, $lihat['kode_anggota'],1, 0, 'C');
    $pdf->Cell(4, 0.8, $lihat['nama_anggota'],1, 0, 'C');
    $pdf->Cell(4, 0.8, $lihat['alamat_anggota'],1, 0, 'C');
    $pdf->Cell(3, 0.8, $lihat['jenis_kelamin'], 1, 0,'C');
    $pdf->Cell(4, 0.8, $lihat['pekerjaan'],1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['tgl_masuk'],1, 0,'C');
	$pdf->Cell(2, 0.8, $lihat['status'],1, 1,'C');
    
    
    $no++;
}
$pdf->Output("Laporan Semua Anggota.pdf","I");

?>

