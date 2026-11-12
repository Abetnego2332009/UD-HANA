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
      <h2 class="mb-0">Input Pelanggan Baru</h2>
      <a href="pelanggan.php" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body">
        <form action="proses_pelanggan.php" method="POST" enctype='multipart/form-data'>

          <div class="mb-3">
            <label for="tanggal_pelanggan" class="form-label">Tanggal Registrasi</label>
            <input type="date" class="form-control" id="tanggal_pelanggan" name="tanggal_pelanggan" required>
          </div>
          <div class="mb-3">
            <label for="jenis_pelanggan" class="form-label">Pelanggan</label>
            <input type="text" class="form-control" id="jenis_pelanggan" name="jenis_pelanggan" placeholder="Contoh: Perorangan, Perusahaan, Instansi" required>
          </div>
          <div class="mb-3">
            <label for="nomor_pelanggan" class="form-label">Nomor Telepon / WA</label>
            <input type="text" class="form-control" id="nomor_pelanggan" name="nomor_pelanggan" required>
          </div>
          <div class="mb-3">
            <label for="email_pelanggan" class="form-label">Email</label>
            <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan" placeholder="Opsional">
          </div>
          <div class="mb-3">
            <label for="alamat_pelanggan" class="form-label">Alamat Lengkap</label>
            <textarea class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" rows="3" placeholder="Opsional"></textarea>
          </div>
          <div class="mb-3">
            <label for="catatan_pelanggan" class="form-label">Catatan Tambahan</label>
            <textarea class="form-control" id="catatan_pelanggan" name="catatan_pelanggan" rows="3" placeholder="Opsional, misalnya preferensi pelanggan atau nama PIC"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="tambah_pelanggan">Simpan Pendapatan</button>
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
