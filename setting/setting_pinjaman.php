<?php  
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
?>

<?php
	// **STYLE FORM
?>
<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" href="css/theme1.css" />
</head>

<?php
	if(empty($aksi)){
?>
<body>  
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Setting Data Pinjaman
                    <span style="float:right;">
<a href="?pilih=4.2&aksi=tambah" class="btn btn-primary"><span class='glyphicon glyphicon-plus'></span> Tambah</a> 
                    </span></h4>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Jenis Pinjaman</a></th>
             <th><a href="#">Lama Angsur</a></th>
			 <th><a href="#">Maksimal Pinjam</a></th>
             <th><a href="#">Bunga</a></th>
			 <th><a href="#">Tanggal Entri</a></th>
             <th ><a>Aksi</a></th>
       	</tr>
    </thead><tbody>
<?php
$no=1;
$sql=mysqli_query($koneksi,"SELECT * FROM t_jenis_pinjam");
while($data=mysqli_fetch_array($sql)){
?>
    	<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $data['nama_pinjaman'];?></td>
			<td><?php echo $data['lama_angsuran'];?> Bulan</td>
			<td><?php echo Rp($data['maks_pinjam']);?></td>
			<td><?php echo $data['bunga'];?> %</td>
			<td><?php echo Tgl($data['tgl_entri']);?></td>
			<td align="center">
<a class="btn btn-success btn-xs" href=index.php?pilih=4.2&aksi=ubah&kode_jenis_pinjam=<?php echo $data['kode_jenis_pinjam'];?>><i class="glyphicon glyphicon-pencil"></i> Edit</a>
<script type="text/javascript">
    function hapus(){
    var msg = confirm("Apakah Anda yakin ?");
    if(msg==true){
    window.location="setting/proses_setting_pinjam.php?pros=hapus&kode_jenis_pinjam=<?php echo $data['kode_jenis_pinjam'];?>";  
    }
    else{
    
    }
    }
    </script>
<a class="btn btn-danger btn-xs" href="#" onclick="hapus();"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
			</td>
		</tr>   
<?php
	$no++;} //tutup while
?>
	</tbody></table></form></div></div></div>
<?php
	}elseif($aksi=='tambah'){
?>
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel" style="width:50%;">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Tambah Data Pinjaman</h4>
<form action="setting/proses_setting_pinjam.php?pros=tambah" method="post" id="form">
<div class="form-group">
 <label>Kode Pinjaman</label>
 <input type="text" class="form-control" name="kode_jenis_pinjam" size="54" value="<?php echo nomer($koneksi,"P","kode_jenis_pinjam","t_jenis_pinjam");?>" readonly/>
</div>
<div class="form-group">
<label>Jenis Pinjaman</label>
 <input type="text" class="form-control" name="nama_pinjaman" size="54"/>
</div>
<div class="form-group">
<label>Lama Angsur (bulan)</label>
 <input type="text" class="form-control" name="lama_angsuran" size="54"/>
</div>
<div class="form-group">
<label>Maksimal Pinjam</label>
<input type="text" class="form-control" name="maks_pinjam" size="54"/>
</div>
<div class="form-group">
<label>Bunga (%)</label>
 <input type="text" class="form-control" name="bunga" size="54"/>
</div>
<div class="form-group">
<label>User Entri</label>
<input type="text" class="form-control" name="u_entry" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>" readonly>
</div>
<div class="form-group">
<label>Tanggal Entri</label>
 <input type="text" class="form-control" name="tgl_entri" size="54" value="<?php echo date("Y-m-d");?>" readonly/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-pencil'></span> Tambah</button>
</form></div></div></div>
<?php
	}elseif($aksi=='ubah'){
		$kode=$_GET['kode_jenis_pinjam'];
		$q=mysqli_query($koneksi,"SELECT * FROM t_jenis_pinjam WHERE kode_jenis_pinjam='$kode'");
		$data2=mysqli_fetch_array($q);
?>
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel" style="width:50%;">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Ubah Data Pinjaman</h4>
<form action="setting/proses_setting_pinjam.php?pros=ubah" method="post" id="form">
<div class="form-group">
 <label>Kode Pinjaman</label>
 <input type="text" name="kode_jenis_pinjam" class="form-control" size="54" value="<?php echo $data2['kode_jenis_pinjam'];?>" readonly=""/>
</div>
<div class="form-group">
<label>Jenis Pinjaman</label>
 <input type="text" name="nama_pinjaman" class="form-control" size="54" value="<?php echo $data2['nama_pinjaman'];?>"/>
</div>
<div class="form-group">
<label>Lama Angsur (bulan)</label>
 <input type="text" class="form-control" class="form-control" name="lama_angsuran" size="54" value="<?php echo $data2['lama_angsuran'];?>"/>
</div>
<div class="form-group">
<label>Maksimal Pinjam</label>
<input type="text" name="maks_pinjam" class="form-control" size="54" value="<?php echo $data2['maks_pinjam'];?>"/>
</div>
<div class="form-group">
<label>Bunga (%)</label>
 <input type="text" class="form-control" class="form-control" name="bunga" size="54" value="<?php echo $data2['bunga'];?>"/>
</div>
<div class="form-group">
<label>Tanggal Entri</label>
 <input type="date" name="tgl_entri" class="form-control" size="54" value="<?php echo date("Y-m-d");?>" readonly/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-pencil'></span> Edit</button>
</form></div></div></div>
<?php
	}
?>
</body>

