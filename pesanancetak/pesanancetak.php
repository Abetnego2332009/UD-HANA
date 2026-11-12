<?php 
include '../koneksi.php';

if (!isset($_SESSION['user']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Kasir')) {
    // Redirect ke login jika belum login atau bukan admin/kasir
    echo "<script>window.location = '" . base_url() . "'; </script>";
    exit;
}
?>

<!doctype html>
<html lang="en">

<?php include '../head.php';?>


<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <?php include '../navbar.php';?>
  <?php include '../sidebar.php';?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        
      </div>
    </div>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">

          <div class="card-header">
            <i class="fas fa-table text-primary"></i><span style="color: blue;"> PESANAN CETAK</span>
              <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
              </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <div style="margin-bottom: 50px;">
                  <div class="float-right">
                      <!-- Link menuju controller mengakses function -->
                       <a href="<?= base_url("kamar/tambah_kamar.php"); ?>" class="btn btn-outline-info btn-sm">
                          <i class="fas fa-cart-plus"> Tambah Pesanan Cetak</i>
                      </a>
                  </div>
              </div>
                  
              <table class="table table-bordered table-striped" id="example2">
                <thead>
                  <tr role="row" class="text-center">
                      <th>#</th>
                      <th>1</th>
                      <th>2</th>
                      <th>3</th>
                      <th><i class="fas fa-cog"></i></th>
                  </tr>
                </thead>

                  <tbody align="center" >

                    

                  </tbody>
              </table>
            
            </div>
          </div>
        </div>
      </div>
    </section>
</div>





<?php include '../footer.php';?>

</div>

<?php include '../javascript.php';?>
</body>
</html>
