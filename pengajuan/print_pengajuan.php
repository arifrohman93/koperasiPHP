<?php
include "../config/koneksi.php";
$kode_peng=$_GET['kode_pengajuan'];
$sesi=$_GET['sesion'];
require('../laporan/pdf/fpdf.php');
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
$pdf->Cell(25.2,0.7,"Pengajuan Pinjaman Anggota",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25, 0.7, 'Yang bertanda tangan dibawah ini adalah anggota dari koperasi simpan pinjam, memeberitahukan bahwa ada anggota yang melakukan pengajuan ', 0, 1, 'L');
$pdf->Cell(25, 0.7,'pinjaman dan sudah di terima oleh admin, maka saya meminta izin untuk meminjamkan uang kepada anggota dengan detail sebagai berikut :', 0, 1, 'L'); 
$rino=mysqli_fetch_array(mysqli_query($koneksi,"SELECT *from t_pengajuan where kode_pengajuan='$kode_peng' "));
$veno=$rino['kode_anggota'];
$verida=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM t_anggota where kode_anggota='$veno' "));
$pdf->Cell(25, 0.7, '', 0, 1, 'L');
$pdf->Cell(5, 0.7, 'Nama', 0, 0, 'L');
$pdf->Cell(2, 0.7, ':', 0, 0, 'L');
$pdf->Cell(10, 0.7, $verida['nama_anggota'], 0, 1, 'L');
$pdf->Cell(5, 0.7, 'Tanggal Pengajuan', 0, 0, 'L');
$pdf->Cell(2, 0.7, ':', 0, 0, 'L');
$pdf->Cell(10, 0.7, $rino['tgl_pengajuan'], 0, 1, 'L');
$pdf->Cell(5, 0.7, 'Besar Pinjam', 0, 0, 'L');
$pdf->Cell(2, 0.7, ':', 0, 0, 'L');
$pdf->Cell(10, 0.7, $rino['besar_pinjam'], 0, 1, 'L');
$pdf->Cell(5, 0.7, 'Tanggal ACC', 0, 0, 'L');
$pdf->Cell(2, 0.7, ':', 0, 0, 'L');
$pdf->Cell(10, 0.7, $rino['tgl_acc'], 0, 1, 'L');
$pdf->Cell(5, 0.7, 'Status', 0, 0, 'L');
$pdf->Cell(2, 0.7, ':', 0, 0, 'L');
$pdf->Cell(10, 0.7, $rino['status'], 0, 1, 'L');
$pdf->Cell(25, 0.7, '', 0, 1, 'L');

$pdf->Cell(25, 0.7, 'Maka dengan ini saya berharap untuk admin menyetujui bukti yang telah saya berikan.', 0, 1, 'L');
$pdf->Cell(25, 0.7, 'Diketahui Oleh', 0, 1, 'L');
$pdf->Cell(12, 0.7, 'Admin', 0, 0, 'C');
$pdf->Cell(12, 0.7, 'Anggota', 0, 1, 'C');
$pdf->Cell(25, 0.7, '', 0, 1, 'L');
$pdf->Cell(25, 0.7, '', 0, 1, 'L');
$pdf->Cell(12, 0.7, '.............', 0, 0, 'C');
$pdf->Cell(12, 0.7, $sesi, 0, 1, 'C');


$pdf->Output("Pengajuan.pdf","I");

?>

