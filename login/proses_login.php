<?php
session_start();

include "../config/koneksi.php";

// Dikirim dari form
$username=$_POST['username'];
$password=$_POST['password'];
$query=mysqli_query($koneksi,"SELECT * FROM t_user WHERE username='$username' AND password='$password'");
$jumlah=mysqli_num_rows($query);
$a=mysqli_fetch_array($query);

if($jumlah > 0){
	if($a['level']=='admin')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['kodeanggota']=$a['kode_petugas'];
	$_SESSION['kopid']=$a['kode_user'];
	$_SESSION['kopname']=$a['nama'];
	header("location:../index.php?pilih=home");
	}
	else if($a['level']=='anggota')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['kodeanggota']=$a['kode_petugas'];
	$_SESSION['kopid']=$a['kode_user'];
	$_SESSION['kopname']=$a['nama'];
	header("location:../index.php?pilih=home");
	}
	
}else{
?>
	<script>
		alert("Username Atau Password Salah");
		window.location="login.php";
	</script>
<?php
}
?>

