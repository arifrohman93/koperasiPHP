<?php include "head.php";?>
<head>
<script type="javascript">
  window.history.forward();
  function.noBack(){
    window.history.forward();
  }
</script></head>
<body onload="noBack();">
<section id="container" >
     <header class="header" style="background-color:#f0ad4e;">';
              <div class="sidebar-toggle-box" style="color:#fff;">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo">Area Anggota</a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
              
            </div>
        </header>
          <section class="wrapper">
          <div id="login-page">
        <div class="container">
          <form class="form-login" method="post" action="proses.php?perintah=akses">
                <h2 class="form-login-heading"></h2>
                <div class="login-wrap"><center>Masukkan Kode Anggota Anda</center><br>
                  <input type="text" class="form-control" name="kodeang" placeholder="..." autofocus>
                    <br>
                    <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Akses</button>
                </div>
              </form>       
          
        </div>
        </div>
          </section>
  </section>
  </body>