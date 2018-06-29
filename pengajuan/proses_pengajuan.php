<?php
include "../config/koneksi.php";
$proses=$_GET['proses'];
if($proses=='tolak')
{
	$kodep=$_GET['kode_pengajuan'];
	$kodea=$_GET['kode_anggota'];
	$sql=mysqli_query($koneksi,"UPDATE t_pengajuan SET status='ditolak' where kode_pengajuan='$kodep' and kode_anggota='$kodea'");
	if($sql)
	{ ?>
		<script>
			alert("Pengajuan Pinjam Ditolak");
			window.location="../index.php?pilih=4.4&aksi=admin";
		</script>
	<?php
	}
	else
	{
		echo 'gagal';
	}
}
else if($proses=='terima')
{
	$kodep=$_GET['kode_pengajuan'];
	$kodea=$_GET['kode_anggota'];
	$date=date("Y-m-d");
	$sqla=mysqli_query($koneksi,"UPDATE t_pengajuan set tgl_acc='$date',status='diterima' where kode_pengajuan='$kodep' and kode_anggota='$kodea'");
	$sqlb=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_pengajuan where kode_pengajuan='$kodep' and kode_anggota='$kodea'"));
	$anggota=$sqlb['kode_anggota'];
	$jenis=$sqlb['kode_jenis_pinjam'];
	$besarpin=$sqlb['besar_pinjam'];
	$oo=mysqli_fetch_array(mysqli_query($koneksi,"SELECT*from t_jenis_pinjam where kode_jenis_pinjam='$jenis'"));
      $asli=$besarpin/$oo['lama_angsuran'];
      $bung=$oo['bunga']/100;
      $bunganya=$besarpin*$bung;
      $total=$asli+$bunganya;
    $lama=$oo['lama_angsuran'];
    $tempo=date('Y-m-d',strtotime('+30 day',strtotime($date)));
    $sqlc=mysqli_query($koneksi,"INSERT into t_pinjam values('','$anggota','$jenis','$besarpin','$total','$lama','','$besarpin','','$date','$tempo','belum lunas')");
    if($sqlc)
	{ ?>
		<script>
			alert("Pengajuan Pinjam Diterima,data secara otomatis masuk di peminjaman");
			window.location="../index.php?pilih=4.4&aksi=admin";
		</script>
	<?php
	}
	else
	{
		echo 'gagal';
	}
}
else if($proses=='hapus')
{
	$kodep=$_GET['kode_pengajuan'];
	$kodea=$_GET['kode_anggota'];
	$sql=mysqli_query($koneksi,"DELETE from t_pengajuan where kode_pengajuan='$kodep' and kode_anggota='$kodea'");
	if($sql)
	{ ?>
		<script>
			alert("Pengajuan Pinjam Dihapus");
			window.location="../index.php?pilih=4.4&aksi=admin";
		</script>
	<?php
	}
	else
	{
		echo 'gagal';
	}
}
else if($proses=='tambah')
{
	$kode_pengajuan=$_POST['kode_pengajuan'];$tgl_pengajuan=$_POST['tgl_pengajuan'];$kode_anggota=$_POST['kode_anggota'];$kode_jenis=$_POST['kode_jenis_pinjam'];$besar_pinjam=$_POST['besar_pinjam'];
	$polo=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_jenis_pinjam where kode_jenis_pinjam='$kode_jenis' "));
	$hasil=$polo['maks_pinjam'];
	if($besar_pinjam>$hasil)
	{ ?>
	<script>
			alert("besar melebihi maksimal pinjam");
			window.location="../index.php?pilih=4.4&aksi=anggota&kode_anggota=<?php echo $kode_anggota; ?>";
	</script>
	 <?php }
	else
	{
	$sql=mysqli_query($koneksi,"INSERT into t_pengajuan values('$kode_pengajuan','$tgl_pengajuan','$kode_anggota','$kode_jenis','$besar_pinjam','','menunggu')");
	if($sql)
	{
		header("location:../index.php?pilih=4.4&aksi=anggota&kode_anggota=".$kode_anggota."");
	}
	else
	{
		echo 'gagal';
	}
}
	
}
?>