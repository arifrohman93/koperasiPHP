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
	
	//START FUZZY
	$simpan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_simpanan) as simpan from t_simpan"));
	//echo $tabung['tabung'];
	$angsur=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_angsuran) as angsuran from t_angsur"));
	//echo $angsur['angsuran'];
	$denda=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(denda) as denda from t_angsur"));
	//echo $denda['denda'];

	$pinjam=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_pinjam) as pinjam from t_pinjam"));

	$ambil=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_ambil) as ambil from t_pengambilan"));
			
	$pendapatan=$simpan['simpan']+$angsur['angsuran']+$denda['denda'];
	$pengambilan=$pinjam['pinjam']+$ambil['ambil'];

	$sisa=$pendapatan-$pengambilan;

	$x_min=isset($_GET['x_min'])?$_GET['x_min']:500000;
	$x_max=isset($_GET['x_max'])?$_GET['x_max']:50000000;
	$y_min=isset($_GET['y_min'])?$_GET['y_min']:1000000;
	$y_max=isset($_GET['y_max'])?$_GET['y_max']:25000000;
	$z_min=isset($_GET['z_min'])?$_GET['z_min']:100000;
	$z_max=isset($_GET['z_max'])?$_GET['z_max']:5000000;

	$x=$pengambilan;			//pengeluaran saat ini
	$y=$pendapatan;				//persediaan saat ini
	$z=$besarpin;				//besar pinjaman


	//Pembentukan Himpunan Fuzzy (Fuzzyfication)
	//pengeluaran
	$ux_rendah=($x_max-$x)/($x_max-$x_min);
	$ux_tinggi=($x-$x_min)/($x_max-$x_min);

	//persediaan
	$uy_rendah=($y_max-$y)/($y_max-$y_min);
	$uy_tinggi=($y-$y_min)/($y_max-$y_min);

	//pengajuan pinjaman
	$uz_sedikit=($z_max-$z)/($z_max-$z_min);
	$uz_banyak=($z-$z_min)/($z_max-$z_min);

	//penerapan fungsi implikasi
	//1. IF pinjaman TINGGI AND simpanan TINGGI THEN jml BANYAK 
		$a_pred1=min($ux_tinggi,$uy_tinggi);
		$z1=$z_max-$a_pred1*($z_max-$z_min);

	//2. IF pinjaman TINGGI AND simpanan RENDAH THEN jml SEDIKIT 
		$a_pred2=min($ux_tinggi,$uy_rendah);
		$z2=$z_max-$a_pred2*($z_max-$z_min);

	//3. IF pinjaman RENDAH AND simpanan TINGGI THEN jml BANYAK 
		$a_pred3=min($ux_rendah,$uy_tinggi);
		$z3=$z_max-$a_pred3*($z_max-$z_min);
		
	//4. IF pinjaman RENDAH AND simpanan RENDAH THEN jml SEDIKIT 
		$a_pred4=min($ux_rendah,$uy_rendah);
		$z4=$z_max-$a_pred4*($z_max-$z_min);

	/*Defuzzyfication
	Menghitung z akhir dengan merata-rata semua z berbobot*/

	$n=$a_pred1*$z1+$a_pred2*$z2+$a_pred3*$z3+$a_pred4*$z4;
	$d=$a_pred1+$a_pred2+$a_pred3+$a_pred4;
	$zAkhir=$n/$d;
	$pinjamanTersedia = ceil($zAkhir);
	//END FUZZY
	
	if ($pinjamanTersedia > $z){
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
	} else if ($pinjamanTersedia < $z) {
		$sql=mysqli_query($koneksi,"UPDATE t_pengajuan SET status='ditolak' where kode_pengajuan='$kodep' and kode_anggota='$kodea'");
		if($sql)
		{ ?>
			<script>
				alert("Pengajuan Pinjam Ditolak karena keuangan sedang tidak stabil");
				window.location="../index.php?pilih=4.4&aksi=admin";
			</script>
		<?php
		}
		else
		{
			echo 'gagal';
		}
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