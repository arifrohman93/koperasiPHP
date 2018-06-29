<?php
session_start();

include "config/koneksi.php";

// Dikirim dari form
$currentPassword =$_POST['currentPassword'];
$newPassword	 =$_POST['newPassword'];
$confirmPassword =$_POST['confirmPassword'];
$kopid 			 =$_SESSION['kopid'];
$query=mysqli_query($koneksi,"SELECT * FROM t_user WHERE kode_user = '$kopid'");
$a=mysqli_fetch_array($query);
if ($currentPassword == $a["password"]) {
    mysqli_query($koneksi, "UPDATE t_user set password='$newPassword' WHERE kode_user = '$kopid'");
    header("location:index.php");
} else {
?>
	<script>
		alert("Current Password is not correct");
		window.location="index.php";
	</script>
<?php
}
?>

