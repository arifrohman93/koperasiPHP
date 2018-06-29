<?php
include '../config/koneksi.php';
$kode=$_GET['kode_anggota'];
$tanggal_masuk=$_GET['tgl_masuk'];
$nama=$_GET['nama_anggota'];
$jk=$_GET['jenis_kelamin'];
$tgllahir=$_GET['tgl_lahir'];
$tmplahir=$_GET['tmp_lahir'];
$alamat=$_GET['alamat_anggota'];
$tlp=$_GET['telp'];
$kerja=$_GET['pekerjaan'];
$entri=$_GET['tgl_entri'];
$sql=mysqli_query($koneksi,"UPDATE t_anggota SET nama_anggota='$nama',alamat_anggota='$alamat',jenis_kelamin='$jk',pekerjaan='$kerja',tgl_masuk='$tanggal_masuk',telp='$tlp',tempat_lahir='$tmplahir',tgl_lahir='$tgllahir',tgl_entri='$entri' WHERE kode_anggota='$kode'");
if($sql)
{
	header("location:../index.php?pilih=1.2");
}
else
{
	echo 'gagal';
}
?>