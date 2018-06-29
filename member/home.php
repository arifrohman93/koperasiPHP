 <?php
          $itong_pinjam=mysqli_num_rows(mysqli_query($koneksi,"SELECT*from t_pinjam where kode_anggota='$kode'"));
          $itong_angsur=mysqli_num_rows(mysqli_query($koneksi,"SELECT*from t_angsur where kode_anggota='$kode'"));
          $itong_simpan=mysqli_num_rows(mysqli_query($koneksi,"SELECT*from t_simpan where kode_anggota='$kode'"));
          $c=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam where kode_anggota='$kode'"));
          $d=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsuran from t_angsur where kode_anggota='$kode'"));
          $e=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan where kode_anggota='$kode'"));

?>

<div class="row mt">
<div class="col-lg-12">
<div class="form-panel">

<div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-4">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5cb85c; ">
              <div class="panel-heading"  style="background-color:#5cb85c; color:#fff;"><h3>Pinjaman : <?php echo $itong_pinjam ?><i class="fa fa-dollar" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($c['total_pinjam']); ?></span>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-4">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#d9534f; ">
              <div class="panel-heading"  style="background-color:#d9534f; color:#fff;"><h3>Angsuran : <?php echo $itong_angsur ?><i class="fa fa-share" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($d['total_angsuran']); ?></span>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-4">
          <!-- small box -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#428bca; ">
              <div class="panel-heading"  style="background-color:#428bca; color:#fff;"><h3>Simpanan : <?php echo $itong_simpan ?><i class="fa fa-save" style="float:right;"></i></h3></div>
              <div class="panel-body">
               <span style="font-size:20px;">Rp. <?php echo number_format($e['total_simpan']); ?></span>
              </div>
            </div>
          </div>
      </div>
</div></div></div></div>