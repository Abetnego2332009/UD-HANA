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
            <i class="fas fa-table text-primary"></i><span style="color: blue;"> PELANGGAN</span>
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
                       <a href="<?= base_url("pelanggan/tambah_pelanggan.php"); ?>" class="btn btn-outline-info btn-sm">
                          <i class="fas fa-cart-plus"> Tambah Pelanggan</i>
                      </a>
                  </div>
              </div>
                  
              <table class="table table-bordered table-striped" id="example2">
                <thead>
                  <tr role="row" class="text-center">
                      <th>#</th>
                      <th>Pelanggan</th>
                      <th>Nomor Telepon / WA</th>
                      <th>Tanggal Registrasi</th>
                      <?php if ($_SESSION['role'] != 'kasir') { ?>
                      <th><i class="fas fa-cog"></i></th>
                      <?php } ?>
                  </tr>
                </thead>

                  <tbody align="center" >

                    <?php
                      $no = 1;
                      // query untuk mengambil semua data dari tabel 
                      $sql_pelanggan = mysqli_query($con, "SELECT * FROM tb_pelanggan") or die(mysqli_error($con));
                      // query untuk mengambil data dan membentuknya dalam array
                      while ($data = mysqli_fetch_array($sql_pelanggan)) { ?>
                          <tr>
                              <td><?=$no++ ?></td>
                              <td><?=$data['jenis_pelanggan'];?></td>
                              <td><?=$data['nomor_pelanggan'];?></td>
                              <td><?=$data['tanggal_pelanggan'];?></td>
                              <?php if ($_SESSION['role'] != 'kasir') { ?>
                              <td align="center">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#editmodal<?=$data['id_pelanggan']?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                 | 
                              <a href="hapus_pelanggan.php?id=<?=$data['id_pelanggan'];?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-2"></i>Hapus</a>
                              </td>
                              <?php } ?>
                          </tr>
                      <?php } ?>

                  </tbody>
              </table>
            
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<?php

$sql_pelangganusaha = mysqli_query($con, "SELECT * FROM tb_pelanggan") or die(mysqli_error($con));
// query untuk mengambil data dan membentuknya dalam array
while ($data = mysqli_fetch_array($sql_pelangganusaha)) { ?>


<div class="modal fade" id="editmodal<?= $data['id_pelanggan'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $data['id_pelanggan'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow rounded-3">
      <div class="modal-header bg-primary text-white rounded-top-3">
        <h5 class="modal-title" id="modalLabel<?= $data['id_pelanggan'] ?>">Edit pelanggan - <?= htmlspecialchars($data['jenis_pelanggan']) ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        
        <form action="proses_pelanggan.php" method="post" enctype="multipart/form-data">

          <input type="hidden" name="id_pelanggan" value="<?= $data['id_pelanggan'] ?>">

          <div class="row g-3">
            <div class="col-md-6">
              <label for="tanggal_pelanggan" class="form-label">Tanggal pelanggan</label>
              <input type="date" name="tanggal_pelanggan" class="form-control" value="<?= $data['tanggal_pelanggan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="jenis_pelanggan" class="form-label">Pelanggan</label>
              <input type="text" name="jenis_pelanggan" class="form-control" value="<?= $data['jenis_pelanggan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="nomor_pelanggan">Nomor Telepon / WA</label>
              <input type="text" name="nomor_pelanggan" class="form-control" id="nomor_pelanggan" value="<?= $data['nomor_pelanggan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="email_pelanggan">Email</label>
              <input type="email" name="email_pelanggan" class="form-control jumlah-produk" id="email_pelanggan" value="<?= $data['email_pelanggan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="alamat_pelanggan">Alamat</label>
              <textarea class="form-control" name="alamat_pelanggan" rows="3"><?= $data['alamat_pelanggan'] ?></textarea>
            </div>

            <div class="col-md-6">
              <label for="catatan_pelanggan" class="form-label">Catatan</label>
              <textarea class="form-control" name="catatan_pelanggan" rows="3"><?= $data['catatan_pelanggan'] ?></textarea>
            </div>
          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary" name="edit_pelanggan">
              <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<?php }  ?>



<?php include '../footer.php';?>

</div>

<?php include '../javascript.php';?>
</body>
</html>
