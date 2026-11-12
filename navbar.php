<!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/logo.png" alt="UD. Hana" height="60" width="60">
  </div>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('dashboard.php'); ?>" class="nav-link">Dashboard</a>
      </li>
      <li>
        <a href="<?= base_url('laporanpendapatan/laporan.php'); ?>" class="nav-link">Laporan Pendapatan</a>
      </li>
      <li>
        <a href="<?= base_url('laporanpengeluaran/laporanpengeluaran.php'); ?>" class="nav-link">Laporan Pengeluaran</a>
      </li>
    </ul>

  </nav>