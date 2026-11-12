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
            <i class="fas fa-table text-primary"></i><span style="color: blue;"> PENDAPATAN</span>
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
                       <a href="<?= base_url("pendapatan/tambah_pendapatan.php"); ?>" class="btn btn-outline-info btn-sm">
                          <i class="bi bi-currency-dollar"> Tambah Pendapatan</i>
                      </a>
                  </div>
              </div>
                  
              <table class="table table-bordered table-striped" id="example2">
                <thead>
                  <tr role="row" class="text-center">
                      <th>#</th>
                      <th>Pelanggan</th>
                      <th>Nama Produk / Jasa</th>
                      <th>Jumlah</th>
                      <th>Harga Satuan</th>
                      <th>Total Pendapatan</th>
                      <th>Metode Pembayaran</th>
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
                      $sql_pendapatan = mysqli_query($con, "SELECT * FROM tb_pendapatan INNER JOIN tb_produkjasa ON tb_pendapatan.id_produk = tb_produkjasa.id_produk ORDER BY date_pendapatan DESC") or die(mysqli_error($con));
                      // query untuk mengambil data dan membentuknya dalam array
                      while ($data = mysqli_fetch_array($sql_pendapatan)) { ?>
                          <tr>
                              <td><?=$no++ ?></td>
                              <td><?=$data['nama_pelanggan'];?></td>
                              <td><?=$data['nama_produk'];?></td>
                              <td><?=$data['jumlah_produk'];?></td>
                              <td><?=$data['harga_produk'];?></td>
                              <td><?=$data['total_pendapatan'];?></td>
                              <td><?=$data['metode_pembayaran'];?></td>
                              <td><?=$data['tanggal_pendapatan'];?></td>
                              <?php if ($_SESSION['role'] != 'Kasir') { ?>
                              <td align="center">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#editmodal<?=$data['id_pendapatan']?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                 | 
                              <a href="hapus_pendapatan.php?id=<?=$data['id_pendapatan'];?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-2"></i>Hapus</a>
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

$sql_pendapatanproduk = mysqli_query($con, "SELECT * FROM tb_pendapatan") or die(mysqli_error($con));
// query untuk mengambil data dan membentuknya dalam array
while ($data = mysqli_fetch_array($sql_pendapatanproduk)) { ?>


<div class="modal fade" id="editmodal<?= $data['id_pendapatan'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $data['id_pendapatan'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow rounded-3">
      <div class="modal-header bg-primary text-white rounded-top-3">
        <h5 class="modal-title" id="modalLabel<?= $data['id_pendapatan'] ?>">Edit Pendapatan - <?= htmlspecialchars($data['nama_produk']) ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        
        <form action="proses_pendapatan.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_pendapatan" value="<?= $data['id_pendapatan'] ?>">

          <div class="row g-3">
            <div class="col-md-6">
              <label for="tanggal_pendapatan" class="form-label">Tanggal Pendapatan</label>
              <input type="date" name="tanggal_pendapatan" class="form-control" value="<?= $data['tanggal_pendapatan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="id_produk<?= $data['id_pendapatan'] ?>">Tipe Produk / Jasa</label>
              <select class="form-select produk-select" name="id_produk" id="id_produk<?= $data['id_pendapatan'] ?>" data-target-id="<?= $data['id_pendapatan'] ?>">
                <option disabled selected>Pilih Produk / Jasa</option>
                <?php
                $sql_produk = mysqli_query($con, "SELECT * FROM tb_produkjasa") or die(mysqli_error($con));
                while ($produk = mysqli_fetch_array($sql_produk)) {
                    $selected = ($produk['id_produk'] == $data['id_produk']) ? 'selected' : '';
                    echo "<option value='{$produk['id_produk']}' $selected>{$produk['nama_produk']}</option>";
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="nama_pelanggan">Pelanggan</label>
              <input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="harga_produk<?= $data['id_pendapatan'] ?>">Harga</label>
              <input type="number" name="harga_produk" class="form-control" id="harga_produk<?= $data['id_pendapatan'] ?>" value="<?= $data['harga_produk'] ?>" readonly>
            </div>

            <div class="col-md-6">
              <label for="nomor_pelanggan">Nomor Telepon / WA</label>
              <input type="text" name="nomor_pelanggan" class="form-control" id="nomor_pelanggan" value="<?= $data['nomor_pelanggan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="jumlah_produk<?= $data['id_pendapatan'] ?>">Jumlah</label>
              <input type="number" name="jumlah_produk" class="form-control jumlah-produk" id="jumlah_produk<?= $data['id_pendapatan'] ?>" value="<?= $data['jumlah_produk'] ?>" data-target-id="<?= $data['id_pendapatan'] ?>">
            </div>

            <div class="col-md-6">
              <label for="total_pendapatan<?= $data['id_pendapatan'] ?>">Total Harga</label>
              <input type="number" name="total_pendapatan" class="form-control" id="total_pendapatan<?= $data['id_pendapatan'] ?>" value="<?= $data['total_pendapatan'] ?>" readonly>
            </div>

            <div class="col-md-6">
              <label for="satuan_produk" class="form-label">Satuan</label>
              <input type="text" name="satuan_produk" class="form-control" id="satuan_produk<?= $data['id_pendapatan'] ?>" value="<?= $data['satuan_produk'] ?>" readonly>
            </div>

            <div class="col-md-6">
              <label for="metode_pembayaran">Metode Pembayaran</label>
              <select class="form-select" name="metode_pembayaran">
                <?php
                  $metode_list = ["Tunai", "Transfer", "QRIS"];
                  foreach ($metode_list as $metode) {
                    $selected = ($data['metode_pembayaran'] == $metode) ? "selected" : "";
                    echo "<option value='$metode' $selected>$metode</option>";
                  }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="catatan_pendapatan" class="form-label">Catatan</label>
              <textarea class="form-control" name="catatan_pendapatan" rows="3"><?= $data['catatan_pendapatan'] ?></textarea>
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-primary" name="edit_pendapatan">
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



<script>
$(document).ready(function () {
  function hitungTotal(id) {
    let harga = parseInt($('#harga_produk' + id).val()) || 0;
    let jumlah = parseInt($('#jumlah_produk' + id).val()) || 0;
    $('#total_pendapatan' + id).val(harga * jumlah);
  }

  // Ketika jumlah diubah, total otomatis dihitung
  $('.jumlah-produk').on('input', function () {
    let id = $(this).data('target-id');
    hitungTotal(id);
  });

  // Ketika produk diubah, ambil harga lewat AJAX
  $('.produk-select').on('change', function () {
    let id_produk = $(this).val();
    let id_target = $(this).data('target-id');

    $.ajax({
      url: 'get_harga_produk.php',
      method: 'GET',
      data: { id_produk: id_produk },
      dataType: 'json',
      success: function (response) {
        $('#harga_produk' + id_target).val(response.harga_produk);
        $('#satuan_produk' + id_target).val(response.satuan_produk);
        hitungTotal(id_target);
      },
      error: function () {
        alert('Gagal mengambil data produk.');
      }
    });
  });

});
</script>




</body>
</html>
