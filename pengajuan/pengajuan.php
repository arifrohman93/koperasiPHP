<head>
<script src="jquery.js"></script>

<script type="text/javascript">
      $(document).ready(function() {
        $("#cari").keyup(function(){
        $("#fbody").find("tr").hide();
        var data = this.value.split("");
        var jo = $("#fbody").find("tr");
        $.each(data, function(i, v)
        {
              jo = jo.filter("*:contains('"+v+"')");
        });
          jo.fadeIn();

        })
  });

</script>

</head>
<?php 
$aksi=$_GET['aksi'];
if($aksi=='admin')
{
 ?>
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Pengajuan
                       <span style="float:right;"> <input type="text" id="cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari disini...">

                    </span></h4>
   <form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode</a></th>
             <th><a href="#">Nama Anggota</a></th>
             <th><a href="#">Tanggal Pengajuan</a></th>
             <th><a href="#">Besar Pinjam</a></th>
             <th><a href="#">Jenis Pinjam</a></th>
             <th><a href="#">Status</a></th>
             <th><a href="#">Tanggal Terima</a></th>
             <th><a>Aksi</a></th>
        </tr>
    
    </thead><tbody id="fbody">
<?php
include "config/koneksi.php";
    $sqlku=mysqli_query($koneksi,"SELECT * from t_pengajuan order by kode_pengajuan desc");
  $no=1;
  while($data=mysqli_fetch_array($sqlku)){
?>
    
      <tr>
      <td><?php echo $no;?></td>
      <td><?php echo $data['kode_pengajuan'];?></td>
      <?php
      $isi=$data['kode_anggota'];
       $ang=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_anggota where kode_anggota='$isi'")); ?>
      <td><?php echo $ang['nama_anggota'];?> (<?php echo $isi;?>)</td>
      <td><?php echo $data['tgl_pengajuan'];?></td>
      <td><?php echo number_format($data['besar_pinjam']);?></td>
      <?php $rr=$data['kode_jenis_pinjam'];?>
    <?php $oo=mysqli_fetch_array(mysqli_query($koneksi,"SELECT*from t_jenis_pinjam where kode_jenis_pinjam='$rr'"));?>
      <?php
      $asli=$data['besar_pinjam']/$oo['lama_angsuran'];
      $bung=$oo['bunga']/100;
      $bunganya=$data['besar_pinjam']*$bung;
      $total=$asli+$bunganya;
      ?>
      <td><?php echo $oo['nama_pinjaman'];?></td>
      <td><kbd style="background-color:#d9534f;"><?php echo $data['status'];?></kbd></td>
      <td><?php echo $data['tgl_acc'];?></td>
      <?php if($data['status']=='menunggu')
      {?>
        <td align="center">
        <a class="btn btn-success btn-xs" href="pengajuan/proses_pengajuan.php?proses=terima&kode_anggota=<?php echo $isi;?>&kode_pengajuan=<?php echo $data['kode_pengajuan'];?>"><i class="glyphicon glyphicon-ok-circle"></i> Proses</a>
        <a class="btn btn-danger btn-xs" href="pengajuan/proses_pengajuan.php?proses=tolak&kode_anggota=<?php echo $isi;?>&kode_pengajuan=<?php echo $data['kode_pengajuan'];?>"><i class="glyphicon glyphicon-remove-circle"></i> Tolak</a>
      </td>
        <?php } ?>
      <?php if($data['status']=='diterima')
      {?>
        <td align="center">
        <a class="btn btn-danger btn-xs" href="pengajuan/proses_pengajuan.php?proses=hapus&kode_anggota=<?php echo $isi;?>&kode_pengajuan=<?php echo $data['kode_pengajuan'];?>"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
        </td>
        <?php } ?>
       <?php if($data['status']=='ditolak')
      {?>
        <td align="center">
        <a class="btn btn-success btn-xs" href="pengajuan/proses_pengajuan.php?proses=terima&kode_anggota=<?php echo $isi;?>&kode_pengajuan=<?php echo $data['kode_pengajuan'];?>"><i class="glyphicon glyphicon-ok-circle"></i> Proses</a>
        <a class="btn btn-danger btn-xs" href="pengajuan/proses_pengajuan.php?proses=hapus&kode_anggota=<?php echo $isi;?>&kode_pengajuan=<?php echo $data['kode_pengajuan'];?>"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
        </td>
        <?php } ?>
        </tr> 
  
<?php
  $no++;} //tutup while
?>
</tbody></table></div></form>
</div>
</div>
</div>
<?php } 
else if($aksi=='anggota')
{ include "config/koneksi.php";
    $kodeaa=$_GET['kode_anggota']; 
?>
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Pengajuan 
   <?php $dfl=mysqli_fetch_array(mysqli_query($koneksi,"SELECT *from t_anggota where kode_anggota='$kodeaa'")); echo $dfl['nama_anggota']; ?><span style="float:right;">
    <input type="text" id="cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari disini...">
                    
   <?php  $verida=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM t_pengajuan where kode_anggota='$kodeaa' order by kode_pengajuan desc")); $num=mysqli_num_rows($verida);
   if($verida['status']=='diterima')
    {
      echo '<a href="index.php?pilih=4.4&aksi=tambah&kode_anggota='.$kodeaa.'" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah</a></h4>';
    }
  else if($verida['status']=='menunggu')
    {
      echo '<a href="area.php?pilih=tambah" disabled="disabled" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah</a></h4>';
    }
  else if($verida['status']=='ditolak')
    {
      echo '<a href="index.php?pilih=4.4&aksi=tambah&kode_anggota='.$kodeaa.'" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah</a></h4>';
    }
  else if($num<=0)
    {
      echo '<a href="index.php?pilih=4.4&aksi=tambah&kode_anggota='.$kodeaa.'" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah</a></h4>';
    }?>
   <form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode</a></th>
             <th><a href="#">Tanggal Pengajuan</a></th>
             <th><a href="#">Besar Pinjam</a></th>
             <th><a href="#">Lama Angsur</a></th>
             <th><a href="#">Jenis Pinjam</a></th>
             <th><a href="#">Besar Angsuran</a></th>
             <th><a href="#">Status</a></th>
             <th><a href="#">Tanggal Terima</a></th>
             <th><a>Aksi</a></th>
        </tr>
    
    </thead>
    <tbody id="fbody">
<?php
    $rino=mysqli_query($koneksi,"SELECT * FROM t_pengajuan where kode_anggota='$kodeaa' order by kode_pengajuan desc");
  $no=1;
while($data=mysqli_fetch_array($rino))
{
?>
    
      <tr>
      <td><?php echo $no;?></td>
            <td><?php echo $data['kode_pengajuan'];?></td>
      <td><?php echo $data['tgl_pengajuan'];?></td>
      <td><?php echo number_format($data['besar_pinjam']);?></td>
      <?php $rr=$data['kode_jenis_pinjam'];?>
    <?php $oo=mysqli_fetch_array(mysqli_query($koneksi,"SELECT*from t_jenis_pinjam where kode_jenis_pinjam='$rr'"));?>
      <td><?php echo $oo['lama_angsuran'];?> Bulan</td>
      <?php
      $asli=$data['besar_pinjam']/$oo['lama_angsuran'];
      $bung=$oo['bunga']/100;
      $bunganya=$data['besar_pinjam']*$bung;
      $total=$asli+$bunganya;
      ?>
      <td><?php echo $oo['nama_pinjaman'];?></td>
      <td><?php echo number_format($total);?></td>
      <td><kbd style="background-color:#d9534f;"><?php echo $data['status'];?></kbd></td>
      <td><?php echo $data['tgl_acc'];?></td>
      <?php if($data['status']=='menunggu')
      {?>
        <td align="center">
        <a class="btn btn-primary btn-xs" disabled="disabled" href=index.php?pilih=4.3&aksi=ubah&kode_user=<?php echo $data['kode_pengajuan'];?>><i class="glyphicon glyphicon-print"></i> Print</a>
        </td>
        <?php } ?>
      <?php if($data['status']=='diterima')
      {?>
        <td align="center">
        <a class="btn btn-primary btn-xs" target="_blank" href="pengajuan/print_pengajuan.php?kode_pengajuan=<?php echo $data['kode_pengajuan'];?>&sesion=<?php echo $_SESSION['kopname'];?>"><i class="glyphicon glyphicon-print"></i> Print</a>
        </td>
        <?php } ?>
      <?php if($data['status']=='ditolak')
      {?>
        <td align="center">
        <a class="btn btn-primary btn-xs" disabled="disabled" href=index.php?pilih=4.3&aksi=ubah&kode_user=<?php echo $data['kode_pengajuan'];?>><i class="glyphicon glyphicon-print"></i> Print</a>
        </td>
        <?php } ?>
        </tr> 
  
<?php
  $no++; } //tutup while
?>
</tbody>
</table></div></form>
</div>
</div>
</div>
<?php }
else if($aksi=='tambah')
{ $kodeaa=$_GET['kode_anggota'];   ?>
  <div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel" style="width:50%;">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Tambah Pengajuan</h4>
<form action="pengajuan/proses_pengajuan.php?proses=tambah" method="post">
<div class="form-group">
 <label>Kode Pengajuan</label>
 <?php include "config/koneksi.php"; 
 $kdp=mysqli_fetch_array(mysqli_query($koneksi,"SELECT kode_pengajuan from t_pengajuan order by kode_pengajuan desc"));
 $kode=$kdp['kode_pengajuan']+1;
 ?>
 <input type="text" class="form-control" name="kode_pengajuan" value="<?php echo $kode;?>" readonly/>
</div>
<div class="form-group">
<label>Tanggal Pengajuan</label>
 <input type="date"  class="form-control" name="tgl_pengajuan" value="<?php echo date("Y-m-d");?>" readonly>
</div>
<div class="form-group">
<label>Kode Anggota</label>
 <input type="text" class="form-control" name="kode_anggota" value="<?php echo $kodeaa;?>" readonly/>
</div>
<div class="form-group">
    <label>Jenis Pinjaman</label>
    <select name="kode_jenis_pinjam" class="form-control">
                <option value="nama_pinjaman">pinjaman</option>
                <?php
                $q=mysqli_query($koneksi,"SELECT * FROM t_jenis_pinjam");
                while($a=mysqli_fetch_array($q)){
                ?>
          <option value="<?php echo $a['kode_jenis_pinjam'];?>"><?php echo $a['nama_pinjaman'];?> /Maks : <?php echo $a['maks_pinjam'];?> /Bunga : <?php echo $a['bunga'];?>% /Lama : <?php echo $a['lama_angsuran'];?> Bulan</option>
        <?php
                }
                ?>
            </select>
</div>
<div class="form-group">
<label>Besar Pinjam</label>
 <input type="text" class="form-control" name="besar_pinjam" />
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-pencil'></span> Tambah</button>
<button id='hapus' class='btn btn-primary' onClick="self.history.back()"><span class='glyphicon glyphicon-trash'></span> Kembali</button>
</form></div></div></div>
<?php
}
?>