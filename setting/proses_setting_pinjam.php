<?php 
	include "../config/koneksi.php";
	require ('root.php');
	$lib= new root();
	$pros=$_GET['pros'];
	$kode=$_GET['kode_jenis_pinjam'];
	
	$kode_jenis_pinjam=$_POST['kode_jenis_pinjam'];
	$nama_pinjaman=$_POST['nama_pinjaman'];
	$lama_angsur=$_POST['lama_angsuran'];
	$maks_pinjam=$_POST['maks_pinjam'];
	$u_entry=$_POST['u_entry'];
	$bunga=$_POST['bunga'];
	$c=$bunga;
	$tgl_entri=$_POST['tgl_entri'];
	//$kode,$kode_jenis_pinjam,$nama_pinjaman,$lama_angsur,$maks_pinjam,$u_entry,$bunga,$c,$tgl_entri
	
	switch ($pros){		
		case "tambah" :
			$lib->tambahpinjam($koneksi,$kode,$kode_jenis_pinjam,$nama_pinjaman,$lama_angsur,$maks_pinjam,$u_entry,$bunga,$c,$tgl_entri);
				
		break;
		
		case "ubah" :
			$lib->ubahpinjam($koneksi,$kode,$kode_jenis_pinjam,$nama_pinjaman,$lama_angsur,$maks_pinjam,$u_entry,$bunga,$c,$tgl_entri);
		break;		
		
		case "hapus" :
			$lib->hapuspinjam($koneksi,$kode,$kode_jenis_pinjam,$nama_pinjaman,$lama_angsur,$maks_pinjam,$u_entry,$bunga,$c,$tgl_entri);
		break;
		
		default : break; 
	}
	
?>