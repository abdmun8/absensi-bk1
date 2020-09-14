<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Imperial Boootstrap Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link href="favicon.ico" rel="shortcut icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url('asset/publik/');?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url('asset/publik/');?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url('asset/publik/');?>lib/animate-css/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url('asset/publik/');?>css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Imperial
    Theme URL: https://bootstrapmade.com/imperial-free-onepage-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <div id="preloader"></div>

  <!--==========================
  Header Section
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="<?php echo base_url('asset/publik/');?>img/logo.png" alt="" title="" /></img></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#info-loker">Info Loker</a></li>
          <li><a href="#contact">Contact Us</a></li>
          <li><a href="<?php echo base_url('view/home');?>">Login</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->

  <!--==========================
  About Section
  ============================-->

  <!--==========================
  Services Section
  ============================-->
  <section id="info-loker">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Informasi Loker</h3>
          <div class="section-title-divider"></div>
          <p class="section-description"></p>
        </div>
      </div>

      <div class="row">
<?php
        if ($data_loker)  {
        

    echo $data_loker->title;

        }
?>
<a class="btn btn-primary" href="<?php echo base_url('Publik/form_apply/' . $data_loker->loker_id);?>">apply</a>        
      </div>
    </div>
  </section>
  <!--==========================
  Footer
============================-->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            &copy; Copyright <strong>Imperial Theme</strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Imperial
            -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Required JavaScript Libraries -->
  <script src="<?php echo base_url('asset/publik/');?>lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url('asset/publik/');?>lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('asset/publik/');?>lib/superfish/hoverIntent.js"></script>
  <script src="<?php echo base_url('asset/publik/');?>lib/superfish/superfish.min.js"></script>
  <script src="<?php echo base_url('asset/publik/');?>lib/morphext/morphext.min.js"></script>
  <script src="<?php echo base_url('asset/publik/');?>lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url('asset/publik/');?>lib/stickyjs/sticky.js"></script>
  <script src="<?php echo base_url('asset/publik/');?>lib/easing/easing.js"></script>

  <!-- Template Specisifc Custom Javascript File -->
  <script src="<?php echo base_url('asset/publik/');?>js/custom.js"></script>

  <!-- <script src="contactform/contactform.js"></script> -->


</body>

</html>
