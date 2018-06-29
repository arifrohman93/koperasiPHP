<?php
include "../../config/koneksi.php";
$proses=$_GET['proses'];
if($proses=='tambah')
{
	$kode_pengajuan=$_POST['kode_pengajuan'];$tgl_pengajuan=$_POST['tgl_pengajuan'];$kode_anggota=$_POST['kode_anggota'];$kode_jenis=$_POST['kode_jenis_pinjam'];$besar_pinjam=$_POST['besar_pinjam'];
	$sql=mysqli_query($koneksi,"INSERT into t_pengajuan values('$kode_pengajuan','$tgl_pengajuan','$kode_anggota','$kode_jenis','$besar_pinjam','','menunggu')");
	if($sql)
	{
		header("location:../area.php?pilih=pengajuan");
	}
	else
	{
		echo 'gagal';
	}
	
}
?>

