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
<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" href="css/theme1.css" />
</head>

<body>
<div class="row mt">
 <div class="col-lg-12">
   <div class="form-panel">
     <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Anggota 
     <?php
                        $am=mysqli_query($koneksi,"select*from t_anggota");
                        $jum=mysqli_num_rows($am);
                    echo'<kbd style="background-color:#d9534f;">'.$jum.'</kbd>';?><span style="float:right;">
<a href="laporan/print_anggota.php" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
                    </span></h4>
<?php
	if(empty($aksi)){
?>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th rowspan="2"><a href="#">No</a></th>
             <th><a href="#">Kode Anggota</a></th>
             <th><a href="#">Nama</a></th>
             <th><a href="#">TTL</a></th>
             <th><a href="#">Alamat</a></th>
             <th><a href="#">Kelamin</a></th>
             <th><a href="#">Pekerjaan</a></th>
             <th><a href="#">Tanggal Masuk</a></th>
             <th><a href="#">Status</a></th>
             <th><a href="#">Telepon</a></th>
             
       	</tr>		
    </thead><tbody>
    <?php
	$query = mysqli_query($koneksi,"SELECT * FROM t_anggota ORDER BY kode_anggota");
	$no=1;while($data=mysqli_fetch_array($query)){
?>
    	<tr>
			<td><?php echo $no;?></td>
            <td><?php echo $data['kode_anggota'];?></td>
            <td><?php echo $data['nama_anggota'];?></td>
            <td><?php echo $data['tempat_lahir'];?>, <?php echo $data['tgl_lahir'];?></td>
            <td><?php echo $data['alamat_anggota'];?></td>
            <td><?php echo $data['jenis_kelamin'];?></td>
            <td><?php echo $data['pekerjaan'];?></td>
            <td><?php echo $data['tgl_masuk'];?></td>
            <td><?php echo $data['status'];?></td>
            <td><?php echo $data['telp'];?></td>
        </tr> 
	  
<?php
		$no++;}
?>
</tbody> 
	</table>
	</form>
	</div></div></div><br>
<?php
}
?>

</body>
