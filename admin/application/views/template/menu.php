<?php if ($this->session->userdata('_LEVEL') == "admin") : ?>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="#" class="nav-link active menu" id="dashboard" onclick="loadContent(base_url + 'view/_dashboard'); return false;">
          <i class="nav-icon fa fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link menu" id="absensi-siswa" onclick="loadContent(base_url + 'view/_jadwal_sekarang'); return false;">
          <i class="fas fa-edit nav-icon"></i>
          <p>Absensi Siswa</p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-folder"></i>
          <p>
            Database
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-siswa" onclick="loadContent(base_url + 'view/_data_siswa'); return false;">
              <i class="fa fa-user nav-icon"></i>
              <p>Data Siswa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-guru" onclick="loadContent(base_url + 'view/_data_guru'); return false;">
              <i class="fas fa-user-graduate nav-icon"></i>
              <p>Data Guru</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-subkelas" onclick="loadContent(base_url + 'view/_data_subkelas'); return false;">
              <i class="fa fa-book nav-icon"></i>
              <p>Sub kelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-tipe_sub_kelas" onclick="loadContent(base_url + 'view/_data_tipe_sub_kelas'); return false;">
              <i class="fa fa-book nav-icon"></i>
              <p>Data tipe Sub kelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-pic-eksternal" onclick="loadContent(base_url + 'view/_data_pic_eksternal'); return false;">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>Data PIC Eksternal</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-penugasan" onclick="loadContent(base_url + 'view/_data_penugasan'); return false;">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>Data Penugasan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-ekskul" onclick="loadContent(base_url + 'view/_data_ekskul'); return false;">
              <i class="fa fa-book nav-icon"></i>
              <p>Data Ekskul</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-tipe_libur" onclick="loadContent(base_url + 'view/_data_tipe_libur'); return false;">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>Tipe Libur</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-jadwal_sekolah" onclick="loadContent(base_url + 'view/_data_jadwal_sekolah'); return false;">
              <i class="fa fa-calendar-alt nav-icon"></i>
              <p>Jadwal Sekolah</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-wali-murid" onclick="loadContent(base_url + 'view/_data_wali_murid'); return false;">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>Data Wali Siswa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-mata-pelajaran" onclick="loadContent(base_url + 'view/_data_mata_pelajaran'); return false;">
              <i class="fa fa-book nav-icon"></i>
              <p>Data Mata Pelajaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-kelas" onclick="loadContent(base_url + 'view/_data_kelas'); return false;">
              <i class="fa fa-box nav-icon"></i>
              <p>Data kelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="data-jadwal" onclick="loadContent(base_url + 'view/_jadwal_pelajaran'); return false;">
              <i class="fa fa-calendar-alt nav-icon"></i>
              <p>Jadwal Pelajaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="pengaturan" onclick="loadContent(base_url + 'view/_pengaturan'); return false;">
              <i class="fas fa-cogs nav-icon"></i></i>
              <p>Pengaturan</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-folder"></i>
          <p>
            Report
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporam-realtime" onclick="loadContent(base_url + 'view/_laporan_realtime'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Realtime</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-mingguan" onclick="loadContent(base_url + 'view/_laporan_mingguan'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Mingguan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-bulanan" onclick="loadContent(base_url + 'view/_laporan_bulanan'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Bulanan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-semester" onclick="loadContent(base_url + 'view/_laporan_semester'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Semester</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporam-realtime" onclick="window.open(base_url + 'absensi-guru-hari-ini'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Absensi Hari Ini</p>
            </a>
          </li>
        </ul>

      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->

<?php endif ?>
<?php if ($this->session->userdata('_LEVEL') == "guru") : ?>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="#" class="nav-link active menu" id="dashboard" onclick="loadContent(base_url + 'view/_dashboard'); return false;">
          <i class="nav-icon fa fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link menu" id="absensi-siswa" onclick="loadContent(base_url + 'view/_jadwal_sekarang'); return false;">
          <i class="fas fa-edit nav-icon"></i>
          <p>Absensi Siswa</p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-folder"></i>
          <p>
            Report
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporam-realtime" onclick="loadContent(base_url + 'view/_laporan_realtime'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Realtime</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-mingguan" onclick="loadContent(base_url + 'view/_laporan_mingguan'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Mingguan</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-bulanan" onclick="loadContent(base_url + 'view/_laporan_bulanan'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Bulanan</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-semester" onclick="loadContent(base_url + 'view/_laporan_semester'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Semester</p>
            </a>
          </li>
        </ul>

      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
<?php endif ?>

<!-- Wali Murid -->
<?php if ($this->session->userdata('_LEVEL') == "wali") : ?>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="#" class="nav-link active menu" id="dashboard" onclick="loadContent(base_url + 'view/_dashboard'); return false;">
          <i class="nav-icon fa fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-folder"></i>
          <p>
            Report
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporam-realtime" onclick="loadContent(base_url + 'view/_laporan_realtime'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Realtime</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-mingguan" onclick="loadContent(base_url + 'view/_laporan_mingguan'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Mingguan</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-bulanan" onclick="loadContent(base_url + 'view/_laporan_bulanan'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Bulanan</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link menu" id="laporan-semester" onclick="loadContent(base_url + 'view/_laporan_semester'); return false;">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Laporan Semester</p>
            </a>
          </li>
        </ul>

      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
<?php endif ?>