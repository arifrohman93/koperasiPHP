<?php
session_start();
$kode_anggota=$_GET['kode_anggota'];
$kode_tabung=$_GET['kode_tabungan'];
$besar=$_GET['besar_ambil'];
include "../config/koneksi.php";
$sqla=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_anggota where kode_anggota='$kode_anggota'"));
?>
<body onload="window.print()">
<h3><center><img src="../logo_kop.gif" width="60" height="60"><br>Bukti Transaksi pengambilan</center></h3>
<table style="margin-left:50px;">
	<tr>
		<td>Kode Anggota</td>
		<td>:</td>
		<td><?php echo $kode_anggota; ?></td>
	</tr>
	<tr>
		<td>Nama Anggota</td>
		<td>:</td>
		<td><?php echo $sqla['nama_anggota']; ?></td>
	</tr>
	<tr>
		<td>Kode Tabunngan</td>
		<td>:</td>
		<td><?php echo $kode_tabung; ?></td>
	</tr>
	<tr>
		<td>Besar Ambil</td>
		<td>:</td>
		<td><?php echo $besar; ?></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?php echo date("Y-m-d");?></td>
	</tr>
</table>
<table  border="0" align="center">
		<tr align="center">
			<td width="200" colspan="2">Diketahui oleh,</td>
			<td width="200" colspan="2">Diterima oleh,</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr align="center">
			<td width="200" colspan="2">_ _ _ _ _ _ _ _ _</td>
			<td width="200" colspan="2"><?php session_start(); echo $_SESSION['kopname'];?></td>
			<td width="200" colspan="2"><?php echo $data['nama_anggota'];?></td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
  </table>