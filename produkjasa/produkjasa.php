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
            <i class="fas fa-table text-primary"></i><span style="color: blue;"> PRODUK & JASA</span>
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
                       <a href="<?= base_url("produkjasa/tambah_produkjasa.php"); ?>" class="btn btn-outline-info btn-sm">
                          <i class="bi bi-box-seam-fill"> Tambah Produk & Jasa</i>
                      </a>
                  </div>
              </div>
                  
              <table class="table table-bordered table-striped table-hover" id="example2">
                <thead>
                  <tr role="row" class="text-center">
                      <th>#</th>
                      <th>Nama Produk/Jasa</th>
                      <th>Kategori</th>
                      <th>Harga</th>
                      <th>Satuan</th>
                      <?php if ($_SESSION['role'] != 'kasir') { ?>
                      <th><i class="fas fa-cog"></i></th>
                    <?php } ?>
                  </tr>
                </thead>

                  <tbody align="center">

                    <?php
                      $no = 1;
                      $sql_produkjasa = mysqli_query($con, "SELECT * FROM tb_produkjasa") or die(mysqli_error($con));
                      // query untuk mengambil data dan membentuknya dalam array
                      while ($data = mysqli_fetch_array($sql_produkjasa)) { ?>
                          <tr>
                              <td><?=$no++ ?></td>
                              <td><?=$data['nama_produk'];?></td>
                              <td><?=$data['kategori_produk'];?></td>
                              <td>Rp. <?=$data['harga_produk'];?></td>
                              <td><?=$data['satuan_produk'];?></td>
                              <?php if ($_SESSION['role'] != 'kasir') { ?>
                              <td align="center">
                              <a href="" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#editmodal<?=$data['id_produk']?>"><i class="fas fa-edit"></i> Edit</a>
                                               | 
                              <a href="hapus_produkjasa.php?id=<?=$data['id_produk'];?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin Hapus Data?')"><i class="fas fa-trash text-danger"></i> Hapus</a>
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

$sql_produkjasa = mysqli_query($con, "SELECT * FROM tb_produkjasa") or die(mysqli_error($con));
// query untuk mengambil data dan membentuknya dalam array
while ($data = mysqli_fetch_array($sql_produkjasa)) { ?>


<!-- Modal -->
<div class="modal fade" id="editmodal<?= $data['id_produk'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $data['id_produk'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow rounded-3">

      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white rounded-top-3">
        <h5 class="modal-title" id="modalLabel<?= $data['id_produk'] ?>">Edit Produk / Jasa - <?= htmlspecialchars($data['nama_produk']) ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form action="proses_produkjasa.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">

          <div class="row g-3">
            <div class="col-md-6">
              <label for="nama_produk" class="form-label">Nama Produk / Jasa</label>
              <input type="text" name="nama_produk" class="form-control" id="nama_produk" value="<?= $data['nama_produk'] ?>">
            </div>
            <div class="col-md-6">
              <label for="kategori_produk" class="form-label">Kategori</label>
              <input type="text" name="kategori_produk" class="form-control" id="kategori_produk" value="<?= $data['kategori_produk'] ?>">
            </div>
            <div class="col-md-6">
              <label for="harga_produk" class="form-label">Harga</label>
              <input type="number" name="harga_produk" class="form-control" id="harga_produk" value="<?= $data['harga_produk'] ?>" min="0" step="0.01">
            </div>
            <div class="col-md-6">
              <label for="satuan_produk" class="form-label">Satuan</label>
              <input type="text" name="satuan_produk" class="form-control" id="satuan_produk" value="<?= $data['satuan_produk'] ?>">
            </div>
          </div>

          <!-- Tombol Simpan -->
          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary" name="edit_produk">
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
