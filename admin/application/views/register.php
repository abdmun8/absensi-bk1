<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('asset/material-template/');?>/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?php echo base_url('asset/material-template/');?>/assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Registrasi User Baru</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('asset/material-template/');?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo base_url('asset/material-template/');?>/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url('asset/material-template/');?>/assets/css/demo.css" rel="stylesheet" />
    <!-- u/ datatables -->
    <link href="<?php echo base_url();?>/asset/datatables/dataTables.bootstrap.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';
    </script>
</head>

<body>
    <div class="">
        <div style="max-width: 500px; margin: 40px auto;">
            <form class="form-horizontal" id="form-registrasi">
                <h3 class="text-center">Registrasi User</h3>
                <div id="loading"></div>
                <div class="form-group">
                    <label for="name-input" class="control-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name-input" id="name-input" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="username-input" class="control-label">Username</label>
                    <input type="text" class="form-control" name="username-input" id="username-input" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password-input" class="control-label">Password</label>
                    <input type="password" class="form-control" name="password-input" id="password-input">
                </div>
                <div class="form-group">
                    <label for="gender-input" class="control-label">Jenis Kelamin</label>
                    <select class="form-control" name="gender-input" id="gender-input" >
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Permepuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email-input" class="control-label">Email</label>
                    <input type="text" class="form-control" name="email-input" id="email-input" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="alamat-input" class="control-label">Alamat</label>
                    <textarea class="form-control" name="alamat-input" id="alamat-input"></textarea>
                </div>
                <div class="clearfix"></div>
                <input type="hidden" name="model-input" id="model-input" value="register">
                <input type="hidden" name="key-input" id="key-input" value="employee_id">
                <input type="hidden" name="action-input" id="action-input" value="1">
                <input type="hidden" name="value-input" id="value-input" value="0">
                <button type="submit" onclick="proses_register(); return false;" class="btn btn-primary btn-lg btn-block">Daftar</button>
            </form>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/bootstrap-notify.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('asset/material-template/');?>/assets/js/demo.js"></script>
<script src="<?php echo base_url('asset/js/');?>function.js"></script>
<script src="<?php echo base_url('asset/js/');?>jquery.blockUI.js"></script>
<script src="<?php echo base_url();?>/asset/datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //
        <?php echo (isset($_EXTRA_JS)) ? $_EXTRA_JS : '';?>
    });

    function proses_register() {
        loading('loading',true);
        $.ajax({
            url: base_url + 'manage',
            data: $("#form-registrasi").serialize(),
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json){
                loading('loading',false);
                if (json.data.code === 1) {
                    alert('Registrasi berhasil, silahkan cek link konfirmasi di email anda.');
                    window.location = base_url;
                } else{
                    alert(json.data.message);
                }
            },
            error: function () {
                loading('loading',false);
                alert('Terjadi kesalahan!');
            }
        });
    }
</script>
</html>
