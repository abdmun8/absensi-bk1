<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK BINA KARYA 1 KARAWANG</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css?<?= time() ?>" />
    <link rel="stylesheet" href="./assets/css/hamburgers.min.css" />
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="./assets/css/select.dataTables.min.css" />
    <link id="favicon" rel="shortcut icon" href="./assets/logo.png" type="image/png">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark header-shadow">
        <div class="container-fluid">
            <div class="header-container">
                <div class="user-info">
                    <button class="hamburger hamburger--squeeze js-hamburger is-active button-sidebar" type="button" onclick="toggleMenu()">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <!-- <button class="btn btn-secondary btn-sm mr-3">Show</button> -->
                    <a class="navbar-brand" href="#"><img src="./assets/logo.png" class="brand-logo" /></a>
                </div>
                <div class="user-info">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="">
                            <span class="nav-item user-text"><?= $_SESSION['nama'] ?></span>
                            <a class="btn btn-primary btn-sm ml-1" href="?action=logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- <div id="loader" class="alert alert-succes">
        <div id="loader-content" class="bg-success">Loading...</div>
    </div> -->
    <section class="content">
        <div class="sidebar-container">
            <ul class="navbar-nav" id="header-menu">
                <li class="nav-item active">
                    <a class="nav-link" data-menu="siswa" href="#">Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="guru" href="#">Data Guru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="kelas" href="#">Data Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="tipe_sub_kelas" href="#">Data Sub Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="sub_kelas" href="#">Data Tipe Sub Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="pic_eksternal" href="#">Data PIC Eksternal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="ekskul" href="#">Data Ekskul</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="mata_pelajaran" href="#">Data Mata Pelajaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-menu="jadwal_sekolah" href="#">Data Jadwal Sekolah</a>
                </li>

            </ul>
        </div>
        <div class="dynamic container">
            Loading...
        </div>

    </section>




    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js??<?= time() ?>"></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="./assets/js/dataTables.select.min.js"></script>
    <script>
        var base_url = '<?= BASE_URL ?>';
        var menuShow = true;
        /**
         * toggle menu
         */
        function toggleMenu() {
            var currentWidth = !menuShow ? "0px" : "-280px";
            $(".sidebar-container").css("left", currentWidth);
            menuShow ? $('.hamburger').removeClass('is-active') : $('.hamburger').addClass('is-active');
            menuShow = !menuShow;
        }
    </script>
</body>

</html>