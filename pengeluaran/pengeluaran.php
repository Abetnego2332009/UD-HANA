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
            <i class="fas fa-table text-primary"></i><span style="color: blue;"> PENGELUARAN</span>
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
                       <a href="<?= base_url("pengeluaran/tambah_pengeluaran.php"); ?>" class="btn btn-outline-info btn-sm">
                          <i class="bi bi-cash-coin"> Tambah Pengeluaran</i>
                      </a>
                  </div>
              </div>
                  
              <table class="table table-bordered table-striped" id="example2">
                <thead>
                  <tr role="row" class="text-center">
                      <th>#</th>
                      <th>Jenis Pengeluaran</th>
                      <th>Rincian</th>
                      <th>Jumlah (Rp)</th>
                      <th>Dibayarkan Kepada</th>
                      <th>Tanggal</th>
                      <?php if ($_SESSION['role'] != 'Kasir') { ?>
                      <th><i class="fas fa-cog"></i></th>
                      <?php } ?>
                  </tr>
                </thead>

                  <tbody align="center" >

                    <?php
                      $no = 1;
                      // query untuk mengambil semua data dari tabel 
                      $sql_pengeluaran = mysqli_query($con, "SELECT * FROM tb_pengeluaran") or die(mysqli_error($con));
                      // query untuk mengambil data dan membentuknya dalam array
                      while ($data = mysqli_fetch_array($sql_pengeluaran)) {

                        $rcpnglrn = $data['rincian_pengeluaran'];
                        if (strlen($rcpnglrn) > 20) {
                          $rincian_pengeluaran = substr($rcpnglrn, 0, 20) . '...';
                        } else {
                          $rincian_pengeluaran = $rcpnglrn;
                        } ?>

                          <tr>
                              <td><?=$no++ ?></td>
                              <td><?=$data['jenis_pengeluaran'];?></td>
                              <td><?= $rincian_pengeluaran;?></td>
                              <td>Rp. <?= number_format($data['jumlah_pengeluaran']);?></td>
                              <td><?=$data['kepada_pengeluaran'];?></td>
                              <td><?=$data['tanggal_pengeluaran'];?></td>
                              <?php if ($_SESSION['role'] != 'Kasir') { ?>
                              <td align="center">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#editmodal<?=$data['id_pengeluaran']?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                 | 
                              <a href="hapus_pengeluaran.php?id=<?=$data['id_pengeluaran'];?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-2"></i>Hapus</a>
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

$sql_pengeluaranusaha = mysqli_query($con, "SELECT * FROM tb_pengeluaran") or die(mysqli_error($con));
// query untuk mengambil data dan membentuknya dalam array
while ($data = mysqli_fetch_array($sql_pengeluaranusaha)) { ?>


<div class="modal fade" id="editmodal<?= $data['id_pengeluaran'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $data['id_pengeluaran']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow rounded-3">
      <div class="modal-header bg-primary text-white rounded-top-3">
        <h5 class="modal-title" id="modalLabel<?= $data['id_pengeluaran'] ?>">Edit Pengeluaran - <?= htmlspecialchars($data['jenis_pengeluaran']) ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        
        <form action="proses_pengeluaran.php" method="post" enctype="multipart/form-data">

          <input type="hidden" name="id_pengeluaran" value="<?= $data['id_pengeluaran']; ?>">
          <input type="hidden" name="bukti_pengeluaran" value="<?= $data['bukti_pengeluaran']; ?>">

          <div class="row g-3">
            <div class="col-md-12">
              <label for="tanggal_pengeluaran" class="form-label">Tanggal</label>
              <input type="date" name="tanggal_pengeluaran" class="form-control" value="<?= $data['tanggal_pengeluaran']; ?>">
            </div>

            <div class="col-md-6">
              <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
              <input type="text" name="jenis_pengeluaran" class="form-control" id="jenis_pengeluaran" value="<?= $data['jenis_pengeluaran']; ?>">
            </div>

            <div class="col-md-6">
              <label for="jumlah_pengeluaran">Jumlah (Rp)</label>
              <input type="number" name="jumlah_pengeluaran" class="form-control" id="jumlah_pengeluaran" value="<?= $data['jumlah_pengeluaran']; ?>">
            </div>

            <div class="col-md-12">
              <label for="rincian_pengeluaran">Rincian</label>
              <textarea class="form-control" name="rincian_pengeluaran" rows="3"><?= $data['rincian_pengeluaran']; ?></textarea>
            </div>

            <div class="col-md-6">
              <label for="metode_pengeluaran">Metode Pengeluaran</label>
              <select class="form-select" name="metode_pengeluaran">
                <?php
                  $metode_list = ["Tunai", "Transfer", "QRIS"];
                  foreach ($metode_list as $metode) {
                    $selected = ($data['metode_pengeluaran'] == $metode) ? "selected" : "";
                    echo "<option value='$metode' $selected>$metode</option>";
                  }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="kepada_pengeluaran" class="form-label">Dibayarkan Kepada</label>
              <input type="text" name="kepada_pengeluaran" class="form-control" value="<?= $data['kepada_pengeluaran'] ?>">
            </div>
            <hr>
            <div class="col-md-6">
              <label for="bukti_pengeluaran" class="form-label">Bukti Pembayaran</label>
              <img src="<?= base_url('bukti_pengeluaran/' . $data['bukti_pengeluaran']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 200px;" alt="Bukti Pengeluaran">
            </div>

            <div class="col-md-6">
              <label for="bukti_pengeluaran" class="form-label mt-3">Upload File Baru <small class="text-muted">(Kosongkan bila tidak ingin diganti)</small></label>
              <input class="form-control" type="file" id="bukti_pengeluaran" name="bukti_pengeluaran">
            </div>

          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary" name="edit_pengeluaran">
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
