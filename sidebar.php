<aside class="main-sidebar sidebar-white-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-1 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>/logo.png" class="img-circle elevation-2" alt="UD. Hana">
        </div>
        <div class="info">
          <h3 style="font-family: roboto;">UD. HANA</h3>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('dashboard.php'); ?>" class="nav-link">
              <i class="bi bi-person-circle text-danger"></i>
              <p>User Login: <?=$_SESSION['user']; ?></p>
            </a>
          </li>
<hr style="border-top: 2px solid #000; margin: 0 1rem 1rem 1rem;">
          <li class="nav-item">
            <a href="<?=base_url('dashboard.php'); ?>" class="nav-link">
              <i class="bi bi-speedometer2 text-warning"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">Management</li>

          <li class="nav-item">
            <a href="<?= base_url("pendapatan/pendapatan.php"); ?>" class="nav-link">
              <i class="bi bi-currency-dollar text-info"></i>
              <p>Pendapatan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("pengeluaran/pengeluaran.php"); ?>" class="nav-link">
              <i class="bi bi-cash-coin text-info"></i>
              <p>
                Pengeluaran
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("produkjasa/produkjasa.php"); ?>" class="nav-link">
              <i class="bi bi-box-seam-fill text-info"></i>
              <p>
                Produk & Jasa
              </p>
            </a>
          </li>

          <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="bi bi-people text-info"></i>
              <p>
                Pelanggan
              </p>
            </a>
          </li> -->

          <li class="nav-header">Save Report</li>

          <li class="nav-item">
            <a href="<?= base_url("laporanpendapatan/laporan.php"); ?>" class="nav-link">
              <i class="bi bi-file-earmark-bar-graph text-warning"></i>
              <p>
                Laporan Pendapatan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("laporanpengeluaran/laporanpengeluaran.php"); ?>" class="nav-link">
              <i class="bi bi-file-earmark-bar-graph text-warning"></i>
              <p>
                Laporan Pengeluaran
              </p>
            </a>
          </li>

          <li class="nav-header">Setting</li>

          <li class="nav-item">
            <a href="<?= base_url("users/pengguna.php"); ?>" class="nav-link">
              <i class="bi bi-person-badge text-info"></i>
              <p>Pengguna</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("logout.php"); ?>" class="nav-link" onclick="return confirm('Yakin ingin logout?');">
              <i class="bi bi-box-arrow-left text-warning"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>