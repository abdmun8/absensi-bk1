
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Absensi Siswa | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/fd9059e369.js"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('asset/css/adminlte.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('asset/plugins/icheck/skins/square/blue.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?=base_url()?>asset/image/Picture1.png" style="height: 100px; width: auto;" />
    <!-- <a href="#"><b>Absensi </b>Siswa</a> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan login untuk memulai</p>

      <form action="#" id="form-login" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username-input" id="username-input" class="form-control" placeholder="Username">
          <div class="input-group-append">
              <span class="fa fa-user input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password-input" name="password-input" class="form-control" placeholder="Password">
          <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label> 
                <input type="checkbox"> Ingat Saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button onclick="proses_login()" type="button" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="#">Lupa Password</a>
      </p>
      <!-- <p class="mb-0">
        <a href="#" class="text-center">Daftar baru</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('asset/js/jquery.min.js');?>" type="text/javascript"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('/asset/js/bootstrap.bundle.min.js');?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('/asset/plugins/icheck/icheck.min.js');?>"></script>
<!-- Functions -->
<script src="<?php echo base_url('asset/js/');?>function.js"></script>
<script src="<?php echo base_url('asset/js/');?>jquery.blockUI.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url();?>/asset/js/bootstrap-notify.js"></script>
<script>
    $(".form-control").on("keydown",function(e){
      if(e.keyCode == 13){
        proses_login();
      }
    })

    var base_url = '<?=base_url();?>';
    var mark = '<i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>';

    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass   : 'iradio_square-blue',
        increaseArea : '20%' // optional
      })
    });

    function proses_login() {
        $.ajax({
            url: base_url + 'login',
            data: $("#form-login").serialize(),
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json){
                loading('loading',false);
                if (json.data.code === 1) {
                    notify('Login berhasil');
                    <?php
                    //jika ada session link
                    if ($this->session->userdata('link') != NULL) {
                        $url = $this->session->userdata('link');
                        $this->session->unset_userdata('link');
                    } else {
                        $url = base_url('view/home');
                    }
                    ?>
                    setTimeout(function(){
                        window.location = '<?php echo $url;?>';
                      }, 3000);
                } else if(json.data.code === 2){
                    notify('Username tidak dikenal atau tidak aktif!','warning');
                } else{
                  console.log(json.data.message);
                    // notify(json.data.message,'warning',false);
                }
            },
            error: function () {
                loading('loading',false);
                notify('Terjadi kesalahan!','danger');
            }
        });
    }

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })

    notify = function(msg='Success',type='success',icon=true,delay=500){
      var sign = '';
      if(icon == true)
        sign = mark;
        $.notify({
          message: msg,
          icon: sign,
        },{
          type: type,
          delay: delay,
          placement:{
            align: 'center'
          }
        });    
      }
</script>
</body>
</html>
