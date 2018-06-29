<?php
include "../config/koneksi.php";
$kode=$_GET['kode_anggota'];
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
$pdf->Cell(25.2,0.7,"Laporan Pinjaman",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Pinjam', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Anggota', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tanggal Pinjam', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Jenis Pinjam', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Besar Pinjam', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Lama Angsuran', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Status', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$sql=mysqli_query($koneksi,"SELECT * from t_pinjam order by kode_pinjam desc");
    $nomer=1;
    while($data=mysqli_fetch_array($sql))
    	{
    		$kd_a=$data['kode_anggota'];
    		$anggota=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_anggota from t_anggota where kode_anggota='$kd_a'"));
    		$kd_j=$data['kode_jenis_pinjam'];
    		$jenis=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_pinjaman from t_jenis_pinjam where kode_jenis_pinjam='$kd_j'"));
$pdf->Cell(1, 0.8, $nomer , 1, 0, 'C');
$pdf->Cell(3, 0.8, $kd_p=$data['kode_pinjam'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $anggota['nama_anggota'], 1, 0, 'C');
$pdf->Cell(3, 0.8, $data['tgl_entri'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $jenis['nama_pinjaman'], 1, 0, 'C');
$pdf->Cell(4, 0.8, number_format($data['besar_pinjam']), 1, 0, 'C');
$pdf->Cell(3, 0.8, "".$data['lama_angsuran']." Bulan", 1, 0, 'C');
$jum=mysqli_num_rows(mysqli_query($koneksi,"SELECT*from t_angsur where kode_pinjam='$kd_p' and kode_anggota='$kd_a'"));$lama=mysqli_fetch_array(mysqli_query($koneksi,"SELECT lama_angsuran from t_pinjam where kode_pinjam='$kd_p' and kode_anggota='$kd_a'"));
			if($jum==$lama['lama_angsuran'])
			{
				$pdf->Cell(3, 0.8, 'Lunas', 1, 1, 'C');
			}
			else
			{
				$pdf->Cell(3, 0.8, 'Belum Lunas', 1, 1, 'C');
			}

    	$nomer++;}
$pdf->Output("Laporan Semua Pinjaman.pdf","I");

?>

