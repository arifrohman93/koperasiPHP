<?php
include "config/koneksi.php";
$kode_jenis_simpan = $_POST['kode_jenis_simpan'];

if($kode_jenis_simpan!=""){
	$sql = "SELECT * 
			FROM t_jenis_simpan 
			WHERE kode_jenis_simpan='$kode_jenis_simpan'";
	$data = mysqli_query($koneksi,$sql);
	if($d = mysqli_fetch_object($data)){
		$arr = array("BESAR_SIMPANAN"=>$d->besar_simpanan);
	}else{
		$arr = array("BESAR_SIMPANAN"=>"");
	}
	$arr = json_encode($arr);
	exit($arr);
}
?>
