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
		
	class Tabungan{
		private $saldo;
		function Tabungan($a){
			$this->saldo = $a;
		}
		function simpan($sim){
			$this->saldo = $this->saldo + $sim;
		}
		function pinjam($pin){
			$this->saldo = $this->saldo - $pin;
		}
		function cek_saldo(){
			return $this->saldo;
		}
	};
?>