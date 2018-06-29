<?php
	include "../config/koneksi.php";

$kode_anggota		= $_POST['kode_anggota'];	
// SIMPAN
$kode_simpan		= $_POST['kode_simpan'];
$tgl_simpan			= $_POST['tgl_simpan'];
$kode_jenis_simpan	= $_POST['kode_jenis_simpan']; 
$j=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_jenis_simpan where kode_jenis_simpan='$kode_jenis_simpan'"));
$jenis_simpan=$j['nama_simpanan'];
if($jenis_simpan=='wajib')
{
	$ambil=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM t_simpan where kode_anggota='$kode_anggota' and jenis_simpan='wajib' order by kode_simpan desc "));$num=mysqli_num_rows($ambil);
	if($ambil<=0)
	{
		$mulai=date("Y-m-d");
	$banding=date('Y-m-d',strtotime('+7 day',strtotime($mulai)));
	}
	else if($ambil>0)
	{
		$mulai=$ambil['tgl_mulai'];
	$banding=date('Y-m-d',strtotime('+7 day',strtotime($mulai)));
	}
}
else
{
	$banding=date("Y-m-d");
}
$besar_simpanan		= $_POST['besar_simpanan'];
$user_entri			= $_POST['user_entri'];
$tgl_entri			= $_POST['tgl_entri'];

// PINJAM
$kode_pinjam		= $_POST['kode_pinjam'];
$tgl_pinjam			= $_POST['tgl_pinjam'];
$kode_jenis_pinjam	= $_POST['kode_jenis_pinjam'];
$besar_pinjaman		= $_POST['besar_pinjaman'];
$besar_angsuran		= $_POST['besar_angsuran'];
$lama_angsuran		= $_POST['lama_angsuran'];
$u_entry			= $_POST['u_entry'];
$tgl_entri			= $_POST['tgl_entri'];

// ANGSUR
$kodekodean=$_POST['kode_pinjam'];
$tgl_angsur			= $_POST['tgl_angsur'];
$angsuran_ke		= $_POST['angsuran_ke'];
$sisa_angsuran		= $_POST['sisa_angsuran'];
$sisa_pinjaman		= $_POST['sisa_pinjaman'];
$u_entry			= $_POST['u_entry'];
$tgl_entri			= $_POST['tgl_entri'];
$besarangsu			= $_POST['besar_angsur'];
$denda=$_POST['denda'];$totalbayar=$besarangsu+$denda;
	
$pros=$_GET['pros'];

	switch($pros){
		case "simpan"	:
							$qtambah=mysqli_query($koneksi,"INSERT INTO t_simpan VALUES('','$jenis_simpan','$besar_simpanan','$kode_anggota','$user_entri','$banding','$tgl_entri')");
							$sqlbaru=mysqli_fetch_array(mysqli_query($koneksi,"SELECT besar_tabungan from t_tabungan where kode_anggota='$kode_anggota'"));
							$hasil=$sqlbaru['besar_tabungan']+$besar_simpanan;
							$q=mysqli_query($koneksi,"UPDATE t_tabungan SET besar_tabungan ='$hasil' 
					  						WHERE kode_anggota='$kode_anggota'");?>
							<script type="text/javascript">
								window.open('notasimpan.php?kode_anggota=<?php echo $kode_anggota; ?>&kode_jenis=<?php echo $kode_jenis_simpan; ?>&besar_simpan=<?php echo $besar_simpanan; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100');
								window.location="../index.php?pilih=2.1&aksi=simpanananggota&kode_anggota=<?php echo $kode_anggota; ?>";
							</script>
							<?php
							break;
		
		case "angsur"	:	$sql=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sisa_angsuran from 									t_pinjam where kode_pinjam='$kode_pinjam'"));
							$sisa_angsur=$sql['sisa_angsuran']-1;
							$sqla=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_pinjam where kode_pinjam='$kode_pinjam'"));$sisapinjam=$sqla['sisa_pinjaman'];
							$sqlp=mysqli_fetch_array(mysqli_query($koneksi,"SELECT besar_angsuran from t_pinjam where kode_pinjam='$kode_pinjam'"));$besarangsur=$sqlp['besar_angsuran'];
							$siso=$sisapinjam-$besarangsur;
							$lama_a=$aaa['lama_angsuran'];
							$ke=$lama_a-$sisa_angsur;
							$tempo=$sqla['tgl_tempo'];$lagitempo=date('Y-m-d',strtotime('+30 day',strtotime($tempo)));
							if($sqla['lama_angsuran']==$angsuran_ke)
							{
								mysqli_query($koneksi,"UPDATE t_pinjam set sisa_angsuran='$angsuran_ke',sisa_pinjaman='$siso',status='lunas' where kode_pinjam='$kode_pinjam'");
							}
							else
							{
								mysqli_query($koneksi,"UPDATE t_pinjam set sisa_angsuran='$angsuran_ke',sisa_pinjaman='$siso',tgl_tempo='$lagitempo' where kode_pinjam='$kode_pinjam'");
							}
							
							$aaa=mysqli_fetch_array(mysqli_query($koneksi,"SELECT lama_angsuran from t_pinjam where 						kode_pinjam='$kode_pinjam'"));
							
							$s=mysqli_query($koneksi,"INSERT INTO t_angsur VALUES('','$kode_pinjam','$angsuran_ke','$besarangsu','$denda','$siso','$kode_anggota','$u_entry','$tgl_entri')");
							if($s)
							{ ?>
								<script>
									window.open('notaangsur.php?kode_anggota=<?php echo $kode_anggota; ?>&kode_pinjam=<?php echo $kodekodean; ?>&besar=<?php echo $besarangsu; ?>&angsuran_ke=<?php echo $angsuran_ke; ?>&denda=<?php echo $denda; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100');
									window.location="../index.php?pilih=2.1&aksi=pinjamangsur&kode_anggota=<?php echo $kode_anggota;?>";
								</script>
							<?php }
							else
							{
								echo'gagal';
							}
							
							break;
	}
?>