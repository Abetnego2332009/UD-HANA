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
      <h2 class="mb-0">Input Pengeluaran Baru</h2>
      <a href="pengeluaran.php" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body">
        <form action="proses_pengeluaran.php" method="POST" enctype='multipart/form-data'>

          <div class="mb-3">
            <label for="tanggal_pengeluaran" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal_pengeluaran" required>
          </div>
          <div class="mb-3">
            <label for="jenis_pengeluaran" class="form-label">Jenis Pengeluaran</label>
            <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
          </div>
          <div class="mb-3">
            <label for="rincian_pengeluaran" class="form-label">Rincian</label>
            <textarea class="form-control" id="rincian_pengeluaran" name="rincian_pengeluaran" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="jumlah_pengeluaran" class="form-label">Jumlah (Rp)</label>
            <input type="number" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" required>
          </div>
          <div class="mb-3">
            <label for="metode_pengeluaran" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="metode_pengeluaran" name="metode_pengeluaran" required>
              <option value="Tunai">Tunai</option>
              <option value="Transfer">Transfer</option>
              <option value="QRIS">QRIS</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="kepada_pengeluaran" class="form-label">Dibayarkan Kepada</label>
            <input type="text" class="form-control" id="kepada_pengeluaran" name="kepada_pengeluaran" required>
          </div>
          <div class="form-group">
            <label for="bukti_pengeluaran">Bukti / Lampiran</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="bukti_pengeluaran" name="bukti_pengeluaran">
                <label class="custom-file-label" for="bukti_pengeluaran">Upload File</label>
              </div>
            </div>
          </div>

          
          <button type="submit" class="btn btn-primary" name="tambah_pengeluaran">Simpan</button>
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
