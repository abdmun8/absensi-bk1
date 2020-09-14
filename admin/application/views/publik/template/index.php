<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php echo $this->config->item('app_name');?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="UID Recruitment">
  <meta property="og:image" content="<?=base_url('asset/image/')?>logo.png">
  <meta property="og:url" content="http://uidrecruitment.my.id/">
  <meta property="og:site_name" content="UID Recruitment">
  <meta property="og:description" content="UID Recruitment Website">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="http://uidrecruitment.my.id/">
  <meta name="twitter:title" content="UID Recruitment">
  <meta name="twitter:description" content="UID Recruitment Website">
  <meta name="twitter:image" content="<?=base_url('asset/image/')?>logo.png">

  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link href="<?=base_url('asset/image/')?>logo.png" rel="shortcut icon">

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
  Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          <img class="" src="<?php echo base_url('asset/image/');?>utac-rs.png" alt="LOGO">
        </div>

        <h1 style="color: purple;">Welcome to <?php echo $this->config->item('app_name');?></h1>
        <h2>&nbsp;</h2>
        <!-- <h2>Join With Us <span class="rotating">for Better Career, to Work Together, to Be A Champion</span></h2> -->
        <div class="actions">
          <a href="<?=base_url().'admin';?>" class="btn-get-started">Login</a>
          <a href="<?=base_url().'registrasi';?>" class="btn-services">Register</a>
        </div>
      </div>
    </div>
  </section>

  <!--==========================
  Header Section
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="<?php echo base_url('asset/image/');?>utac-rs.png" alt="" title="" /></img></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#info-loker">Info Loker</a></li>
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
  <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">About Us</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Passionate people providing customers with world class turnkey test and assembly services.</p>
        </div>
      </div>
    </div>
    <div class="container about-container wow fadeInUp">
      <div class="row">

        <div class="col-lg-6 about-img">
          <img src="https://www.utacgroup.com/images/banners/who-we-are.jpg" alt="">
        </div>

        <div class="col-md-6 about-content">
          <h2 class="about-title">Who we Are?</h2>
          <p class="about-text">
            UTAC Holdings Ltd and its subsidiaries (“UTAC”) is a leading independent provider of assembly and test services for a broad range of semiconductor chips with diversified end uses, 
            including in-communications devices (such as smartphones, Bluetooth and WiFi), consumer devices, computing devices, automotive devices, 
            security devices, and devices for industrial and medical applications.
          </p>
          <p class="about-text">
            We offer our customers a full range of semiconductor assembly and test services in the following key product categories: analog, mixed-signal and logic, and memory.
            Our customers are primarily fabless companies, integrated device manufacturers and wafer foundries.
          </p>
          <p class="about-text">
            UTAC is headquartered in Singapore, with production facilities located in Singapore, Thailand, Taiwan, China, Indonesia and Malaysia. Our global sales network is broadly focused on five regions: the United States, Europe, China and Taiwan, Japan, and the rest of Asia, and we have sales offices located in each of these regions.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!--==========================
  Services Section
  ============================-->
  <section id="info-loker" style="margin-bottom:50px;">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Informasi Loker</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Info loker ada dibawah, silahkan klik untuk lebih detailnya</p>
        </div>
      </div>

      <div class="row">
        <!-- <div class="col-md-2"></div> -->
        <div class="col-md-12">
        <div class="panel-group" id="accordion">
        <?php
        //data loker
        if ($data_loker) {
            foreach ($data_loker as $loker) {
                ?>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#" onclick="toggleit(<?=$loker->loker_id?>)">
                      <i class="fa fa-arrow-circle-right">&nbsp;</i> <?php echo $loker->title;?></a>
                    </h4>
                  </div>
                  <div id="collapse<?=$loker->loker_id?>" class="panel-collapse collapse">
                    <div class="panel-body"><?php echo $loker->description;?>
                      <div style="margin-top:10px" class="col-md-12 center-block">
                        <button onclick="window.open('<?=base_url('admin')?>','_self')" name="singlebutton" class="center-block btn btn-info">Apply</button>
                    </div>
                    </div>
                    
                  </div>
                </div>
                <?php
            }
        }

        ?>
      </div>
        </div>
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
            &copy; Copyright <strong>UID Recruitment</strong>. All Rights Reserved
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
  <script>
    function toggleit(id){
      $("#collapse"+id+"").toggle('slow')
    }
  </script>

  <!-- <script src="contactform/contactform.js"></script> -->


</body>

</html>
