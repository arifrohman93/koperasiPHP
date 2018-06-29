<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
	$kategori = ($kategori=$_POST['kategori'])?$kategori : $_GET['kategori'];
	$cari = ($cari = $_POST['input_cari'])? $cari: $_GET['input_cari'];
?>

<?php
	// **STYLE FORM
?>
<?php
	if(empty($aksi)){
?>
<body>
<div class="row mt">
  <div class="col-lg-12">
     <div class="form-panel">
        <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Pinjaman
        <?php
                        $am=mysqli_query($koneksi,"select*from t_pinjam");
                        $jum=mysqli_num_rows($am);
                    echo'<kbd style="background-color:#d9534f;">'.$jum.'</kbd>';?>
        <span style="float:right;">
<a href="laporan/print_pinjaman.php" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
                    </span></h4>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Pinjam</a></th>
			 <th><a href="#">Nama Anggota</a></th>
             <th><a href="#">Tangggal Pinjam</a></th>
             <th><a href="#">Jenis Pinjam</a></th>
             <th><a href="#">Besar Pinjam</a></th>
             <th><a href="#">Lama Angsuran</a></th>
             <th><a href="#">Status</a></th>
			 <th><a href="#">Aksi</a></th>
       	</tr>
    </thead>
    <tbody>
    <?php $sql=mysqli_query($koneksi,"SELECT * from t_pinjam");
    $nomer=1;
    while($data=mysqli_fetch_array($sql))
    	{
    		$kd_a=$data['kode_anggota'];
    		$anggota=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_anggota from t_anggota where kode_anggota='$kd_a'"));
    		$kd_j=$data['kode_jenis_pinjam'];
    		$jenis=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_pinjaman from t_jenis_pinjam where kode_jenis_pinjam='$kd_j'"));
    		echo'<tr>
    		<td>'.$nomer.'</td>
			<td>'.$kd_p=$data['kode_pinjam'].'</td>
			<td>'.$anggota['nama_anggota'].'</td>
			<td>'.$data['tgl_entri'].'</td>
			<td>'.$jenis['nama_pinjaman'].'</td>
			<td>'.number_format($data['besar_pinjam']).'</td>
			<td>'.$data['lama_angsuran'].' Bulan</td>
			<td>';$jum=mysqli_num_rows(mysqli_query($koneksi,"SELECT*from t_angsur where kode_pinjam='$kd_p' and kode_anggota='$kd_a'"));$lama=mysqli_fetch_array(mysqli_query($koneksi,"SELECT lama_angsuran from t_pinjam where kode_pinjam='$kd_p' and kode_anggota='$kd_a'"));
			if($jum==$lama['lama_angsuran'])
			{
				echo 'Lunas';
			}
			else
			{
				echo 'Belum Lunas';
			}

			echo'</td>
			<td align="center">
			<a class="btn btn-primary btn-xs" href=index.php?pilih=3.3&aksi=show&kode_anggota='.$data['kode_anggota'].'&kode_pinjam='.$data['kode_pinjam'].'>Lihat Angsuran</a>
			</td>
        </tr>';
    	$nomer++;}?> 
	</tbody>   
	</table></form></div></div></div>
</div>

<?php 
	}elseif($aksi=='show'){
	$kode=$_GET['kode_anggota'];
	$kode_pinjam=$_GET['kode_pinjam'];
	$q=mysqli_query($koneksi,"SELECT*from t_angsur where kode_pinjam='$kode_pinjam' AND kode_anggota='$kode'");
	
?>
<div class="row mt">
  <div class="col-lg-12">
     <div class="form-panel">
        <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Angsuran "<?php $angg=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_anggota from t_anggota where kode_anggota='$kode'")); echo $angg['nama_anggota'];?>" 
       
        <span style="float:right;">
<a href="laporan/print_angsuran.php?kode_pinjam=<?php echo $kode_pinjam;?>&kode_anggota=<?php echo $kode; ?>" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
                    </span></h4>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Angsuran</a></th>
             <th><a href="#">Kode Pinjam</a></th>
             <th><a href="#">Tanggal Angsuran</a></th>
             <th><a href="#">Angsuran ke</a></th>
             <th><a href="#">Besar Angsuran</a></th>
             <th><a href="#">Denda</a></th>
			 
       	</tr>
    </thead><tbody>
<?php
	$no=1;
	while($ang=mysqli_fetch_array($q)){
?>
    	<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $ang['kode_angsur'];?></td>
			<td><?php echo $l=$ang['kode_pinjam'];?></td>
			<td><?php echo $ang['tgl_entri'];?></td>
			<td><?php echo $ang['angsuran_ke'];?></td>
			<td><?php echo $ang['besar_angsuran'];?></td>
            <td><?php echo $ang['denda'];?></td>
        </tr>
<?php
	$no++;}
?>
	</tbody></table></form></div></div></div>

<?php
}
?>

</body>