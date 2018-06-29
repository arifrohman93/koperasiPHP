<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel"">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Pengajuan<span style="float:right;">
<a href="area.php?pilih=tambah" class="btn btn-primary"><span class='glyphicon glyphicon-plus'></span> Tambah</a></span></h4>
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
    <tbody>
<?php
    $sqlku=mysqli_query($koneksi,"SELECT * from t_pengajuan where kode_anggota='$kode'");
  $no=1;
  while($data=mysqli_fetch_array($sqlku)){
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
        <a class="btn btn-primary btn-xs" href=index.php?pilih=4.3&aksi=ubah&kode_user=<?php echo $data['kode_pengajuan'];?>><i class="glyphicon glyphicon-print"></i> Print</a>
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
  $no++;} //tutup while
?>
</tbody>
</table></div></form>
</div>
</div>
</div>