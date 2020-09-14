<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('asset/material-template/');?>/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?php echo base_url('asset/material-template/');?>/assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php echo (isset($_TITLE)) ? $_TITLE : '';?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url();?>asset/css/adminlte.min.css" rel="stylesheet" />   
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url();?>asset/css/daterangepicker.css" rel="stylesheet" />   
    <!-- u/ datatables -->
    <link href="<?php echo base_url();?>asset/plugins/datatables/datatables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>asset/plugins/datatables/Responsive-2.2.2/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <!-- <link href="<?php echo base_url();?>asset/plugins/datatables/Buttons-1.5.4/css/buttons.bootstrap.css" rel="stylesheet" />     -->
    <link href="<?php echo base_url();?>asset/plugins/datatables/Select-1.2.6/css/select.bootstrap4.min.css" rel="stylesheet" />
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/swal/sweet-alert.css">
    <!-- Select 2 -->
    <link href="<?php echo base_url();?>asset/css/select2.min.css" rel="stylesheet" />   
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url('asset/plugins/icheck/skins/square/blue.css')?>">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url();?>asset/css/style.css" rel="stylesheet" />   
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>    

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div> -->
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-cog"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">Setting</span>
            <div class="dropdown-divider"></div>
            <!-- <a href="#" class="dropdown-item menu" id="change-password" onclick="loadContent(base_url + 'view/_change_password'); return false;">
              <i class="fas fa-wrench mr-2"></i> Change Password
            </a>
            <div class="dropdown-divider"></div> -->
            <a href="<?=base_url('logout')?>" class="dropdown-item">
              <i class="fa fa-power-off mr-2"></i> Logout
            </a>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?=base_url()?>" class="brand-link">
        <img src="<?=base_url()?>asset/image/Picture1.png" alt="AdminLTE Logo" class="brand-image"
             style="opacity: .8">
        <span class="brand-text font-weight-light">SMK BK1</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?=base_url()?>asset/image/avatar.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?=$this->session->userdata('_NAMA')?></a>
          </div>
        </div>
        <?php echo (isset($_MENU)) ? $_MENU : '';?>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div id="dinamic-content">

        <?php echo (isset($_CONTENT)) ? $_CONTENT : '';?>        
    </div>
    <!-- /.content-wrapper -->    

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!--   Core JS Files   -->
<script src="<?php echo base_url('/asset/js/jquery.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('/asset/js/bootstrap.bundle.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('/asset/js/adminlte.min.js');?>" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url('/asset/js/daterangepicker.js');?>" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('/asset/plugins/icheck/icheck.min.js');?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/asset/js/select2.full.min.js');?>"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url();?>/asset/js/bootstrap-notify.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo base_url();?>asset/plugins/swal/sweet-alert.js"></script>
<!--  Google Maps Plugin    -->
<script src="<?php echo base_url('asset/js/');?>function.js"></script>
<script src="<?php echo base_url('asset/js/');?>jquery.blockUI.js"></script>
<!-- Datatables -->
<script src="<?php echo base_url();?>asset/plugins/datatables/datatables.min.js"></script>
<script src="<?php echo base_url();?>asset/plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap4.min.js"></script>
<!-- <script src="<?php echo base_url();?>asset/plugins/datatables/Buttons-1.5.4/js/buttons.bootstrap.min.js"></script> -->
<script src="<?php echo base_url();?>asset/plugins/datatables/Select-1.2.6/js/select.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //
        <?php echo (isset($_EXTRA_JS)) ? $_EXTRA_JS : '';?>
    });
    var statemenu = 'dashboard';

    $(".menu").on('click',function(){
      var el = document.getElementById(this.id);
      var oldel = document.getElementById(statemenu);
      oldel.classList.remove('active');
      el.classList.add('active');
      statemenu = this.id;

    });

    function clear_notif(id,url=null){
        $("#notif"+id+"").remove();
        var total = $("#count-notif").text();
        var total = total - 1;
        $("#count-notif").text(total);
        if(url != null){
            loadContent(base_url + url);            
        }
        $.ajax({
            url: base_url + 'read_notif/'+id,
            type: "GET",
            cache: false,
            success: function(json){

            }
        });
    }
</script>
</body>
</html>
