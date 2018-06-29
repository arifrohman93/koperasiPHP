<?php

	session_start();

// Proses Login
	if(empty($_SESSION['kopname'])||empty($_SESSION['level'])){	?>
		<script>
		alert("Anda Harus Login Dahulu"); 
		window.location="login/login.php"; 
		</script>
    <?php
	}else
    {
    $pilih=$_GET['pilih'];
      switch($pilih){
        default   : $tampil = "mst_isi.php"; break;
        case "1.2"  : $tampil = "anggota/mst_anggota.php"; break; 
        case "1.3"  : $tampil = "anggota/mst_tabungan.php"; break;
        case "2.1"  : $tampil = "transaksi/transaksi.php"; break; 
        case "3.1"  : $tampil = "laporan/laporan_anggota.php"; break;
        case "3.2"  : $tampil = "laporan/laporan_simpanan.php"; break;
        case "3.3"  : $tampil = "laporan/datapinjam.php"; break;  
        case "4.1"  : $tampil = "setting/setting_simpanan.php"; break;
        case "4.2"  : $tampil = "setting/setting_pinjaman.php"; break;
        case "4.3"  : $tampil = "setting/setting_user.php"; break;
        case "4.4"  : $tampil = "pengajuan/pengajuan.php"; break;
        case "4.5"  : $tampil = "help.php"; break;
        case "4.6"  : $tampil = "laporan/laporan_pinjaman.php"; break;
        case "4.7"  : $tampil = "petugas/mst_petugas.php"; break;
        case "4.8"  : $tampil = "laporan/perbulan.php"; break;
        case "4.9"  : $tampil = "laporan/keuangan.php"; break;
        case "5.0"  : $tampil = "help_anggota.php"; break;
      } //tutup switch
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Koperasi Hemat Pangkal Kaya</title>
  <link rel="shortcut icon" href="logo_kop.gif" />
    <link href="Theme/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="Theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="Theme/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="Theme/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="Theme/assets/lineicons/style.css">    
    <link rel="stylesheet" type="text/css" href="Theme/assets/css/jquery-ui.css">    
    
    <!-- Custom styles for this template -->
    <link href="Theme/assets/css/style.css" rel="stylesheet">
    <link href="Theme/assets/css/style-responsive.css" rel="stylesheet">

    <script src="Theme/assets/js/chart-master/Chart.js"></script>
  </head>
</head>

<body>
<section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <?php 
      if($_SESSION['level']=='admin')
      {
        echo '<header class="header" style="background-color:#5bc0de;">';
      }
      else if($_SESSION['level']=='anggota')
      {
        echo '<header class="header" style="background-color:#5cb85c;">';
      }
      ?>
      
              <div class="sidebar-toggle-box" style="color:#fff;">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="#" class="logo">Dashboard <?php echo $_SESSION['level'];?></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
              <ul style="float:right; margin-top:12px;">
                    <li>
					  <span style="font-size:15px;color:#FFF;"><?php echo date("Y-m-d"); ?></span>
					  <a id="ubahpassword" >
					  <?php 
						  if($_SESSION['level']=='admin')
						  {
							echo '<button class="btn btn-info" style="border:3px solid #fff;"><span class="glyphicon glyphicon-edit"></span> Ubah Password</button>';
						  }
						  else if($_SESSION['level']=='anggota')
						  {
							echo '<button class="btn btn-success" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Ubah Password</button>';
						  }
						
						echo "
						 <form id='ubah-password' name='frmChange' method='post' action='ubahPassword.php' onSubmit='return validatePassword()'>
							<div title='Ubah Password' >
							<table width='100%'>
								<tr>
								<td>Password Lama</td>
									<td width='2%'>:</td>
									<td class='password'><input type='password' name='currentPassword' id='currentPassword' size='35' class='input-pass'>
									</td>
								</tr>
								<tr>
									<td>Password Baru</td>
									<td width='2%'>:</td>
									<td><input type='password' name='newPassword' id='newPassword' size='35' class='input-pass'>
									</td>
								</tr>
								<tr>
									<td>Konfirmasi Password</td>
									<td width='2%'>:</td>
									<td><input type='password' name='confirmPassword' id='confirmPassword' size='35' class='input-pass'>
									</td>
								</tr>
							</table>
							<tr>
								<td colspan='2'><input type='submit' name='submit' id=submit'
									value='Submit' class='btn-ubah'></td>
							</tr>
							<tr>
								<td colspan='2'><input type='button' name='batal' id='batal'
									value='Batal' class='btn-batal'></td>
							</tr>
							</div>
						</form>
						";
					  ?>
					  </a>
					  <a class="logout" href="login/proses_logout.php">
						<?php 
							  if($_SESSION['level']=='admin')
							  {
								echo '<button class="btn btn-info" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Logout</button>';
							  }
							  else if($_SESSION['level']=='anggota')
							  {
								echo '<button class="btn btn-success" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Logout</button>';
							  }
						 ?>
					  </a></li>
              </ul>
            </div>
        </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <?php 
              if($_SESSION['level']=='admin')
              {
                ?>
                  <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#"><img src="logo_kop.gif" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['kopname'];?></h5>
                    
                  <li class="sub-menu">
                      <a href="index.php?pilih=home">
                          <i class="glyphicon glyphicon-home"></i>
                          <span style="font-size:120%; color:#fff;">Home</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="glyphicon glyphicon-th"></i>
                          <span style="font-size:120%; color:#fff;">Master Data</span>
                      </a>
                      <ul class="sub">
              <!--<li><a href="index.php?pilih=4.7"><i class="glyphicon glyphicon-tint"></i>Master Petugas</a></li>-->
              <li><a href="index.php?pilih=1.2"><i class="fa fa-user"></i>Master Anggota</a></li>
              <li><a href="index.php?pilih=1.3"><i class="fa fa-bitcoin"></i>Master Tabungan</a></li>
              <li><a href="index.php?pilih=4.4&aksi=admin"><i class="fa fa-star"></i>Master Pengajuan</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=2.1">
                          <i class="fa fa-dollar"></i>
                          <span style="font-size:120%; color:#fff;">Transaksi</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="glyphicon glyphicon-book"></i>
                          <span style="font-size:120%; color:#fff;">Laporan</span>
                      </a>
                      <ul class="sub">
                            <li><a href="index.php?pilih=3.1"><i class="fa fa-users"></i> Data Anggota</a></li>
              <li><a href="index.php?pilih=3.2"><i class="fa fa-save"></i> Data Simpanan</a></li>
              <li><a href="index.php?pilih=3.3&aksi=semua"><i class="fa fa-share"></i> Data Pinjaman</a></li>
              <li><a href="index.php?pilih=4.8"><i class="glyphicon glyphicon-question-sign"></i> Perbulan</a></li>
              <li><a href="index.php?pilih=4.9"><i class="fa fa-dollar"></i> Keuangan</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="glyphicon glyphicon-wrench"></i>
                          <span style="font-size:120%; color:#fff;">Pengaturan</span>
                      </a>
                      <ul class="sub">
                         <li><a href="index.php?pilih=4.1"><i class="glyphicon glyphicon-edit"></i> Setting Simpanan</a></li>
            <li><a href="index.php?pilih=4.2"><i class="glyphicon glyphicon-share"></i> Setting Pinjaman</a></li>
            <li><a href="index.php?pilih=4.3"><i class="glyphicon glyphicon-user"></i> Setting User</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="column/column.php" target="_blank">
                          <i class="glyphicon glyphicon-stats"></i>
                          <span style="font-size:120%; color:#fff;">Grafik</span>
                      </a>
                  </li>
                  <!--<li class="sub-menu">
                      <a target="_blank" href="../../../phpmyadmin/db_export.php?db=rinookta&server=1&goto=db_qbe.php&token=042086e2593b7fe8fdb99ac76bb02f97" target="_blank">
                          <i class="glyphicon glyphicon-save"></i>
                          <span style="font-size:120%; color:#fff;">Backup</span>
                      </a>
                  </li>-->

                  <li class="sub-menu">
                      <a href="index.php?pilih=4.5">
                          <i class="fa fa-key"></i>
                          <span style="font-size:120%; color:#fff;">Help</span>
                      </a>
                  </li>

              </ul>
                <?php
              }
              else if($_SESSION['level']=='anggota')
              {
                ?>
                <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#"><img src="logo_kop.gif" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['kopname'];?></h5>
                   
                  <li class="sub-menu">
                      <a href="index.php?pilih=home">
                          <i class="glyphicon glyphicon-home"></i>
                          <span style="font-size:120%; color:#fff;">Home</span>
                      </a>
                  </li>
                  <!--<li class="sub-menu">
                      <a href="index.php?pilih=1.3"><i class="fa fa-bitcoin"></i><span style="font-size:120%; color:#fff;"> Data Tabungan</span></a>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=2.1">
                          <i class="fa fa-dollar"></i>
                          <span style="font-size:120%; color:#fff;">Transaksi</span>
                      </a>
                  </li>-->
				  
				  <li class="sub-menu">
                      <a href="index.php?pilih=2.1&aksi=simpanananggota&kode_anggota=<?php echo $_SESSION['kodeanggota'];?>">
                          <i class="fa fa-dollar"></i>
                          <span style="font-size:120%; color:#fff;">Simpanan</span>
                      </a>
                  </li>
				  <li class="sub-menu">
                      <a href="index.php?pilih=2.1&aksi=pinjamangsur&kode_anggota=<?php echo $_SESSION['kodeanggota'];?>">
                          <i class="fa fa-dollar"></i>
                          <span style="font-size:120%; color:#fff;">Pinjaman|Angsuran</span>
                      </a>
                  </li>
				  <li class="sub-menu">
                      <a href="index.php?pilih=4.4&aksi=anggota&kode_anggota=<?php echo $_SESSION['kodeanggota'];?>">
                          <i class="fa fa-dollar"></i>
                          <span style="font-size:120%; color:#fff;">Pengajuan</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=5.0">
                          <i class="fa fa-key"></i>
                          <span style="font-size:120%; color:#fff;">Help</span>
                      </a>
                  </li>

              </ul>
                <?php
              }
              ?>
              
              <!-- sidebar menu end-->
          </div>
      </aside>
      <section id="main-content">
          <section class="wrapper">
          <?php

           include("$tampil");?>
          </section>
      </section>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="Theme/assets/js/jquery.js"></script>
    <script src="Theme/assets/js/jquery-1.8.3.min.js"></script>
    <script src="Theme/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="Theme/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="Theme/assets/js/jquery.scrollTo.min.js"></script>
    <script src="Theme/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="Theme/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="Theme/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="Theme/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="Theme/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="Theme/assets/js/sparkline-chart.js"></script>    
	<script src="Theme/assets/js/zabuto_calendar.js"></script>  
	<script src="Theme/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
	
  
  <script type="application/javascript">
        $(document).ready(function () {
			$("#ubah-password").hide();
			$("#ubah-password").dialog({
				  autoOpen: false,
				  width: 550,
				  modal: true,
				  resizable:false,
				  open: function() {
						jQuery('.ui-widget-overlay').on('click', function() {
							jQuery('#ubah-password').dialog('close');
						})
					},
				  /*buttons: {
					  "Ubah": function() { 
						  validatePassword();
					  }, 
					  "Batal": function() { 
						  $(this).dialog("close"); 
					  } 
				  },*/
				  show: {
					effect: "fade",
					duration: 350
				  },
				  hide: {
					effect: "fade",
					duration: 350
				  }
			});
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
            $("#batal").click(function(){										
				$("#ubah-password").dialog("close");
			});			
			$("#ubahpassword").click(function(){										
				$("#ubah-password").dialog("open").prev().css("background","#FFF");
			});
            
			function validatePassword() {
			var currentPassword,newPassword,confirmPassword,output = true;

			currentPassword = document.frmChange.currentPassword;
			newPassword = document.frmChange.newPassword;
			confirmPassword = document.frmChange.confirmPassword;

			if(!currentPassword.value) {
				alert('Maaf, Password lama tidak boleh kosong');
				currentPassword.focus();
				document.getElementById("currentPassword").innerHTML = 'required';
				output = false;
			}
			else if(!newPassword.value) {
				alert('Maaf, Password baru tidak boleh kosong');
				newPassword.focus();
				document.getElementById("newPassword").innerHTML = "required";
				output = false;
			}
			else if(!confirmPassword.value) {
				alert('Maaf, Ulangi password tidak boleh kosong');
				confirmPassword.focus();
				document.getElementById("confirmPassword").innerHTML = "required";
				output = false;
			}
			if(newPassword.value != confirmPassword.value) {
				alert('Maaf, Konfirmasi password tidak sesuai dengan password baru');
				newPassword.value="";
				confirmPassword.value="";
				newPassword.focus();
				document.getElementById("confirmPassword").innerHTML = "not same";
				output = false;
			} 	
			$.ajax({
				type	: "POST",
				url		: "ubahPassword.php",
				data	: "newPassword="+newPassword+
						  "&confirmPassword="+confirmPassword+
						  "&currentPassword="+currentPassword,
				success	: function(data){
				}
			});
			return output;
			}
        });    
		
		function validatePassword() {
			var currentPassword,newPassword,confirmPassword,output = true;

			currentPassword = document.frmChange.currentPassword;
			newPassword = document.frmChange.newPassword;
			confirmPassword = document.frmChange.confirmPassword;

			if(!currentPassword.value) {
				alert('Maaf, Password lama tidak boleh kosong');
				currentPassword.focus();
				document.getElementById("currentPassword").innerHTML = 'required';
				output = false;
			}
			else if(!newPassword.value) {
				alert('Maaf, Password baru tidak boleh kosong');
				newPassword.focus();
				document.getElementById("newPassword").innerHTML = "required";
				output = false;
			}
			else if(!confirmPassword.value) {
				alert('Maaf, Ulangi password tidak boleh kosong');
				confirmPassword.focus();
				document.getElementById("confirmPassword").innerHTML = "required";
				output = false;
			}
			if(newPassword.value != confirmPassword.value) {
				alert('Maaf, Konfirmasi password tidak sesuai dengan password baru');
				newPassword.value="";
				confirmPassword.value="";
				newPassword.focus();
				document.getElementById("confirmPassword").innerHTML = "not same";
				output = false;
			} 
			return output;
			}
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  <?php

   } ?>