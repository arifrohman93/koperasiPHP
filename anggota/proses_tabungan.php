<?php
include "../config/koneksi.php";
$kode_t=$_GET['kode_tabungan'];
$kode_a=$_GET['kode_anggota'];
$besar=$_GET['besar_ambil'];
$saldo=$_GET['saldo'];
$date=date("Y-m-d");
if($besar>$saldo)
{ ?>
	<script>alert("Maaf Saldo tidak cukup");window.location="../index.php?pilih=1.3";</script>
<?php }
else
{
	$dfop=mysqli_query($koneksi,"INSERT into t_pengambilan values('','$kode_a','$kode_t','$besar','$date')");
	$siso=$saldo-$besar;
	mysqli_query($koneksi,"UPDATE t_tabungan set besar_tabungan='$siso' where kode_tabungan='$kode_t' and kode_anggota='$kode_a'");?>
<script>window.open('notaambil.php?kode_anggota=<?php echo $kode_a; ?>&kode_tabungan=<?php echo $kode_t; ?>&besar_ambil=<?php echo $besar; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100');

window.location="../index.php?pilih=1.3&aksi=viewambil&kode_tabungan=<?php echo $kode_t; ?>&kode_anggota=<?php echo $kode_a; ?>";</script>
<?php }
?>