<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>    
    <link rel="shortcut icon" href="../logo_kop.gif"> 
    
  <title>Login Koperasi Hemat Pangkal Kaya</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
    <link href="css/animate-custom.css" rel="stylesheet">
   <script type="text/javascript" src="js/jquery.min.js"></script>   
     <script src="js/custom.modernizr.html" type="text/javascript" ></script>
   
  </head>
    <body>
 <script type="text/javascript" src="/md5.js"></script>
   <div class="container" id="login-block">
        <div class="row">
          <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
             
             <div class="login-box clearfix animated flipInY">
            <div class="login-logo">
                  <a href="#"><img class="img-responsive" src="../logo_kop.gif" width="150" height="150" alt="Company Logo" /></a>
                </div> 
                <hr />
                <div class="login-form">
              <form id="form_id" name="login" action="proses_login.php" method="post">
                <input type="TEXT" name="username" placeholder="Username" class="input-field" autofocus required/>
                <input type="password" name="password" placeholder="Password" class="input-field" required/>
                <input id="form_submit" type="submit" class="btn btn-login" value="Login" />  
              </form> 
              
                </div>                
             </div>
          </div>
      </div>
      </div>
     
        <!-- End Login box -->
      <footer class="container">
        <p id="footer-text">Copyright &copy; 2018 Koperasi Hemat Pangkal Kaya (HPK)</p>
      </footer>

        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script> 
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/placeholder-shim.min.js"></script>        
        <script src="js/custom.js"></script>
    </body>
</html>
