<?php
	include "../config/koneksi.php";
	require ('root.php');
	$lib = new root();
	$pros=$_GET['pros'];
	$kode_j=$_GET['kode_jenis_simpan'];
	$kode_jenis_simpan=$_POST['kode_jenis_simpan'];
	$nama_simpanan=$_POST['nama_simpanan'];
	$besar_simpanan=$_POST['besar_simpanan'];
	$u_entry=$_POST['u_entry'];
	$tgl_entri=$_POST['tgl_entri'];
	//$kode_j,$kode_jenis_simpan,$nama_simpanan,$besar_simpanan,$u_entry,$tgl_entri
	
	switch ($pros){	
		case "tambah" :
		$lib->tambahsimpan($koneksi,$kode_j,$kode_jenis_simpan,$nama_simpanan,$besar_simpanan,$u_entry,$tgl_entri);
		break;	
		
		case "ubah" :
		$lib->ubahsimpan($koneksi,$kode_j,$kode_jenis_simpan,$nama_simpanan,$besar_simpanan,$u_entry,$tgl_entri);
		break;		
		
		case "hapus" :
		$lib->hapussimpan($koneksi,$kode_j,$kode_jenis_simpan,$nama_simpanan,$besar_simpanan,$u_entry,$tgl_entri);
		break;
		
		default : break; 
	}
	
?>