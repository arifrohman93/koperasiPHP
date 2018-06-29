<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel" style="width:50%;">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Tambah Pengajuan</h4>
<form action="pengajuan/proses_pengajuan.php?proses=tambah" method="post">
<div class="form-group">
 <label>Kode Pengajuan</label>
 <?php
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
 <input type="text" class="form-control" name="kode_anggota" value="<?php echo $dada['kode_anggota'];?>" readonly/>
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