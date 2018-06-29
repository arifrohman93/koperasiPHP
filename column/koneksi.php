<?php
	ini_set('display_errors',FALSE);
	$host	= "localhost";
	$user	= "root";
	$pass	= "";
	$db		= "koperasi";
	
	$koneksi=mysqli_connect($host,$user,$pass,$db);
	
	if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
	}
?>