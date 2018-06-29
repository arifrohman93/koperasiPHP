<?php 
session_start();
include "head.php";include "../config/koneksi.php";
$kode=$_SESSION['kode'];
$dada=mysqli_fetch_array(mysqli_query($koneksi,"SELECT*FROM t_anggota where kode_anggota='$kode'"));
if(empty($_SESSION['kode']))
  { ?>
    <script>
    alert("Akses Ditolak"); 
    window.location="index.php"; 
    </script>
    <?php
  }else{
  $pilih=$_GET['pilih'];
      switch($pilih){
        default   : $tampil = "home.php"; break;
        case "pengajuan"  : $tampil = "pengajuan/pengajuan.php"; break; 
        case "tambah"  : $tampil = "pengajuan/tambah_pengajuan.php"; break; 
      }
?>
<body>
<section id="container" >
     <header class="header" style="background-color:#f0ad4e;">';
              <div class="sidebar-toggle-box" style="color:#fff;">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo">Area Anggota</a>
            <div class="top-menu">
              <ul style="float:right; margin-top:-8px;">
                    <li><a class="logout" href="proses.php?perintah=keluar">
                    <button class="btn btn-warning" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Keluar</button>
                  </a></li>
              </ul>
            </div>
        </header>
        <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
                  <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#"><img src="../logo_kop.gif" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $dada['nama_anggota']; ?></h5>
                    
                  <li class="sub-menu">
                      <a href="area.php?pilih=home">
                          <i class="glyphicon glyphicon-home"></i>
                          <span style="font-size:120%; color:#fff;">Home</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="area.php?pilih=pengajuan">
                          <i class="glyphicon glyphicon-book"></i>
                          <span style="font-size:120%; color:#fff;">Data Pengajuan</span>
                      </a>
                  </li>
                  </ul>
                  
          </div>
      </aside>
      <section id="main-content">
          <section class="wrapper">
          <?php include("$tampil");?>
          </section>
      </section>
  </section>
  <?php }?>