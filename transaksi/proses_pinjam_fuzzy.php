<?php
include "../config/koneksi.php";
$kode_anggota		= $_GET['kode_anggota'];
$kode_jenis_pinjam	= $_GET['kode_jenis_pinjam'];
$besar_pinjaman		= $_GET['besar_pinjaman'];
$besar_angsuran		= $_GET['besar_angsuran'];
$lama_angsuran		= $_GET['lama_angsuran'];
$u_entry			= $_GET['u_entry'];
$tgl_entri			= $_GET['tgl_entri'];

$maks=$_GET['maks_pinjam'];

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
$z=$besar_pinjaman;			//besar pinjaman


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

if($pinjamanTersedia < $z)
{ ?>
		<script>
			alert("Maaf Keuangan masih tidak normal silahkan lakukan transaksi beberapa hari kedepan");
			window.location="../index.php?pilih=2.1&aksi=pinjamangsur&kode_anggota=<?php echo $kode_anggota;?>";
		</script>
	<?php }
else if($pinjamanTersedia > $z)
{
	if($besar_pinjaman>$maks)
	{ ?>
		<script>
			alert("Maaf besar pinjaman melebihi maksimal pinjam");
			window.location="../index.php?pilih=2.1&aksi=pinjamangsur&kode_anggota=<?php echo $kode_anggota;?>";
		</script>
	<?php }
	else if($besar_pinjaman<=$maks)
	{
		$tempo=date('Y-m-d',strtotime('+30 day',strtotime($tgl_entri)));
	$sql=mysqli_query($koneksi,"INSERT into t_pinjam values ('','$kode_anggota','$kode_jenis_pinjam','$besar_pinjaman','$besar_angsuran','$lama_angsuran','','$besar_pinjaman','$u_entry','$tgl_entri','$tempo','belum lunas')");
	if($sql)
	{ ?>
		<script>
		window.open('notapinjam.php?kode_anggota=<?php echo $kode_anggota; ?>&kode_jenis=<?php echo $kode_jenis_pinjam; ?>&besar_pinjaman=<?php echo $besar_pinjaman; ?>&besar_angsuran=<?php echo $besar_angsuran; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100');
		window.location="../index.php?pilih=2.1&aksi=pinjamangsur&kode_anggota=<?php echo $kode_anggota; ?>";
		</script>
	<?php }
	else
	{
		echo "gagal";
	}
	}	
}	

?>

