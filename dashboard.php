<?php 
include 'koneksi.php';

if (!isset($_SESSION['user']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Kasir')) {
    // Redirect ke login jika belum login atau bukan admin/kasir
    echo "<script>window.location = '" . base_url() . "'; </script>";
    exit;
}
?>


<!doctype html>
<html lang="en">

<?php include 'head.php';?>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <?php include 'navbar.php';?>
    <?php include 'sidebar.php';?>

    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

    <div class="flex-grow-1 p-4">
      <h2>Dashboard</h2>
      <br>
      <div class="row">
        <!-- Card Summary -->
        <div class="col-md-4">
          <div class="card text-bg-success mb-3">
            <div class="card-body">
            <?php
            $query = mysqli_query($con, "SELECT SUM(total_pendapatan) AS total FROM tb_pendapatan") or die(mysqli_error($con));
            $data = mysqli_fetch_assoc($query);
            $total = $data['total'];
            ?>

            <h5 class="card-title">Total Pendapatan</h5>
            <p class="card-text fs-4"><?= number_format($total, 0, ',', '.'); ?></p>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-bg-warning mb-3">
            <div class="card-body">
            <?php
            $query = mysqli_query($con, "SELECT SUM(jumlah_pengeluaran) AS total FROM tb_pengeluaran") or die(mysqli_error($con));
            $data = mysqli_fetch_assoc($query);
            $total = $data['total'];
            ?>

            <h5 class="card-title">Total Pengeluaran</h5>
            <p class="card-text fs-4"><?= number_format($total, 0, ',', '.'); ?></p>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-bg-secondary mb-3">
            <div class="card-body">
              <?php                    
              $dt_produkjasa = mysqli_query($con, "SELECT * FROM tb_produkjasa") or die(mysqli_error($con));
              $total_produkjasa = mysqli_num_rows($dt_produkjasa); ?>
              <h5 class="card-title">Total Produk / Jasa</h5>
              <p class="card-text fs-4"><?= $total_produkjasa; ?></p>
            </div>
          </div>
        </div>
      </div>

    </div>


        </div>
      </section>
    </div>
    <?php include 'footer.php';?>

  </div>


<?php include 'javascript.php';?>

</body>


  </body>
</html>
