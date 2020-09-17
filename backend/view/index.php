<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN BINA KARYA 1 KARAWANG</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="./assets/css/select.dataTables.min.css" />
    <link id="favicon" rel="shortcut icon" href="./assets/logo.png" type="image/png">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="./assets/logo.png" class="brand-logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="header-menu">
                <li class="nav-item active">
                    <a class="nav-link" data-menu="siswa" href="#">Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="guru" href="#">Data Guru</a>
                </li>
            </ul>
            <div class="">
                <span class="nav-item user-text"><?= $_SESSION['nama'] ?></span>
                <a class="btn btn-primary btn-sm ml-1" href="?action=logout">Logout</a>
            </div>
        </div>
    </nav>
    <!-- <div id="loader" class="alert alert-succes">
        <div id="loader-content" class="bg-success">Loading...</div>
    </div> -->
    <section class="dynamic container">
        Loading...
    </section>



    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="./assets/js/dataTables.select.min.js"></script>
    <script>
        var base_url = '<?= BASE_URL ?>';
    </script>
</body>

</html>