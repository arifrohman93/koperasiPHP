<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
?>
</head>

<?php
	if(empty($aksi)){
?>
<body>  
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Petugas<span style="float:right;">
<a href="index.php?pilih=4.7&aksi=tambah" class="btn btn-primary"><span class='glyphicon glyphicon-plus'></span> Tambah</a> 
                    </span></h4>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode petugas</a></th>
             <th><a href="#">Nama petugas</a></th>
             <th><a href="#">Alamat</a></th>
             <th><a href="#">Username</a></th>
             <th><a href="#">Password</a></th>
             <th colspan="3"><a>Aksi</a></th>
       	</tr>
		
    </thead><tbody><?php
		$query=mysqli_query($koneksi,"SELECT * FROM t_petugas 
							ORDER BY kode_petugas ASC");
	$no=1;
	while($data=mysqli_fetch_array($query)){
?>
    	<tr>
			<td align="center"	><?php echo $no;?></td>
            <td><?php echo $lagi=$data['kode_petugas'];?></td>
            <td><?php echo $data['nama_petugas'];?></td>
            <td><?php echo $data['alamat_petugas'];?></td>
            <?php $cinta=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_user where kode_petugas='$lagi' "));
             ?>
            <td><?php echo $cinta['username'];?></td>
            <td><?php echo $cinta['password'];?></td>
            <td align="center">
	<a class="btn btn-success btn-xs" href="index.php?pilih=4.7&aksi=ubah&kode_petugas=<?php echo $data['kode_petugas'];?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
  <script type="text/javascript">
    function hapus(){
    var msg = confirm("Apakah Anda yakin ?");
    if(msg==true){
    window.location="petugas/proses_petugas.php?pros=hapus&kode_petugas=<?php echo $lagi;?>";  
    }
    else{
    
    }
  }
    </script>
    <a class="btn btn-danger btn-xs" href="petugas/proses_petugas.php?pros=hapus&kode_petugas=<?php echo $lagi;?>"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
			</td>
        </tr>  
<?php
	$no++; } //tutup while
?>
</tbody> 
</table></form></div></div></div>
<?php
	}elseif($aksi=='tambah'){
?>

<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel" style="width:50%;">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Tambah Data Petugas</h4>
<form action="petugas/proses_petugas.php?pros=tambah" method="post">
<div class="form-group">
<label>Kode Petugas</label>
 <input type="text" class="form-control" name="kode_petugas" size="54" value="<?php echo nomer($koneksi,"P","kode_petugas","t_petugas");?>" readonly/>
</div>
<div class="form-group">
 <input type="hidden" class="form-control" name="kode_user" size="54" value="<?php echo nomer($koneksi,"U","kode_user","t_user");?>" readonly/>
</div>
<div class="form-group">
<label>Nama Petugas</label>
 <input type="text" class="form-control" name="nama_petugas"/>
</div>
<div class="form-group">
<label>Alamat Petugas</label>
 <input type="text" class="form-control" name="alamat_petugas"/>
</div>
<script>
  function isNumberKey(evt)
  {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

  return false;
  return true;
  }
</script>
<div class="form-group">
<label>Telepon</label>
 <input type="text" class="form-control" onkeypress="return isNumberKey(event);" name="telp"/>
</div>
<div class="form-group">
<label>Jenis Kelamin</label>
 <input type="radio"  name="jenis_kelamin" value="Laki-laki"> Laki-laki
 <input type="radio"  name="jenis_kelamin" value="Perempuan"/> 	Perempuan
</div>
<div class="form-group">
<label>User Entri</label>
 <input type="text"  readonly class="form-control" name="u_entry" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>"/>
</div>
<div class="form-group">
<label>Tanggal Entri</label>
 <input type="text"  readonly class="form-control" name="tgl_entri" value="<?php echo date("Y-m-d");?>" readonly/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-pencil'></span> Tambah</button>
</form>
</div></div></div>

<?php
	}elseif($aksi=='ubah'){
		$kode=$_GET['kode_petugas'];
		$qubah=mysqli_query($koneksi,"SELECT * FROM t_petugas WHERE kode_petugas='$kode'");
		$data2=mysqli_fetch_array($qubah);
?>
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel" style="width:50%;">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Ubah Data Petugas</h4>
<form action="petugas/proses_petugas.php?pros=ubah" method="post">
<input type="hidden" name="kode_petugas" value="<?php echo $kode ?>">
<div class="form-group">
<label>Nama Petugas</label>
 <input type="text" class="form-control" name="nama_petugas" size="54" value="<?php echo $data2['nama_petugas'];?>"/>
</div>
<div class="form-group">
<label>Alamat Petugas</label>
 <input name="alamat_petugas" class="form-control" value="<?php echo $data2['alamat_petugas'];?>">
</div>
<script>
  function isNumberKey(evt)
  {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

  return false;
  return true;
  }
</script>
<div class="form-group">
<label>Telepon</label>
 <input type="text" class="form-control" name="telp" onkeypress="return isNumberKey(event);" value="<?php echo $data2['no_telp'];?>"/>
</div>
<div class="form-group">
<label>Jenis Kelamin</label>
 <input type='radio' name='jenis_kelamin' value='Laki-laki' <?php  if ($data2['jenis_kelamin'] == "Laki-laki"){echo 'checked';}?>> Laki-laki
 <input type='radio' name='jenis_kelamin' value='Perempuan' <?php  if ($data2['jenis_kelamin'] == "Perempuan"){echo 'checked';}?>> Perempuan
</div>
<div class="form-group">
<label>User Entri</label>
 <input type="text" class="form-control" name="u_entry" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>" readonly>
</div>
<div class="form-group">
<label>Tanggal Entri</label>
 <input type="text" class="form-control" name="tgl_entri" size="54" value="<?php echo $data2['tgl_entri'];?>" readonly/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-pencil'></span> Ubah</button>
</form></div></div></div>
<?php
	}
?>

