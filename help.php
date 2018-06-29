<?php
//yang harus diganti 
//1 config/koneksi.php
//2 setting/root.php
//3 petugas/root.php
//4 column/koneksi.php
?>
<div class="row mt">
 <div class="col-lg-12">
 <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Master Anggota</h4>
    <p>Berisi data Anggota, admin dapat menambahkan mengedit atau menghapus(semua data transaksi anggota yg dihapus akan juga ikut terhapus)</p>
    <p>saat menambah otomatis akan masuk di simpanan dan tabungan</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Master Tabungan</h4>
    <p>Berisi Data Tabungan atau Simpanan dari anggota</p>
    <p>Anggota dapat mengambil uang dari tabungannya, setiap 1 bulan tabungan akan bertambah 10000(tergantung) ini sebagai investasi bagi anggota</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Master Pengajuan</h4>
    <p>Admin dapat melakukan 3 aksi (terima-tolak-hapus)</p>
    <p>Saat proses terima otomatis data akan masuk sebagai pinjaman yg sah</p>
    <p>karena supaya tidak terlalu banyak maka diberi button hapus</p>
    <p>terdapat status pengajuan sebagai notifikasi</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Transaksi Simpan</h4>
    <p>Simpanan wajib setiap 1 minggu anggota wajib melakukan simpanan ditentukan mulai saat mendaftar diri, jika belum mencapai 1 minggu maka button wajib akan disabled</p>
    <p>jika (tanggal sekarang < tanggal tempo bayar wajib) maka disbled, jika (tanggal sekarang >= tanggal bayar tempo bayar) enabled</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Transaksi Pinjam|Angsur</h4>
    <p>Pinjaman hanya diperbolehkan setelah menyelesaikan angsurannya, Peminjam harus memilih paket pinjaman,</p>
    <p>Angsuran dilakukan sesuai besar angsuran, apabila telat maka akan ditampilakan berapa dendanya</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Transaksi Pengajuan</h4>
    <p>apabila anggota tidak dapat melakukan pinjaman secara langsung maka diperbolehkan melakukan pengajuan</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Laporan</h4>
    <p>Terdapat laporan angoota dapat melakukan print</p>
    <p>Terdapat laporan simpanan supaya tahu berapa simpanan yang dilakukan dan totalnya berapa(ini hanya unutk mengetahui saja ,ini bukanlah tabungan)</p>
    <p>Terdapat laporan pinjaman<br>1. Semua Pinjaman : ini berisi semua pinjamn yang dialukukan<br>2. jatuh tempo : apabila tanggal sekarang = tanggal jatuh tempo<br>3. telat : apabila tanggal sekarang melebihi tanggal jatuh tempo dan dikali 1000/perhari(tergantung)</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Pengaturan Simpanan</h4>
    <p>terdapat 3 jenis simpanan<br>1. wajib : dibayar sesuai jangka waktu tertentu dan jumlah tertentu<br>2. sukarela : tidak ditentukan waktu dan jumlah pembayarannya<br>3. pokok : dibayar saat pertama kali mendaftar</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Pengaturan Pinjaman</h4>
    <p>unutk membuat paket pinjaman dan dapat diatur</p>
  </div>
  <div class="form-panel" style="border-left:5px solid#d9534f;border-right:5px solid#d9534f;">
    <h4 style="color:#d9534f;">Pengaturan User</h4>
    <p>Mengelola siapa saja yg dapat mengakses program</p>
  </div>
  </div>
 </div>
