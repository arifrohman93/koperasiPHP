<?php
include "config/koneksi.php";
$ghu=mysqli_query($koneksi,"SELECT * FROM t_tabungan");
$no=1;
while($dataku=mysqli_fetch_array($ghu))
{
  $fgh=$dataku['tgl_mulai'];$tang=date("Y-m-d");$kode_tab=$dataku['kode_tabungan'];
  $tempo=date('Y-m-d',strtotime('+30 day',strtotime($fgh)));
  if($tempo==$tang)
  {
    $total=$dataku['besar_tabungan']+10000;
    $tol=mysqli_query($koneksi,"UPDATE t_tabungan set tgl_mulai='$tang',besar_tabungan='$total' where kode_tabungan='$kode_tab'");
  }
  else
  {
    
  }
  $no++;
} 

session_start();
$kodeanggota	= $_SESSION[kodeanggota];
$a=mysqli_query($koneksi,"SELECT * from t_anggota ");
$b=mysqli_num_rows($a);
$c=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam"));
$d=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsuran from t_angsur"));
$e=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_tabungan) as total_tabungan from t_tabungan"));
$f=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(denda) as denda from t_angsur"));

$pjm=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam where kode_anggota = '$kodeanggota'"));
$ags=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsuran from t_angsur where kode_anggota = '$kodeanggota'"));
$smp=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_tabungan) as total_tabungan from t_tabungan where kode_anggota = '$kodeanggota'"));

?>

<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">
<?php 
if($_SESSION['level']=='admin')
 { ?>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!--  -->
          <div class="small-box" href="index.php?pilih=1.2">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h3>Anggota <i class="fa fa-users" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;"><?php echo $b; ?></span>
              </div>
              <a href="index.php?pilih=1.2">
               <div class="panel-footer">
               Lihat Detail
              </div>
              </a>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h3>Pinjaman <i class="fa fa-dollar" style="float:right;"></i></h3></div>
            <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($c['total_pinjam']); ?></span>
              </div>
              <a href="index.php?pilih=3.3&aksi=semua">
               <div class="panel-footer">
               Lihat Detail
              </div>
              </a>
            </div>
          </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h3>Angsuran <i class="fa fa-share" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($d['total_angsuran']); ?></span>
              </div>
              <a href="index.php?pilih=4.9">
               <div class="panel-footer">
               Lihat Detail
              </div>
              </a>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h3>Tabungan<i class="fa fa-save" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($e['total_tabungan']); ?></span>
              </div>
              <a href="index.php?pilih=1.3">
               <div class="panel-footer">
               Lihat Detail
              </div>
              </a>
            </div>
          </div>
      </div>
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h3>Denda<i class="glyphicon glyphicon-time" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($f['denda']); ?></span>
              </div>
              <a href="index.php?pilih=3.3&aksi=telat">
               <div class="panel-footer">
               Lihat Detail
              </div>
              </a>
            </div>
          </div>
      </div>

 <?php }
else if($_SESSION['level']=='anggota')
 { ?>
<div class="row">
        <!--<div class="col-lg-3 col-xs-6">
          <div class="small-box" href="index.php?pilih=1.2">
            <div class="panel" style="border: 2px solid#5cb85c; ">
              <div class="panel-heading"  style="background-color:#5cb85c; color:#fff;"><h3>Anggota <i class="fa fa-users" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;"><?php echo $b; ?></span>
              </div>
            </div>
          </div>
        </div>-->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5cb85c; ">
              <div class="panel-heading"  style="background-color:#5cb85c; color:#fff;"><h3>Pinjaman <i class="fa fa-dollar" style="float:right;"></i></h3></div>
            <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($pjm['total_pinjam']); ?></span>
              </div>
            </div>
          </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5cb85c; ">
              <div class="panel-heading"  style="background-color:#5cb85c; color:#fff;"><h3>Angsuran <i class="fa fa-share" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($ags['total_angsuran']); ?></span>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5cb85c; ">
              <div class="panel-heading"  style="background-color:#5cb85c; color:#fff;"><h3>Simpanan<i class="fa fa-save" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($smp['total_tabungan']); ?></span>
              </div>
            </div>
          </div>
      </div>
       <!--<div class="col-lg-3 col-xs-6">
          small box 
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5cb85c; ">
              <div class="panel-heading"  style="background-color:#5cb85c; color:#fff;"><h3>Denda<i class="glyphicon glyphicon-time" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($f['denda']); ?></span>
              </div>
            </div>
          </div>
      </div>-->

<?php }
 ?>

</div></div></div>