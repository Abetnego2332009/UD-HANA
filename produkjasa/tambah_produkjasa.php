<?php 
include '../koneksi.php';

if (!isset($_SESSION['user']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Kasir')) {
    // Redirect ke login jika belum login atau bukan admin/kasir
    echo "<script>window.location = '" . base_url() . "'; </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../head.php';?>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <?php include '../navbar.php';?>
  <?php include '../sidebar.php';?>

<div class="content-wrapper">
  <section class="content">

  <div class="container py-4 px-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0">Tambah Produk / Jasa</h2>
      <a href="produkjasa.php" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body">
        <form action="proses_produkjasa.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk / Jasa</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
          </div>
          <div class="mb-3">
            <label for="kategori_produk" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori_produk" name="kategori_produk" placeholder="Contoh: Brosur, Banner" required>
          </div>
          <div class="mb-3">
            <label for="harga_produk" class="form-label">Harga Satuan (Rp)</label>
            <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
          </div>
          <div class="mb-3">
            <label for="satuan_produk" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan_produk" name="satuan_produk" placeholder="Contoh: lembar, meter" required>
          </div>
          <button type="submit" class="btn btn-primary" name="tambah_produk">Simpan Produk</button>
        </form>
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
