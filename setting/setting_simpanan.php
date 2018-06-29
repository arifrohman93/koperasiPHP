<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
?>

<?php
	// **STYLE FORM
?>
</head>

<?php
	if(empty($aksi)){
?>
<body>  
         	            
<div class="row mt">
  <div class="col-lg-12">
     <div class="form-panel">
        <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Setting Data Simpanan
        <?php
         $am=mysqli_query($koneksi,"select*from t_jenis_simpan");
         $jum=mysqli_num_rows($am);
         echo'<kbd style="background-color:#d9534f;">'.$jum.'</kbd>';?><span style="float:right;">
         <?php if($jum<=2){echo '<a class="btn btn-primary" href="?pilih=4.1&aksi=tambah"><i class="glyphicon glyphicon-plus"></i> Tambah</a>';}else{echo'<a class="btn btn-primary" href="?pilih=4.1&aksi=tambah" disabled="disabled"><i class="glyphicon glyphicon-plus"></i> Tambah</a>';} ?>
         </span></h4>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Jenis Simpanan</a></th>
             <th><a href="#">Besar Simpanan</a></th>
             <th><a href="#">User Entri</a></th>
			 <th><a href="#">Tanggal Entri</a></th>
             <th><a>Aksi</a></th>
       	</tr>
    </thead><tbody>
<?php
$no=1;
$sql=mysqli_query($koneksi,"SELECT * FROM t_jenis_simpan");
while($data=mysqli_fetch_array($sql)){
?>
    	<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $data['nama_simpanan'];?></td>
			<td><?php echo number_format($data['besar_simpanan']);?></td>
			<td><?php echo $data['u_entry'];?></td>
			<td><?php echo Tgl($data['tgl_entri']);?></td>
			<td align="center">
<a class="btn btn-success btn-xs" href=index.php?pilih=4.1&aksi=ubah&kode_jenis_simpan=<?php echo $data['kode_jenis_simpan'];?>><i class="glyphicon glyphicon-pencil"></i> Edit</a>
<script type="text/javascript">
    function hapus(){
    var msg = confirm("Apakah Anda yakin ?");
    if(msg==true){
    window.location="setting/proses_setting_simpan.php?pros=hapus&kode_jenis_simpan=<?php echo $data['kode_jenis_simpan'];?>";  
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
            <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Tambah Data Simpanan <span style="font-size:12px;">*gunakan huruf kecil</span></h4>
<form action="setting/proses_setting_simpan.php?pros=tambah" method="post" id="form">
<div class="form-group">
 <label>Kode Simpanan</label>
 <input type="text" class="form-control" name="kode_jenis_simpan" size="54" value="<?php echo nomer($koneksi,"S","kode_jenis_simpan","t_jenis_simpan");?>" readonly/>
</div>
<div class="form-group">
 <label>Jenis Simpanan</label>
 <input type="text" class="form-control" name="nama_simpanan" size="54"/>
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
 <label>Besar Simpanan</label>
 <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="besar_simpanan" size="54"/>
</div>
<div class="form-group">
 <label>User Entri</label>
 <input type="text" class="form-control" name="u_entry" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>" readonly>
</div>
<div class="form-group">
 <label>Tanggal Entri</label>
 <input type="text" class="form-control" name="tgl_entri" size="54" value="<?php echo date("Y-m-d");?>" readonly/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-ok'></span> Simpan</button>
</form>
</div></div></div>
    
<?php
	}elseif($aksi=='ubah'){
		$kode=$_GET['kode_jenis_simpan'];
		$qubah=mysqli_query($koneksi,"SELECT * FROM t_jenis_simpan WHERE kode_jenis_simpan='$kode'");
		$data2=mysqli_fetch_array($qubah);
?>

<div class="row mt">
     <div class="col-lg-12">
        <div class="form-panel" style="width:50%;">
            <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Edit Data Simpanan <span style="font-size:12px;">*gunakan huruf kecil</span></h4>
<form action="setting/proses_setting_simpan.php?pros=ubah" method="post" id="form">
<div class="form-group">
 <label>Kode Simpanan</label>
 <input type="text" class="form-control" name="kode_jenis_simpan" size="54" value="<?php echo $data2['kode_jenis_simpan'];?>" readonly=""/>
</div>
<div class="form-group">
 <label>Jenis Simpanan</label>
 <input type="text" class="form-control" name="nama_simpanan" size="54" value="<?php echo $data2['nama_simpanan'];?>"/>
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
 <label>Besar Simpanan</label>
 <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="besar_simpanan" size="54" value="<?php echo $data2['besar_simpanan'];?>"/>
</div>
<div class="form-group">
 <label>User Entri</label>
 <input type="text" class="form-control" name="u_entry" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>" readonly="">
</div>
<div class="form-group">
 <label>Tanggal Entri</label>
 <input type="date" class="form-control" name="tgl_entri" size="54" value="<?php echo $data2['tgl_entri'];?>" readonly=""/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-pencil'></span> Edit</button>
</form>
</div>
</div></div>
<?php
	}
    ?>
</body>

