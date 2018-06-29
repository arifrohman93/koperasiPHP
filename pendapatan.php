<?php
include 'config/koneksi.php';
//pendapatan
$a=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM('besar_simpanan') as besar_simpan from t_simpan"));
$b=$a['besar_simpan'];
$c=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM('besar_angsuran') as besar_angsur from t_angsur"));

?>