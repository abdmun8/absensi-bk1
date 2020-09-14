<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN BINA KARYA 1 KARAWANG</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link id="favicon" rel="shortcut icon" href="./assets/logo.png" type="image/png">
</head>

<body>
    <section class="login-container">
        <div class="login-form-container px-4 pt-3 pb-4">
            <div class="image-wrapper">
                <img src="./assets/logo.png" class="logo" />
                <h5 class="text-center mt-2">SMKN BINA KARYA 1 KARAWANG</h5>
            </div>
            <?php
            if (isset($_SESSION['login_gagal'])) {
                echo '<span class="alert alert-danger my-1">Username atau Password Salah</span>';
            }
            ?>
            <form class="form" id="login-form" method="post" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" required id="username" name="username" placeholder="Masukan Username">
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" required id="password" name="password" placeholder="Masukan Password">
                </div>
                <input type="hidden" name="action" value="login" />
                <button class="btn btn-primary btn-block" type="submit">Login</button>
            </form>

        </div>
    </section>

    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js"></script>
</body>

</html>
<script>
    <?php
    if (isset($_SESSION['login_gagal'])) {
        unset($_SESSION['login_gagal']);
        echo "
            setTimeout(function(){
                $('.alert-danger').alert('close')
            },5000);
        ";
    }
    ?>
</script>