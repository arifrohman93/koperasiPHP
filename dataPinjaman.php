<?php
include "config/koneksi.php";
$kode_pinjam = $_POST['kode_pinjam'];

if($kode_pinjam!=""){
	$sql = "SELECT * 
			FROM t_pinjam WHERE kode_pinjam='$kode_pinjam'";
	$data = mysqli_query($koneksi,$sql);
	if($d = mysqli_fetch_object($data)){
		$arr = array("TGL_PINJAM"=>$d->tgl_entri,
			"BESAR_PINJAM"=>$d->besar_pinjam,
			"LAMA_ANGSURAN"=>$d->lama_angsuran,
			"BESAR_ANGSURAN"=>$d->besar_angsuran,
			"SISA_ANGSURAN"=>$d->sisa_angsuran+1
			);
	}else{
		$arr = array("TGL_PINJAM"=>"",
			"BESAR_PINJAM"=>"",
			"LAMA_ANGSURAN"=>"",
			"BESAR_ANGSURAN"=>"");
	}
	$arr = json_encode($arr);
	exit($arr);
}
?>
