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
      <h2 class="mb-0">Input Pendapatan Baru</h2>
      <a href="pendapatan.php" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body">

        <form action="proses_pendapatan.php" method="POST" enctype='multipart/form-data'>
        
        <div class="row g-3">
          <div class="col-md-6">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal_pendapatan" required>
          </div>

          <!-- Dropdown Produk/Jasa -->
          <div class="col-md-6">
            <label for="nama_produk" class="form-label">Nama Produk / Jasa</label>
            <select class="form-select" id="nama_produk" name="nama_produk" required>
              <option value="">-- Pilih Produk / Jasa --</option>
              <?php
              $sql_produkjasa = mysqli_query($con, "SELECT * FROM tb_produkjasa") or die(mysqli_error($con));
              $produkArray = [];
              while ($produk = mysqli_fetch_assoc($sql_produkjasa)) {
                  $produkArray[] = $produk;
              }
              ?>
              <?php foreach ($produkArray as $produk): ?>
                <option value="<?= $produk['id_produk'] ?>"
                        data-harga="<?= $produk['harga_produk'] ?>"
                        data-satuan="<?= $produk['satuan_produk'] ?>">
                  <?= $produk['nama_produk'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="nama_pelanggan" class="form-label">Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
          </div>

          <div class="col-md-6">
            <label for="harga_produk" class="form-label">Harga Satuan (Rp)</label>
            <input type="number" class="form-control" id="harga_produk" name="harga_produk" readonly>
          </div>

          <div class="col-md-6">
            <label for="nomor_pelanggan" class="form-label">Nomor Telepon / WA</label>
            <input type="text" class="form-control" id="nomor_pelanggan" name="nomor_pelanggan" required>
          </div>

          <div class="col-md-6">
            <label for="satuan_produk" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan_produk" name="satuan_produk" readonly>
          </div>
          <div class="col-md-6">
            <label for="jumlah_produk" class="form-label">Jumlah Pembelian</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah_produk" required>
          </div>
          <div class="col-md-6">
            <label for="total_pendapatan" class="form-label">Total Harga (Rp)</label>
            <input type="number" class="form-control" id="total_pendapatan" name="total_pendapatan" readonly>
          </div>
          <div class="col-md-6">
            <label for="metode" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="metode" name="metode_pembayaran" required>
              <option value="Tunai">Tunai</option>
              <option value="Transfer">Transfer</option>
              <option value="QRIS">QRIS</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="catatan_pendapatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatan_pendapatan" name="catatan_pendapatan" rows="3" placeholder="Opsional"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="tambah_pendapatan">Simpan Pendapatan</button>
        </div>
        
        </form>
      </div>
    </div>
  </div>


  </section>
</div>

<?php include '../footer.php';?>
</div>
<?php include '../javascript.php';?>  


<script>
  const selectProduk = document.getElementById('nama_produk');
  const inputHarga = document.getElementById('harga_produk');
  const inputSatuan = document.getElementById('satuan_produk');
  const inputJumlah = document.getElementById('jumlah');
  const inputTotal = document.getElementById('total_pendapatan');

  // Ketika produk dipilih
  selectProduk.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const harga = selectedOption.getAttribute('data-harga');
    const satuan = selectedOption.getAttribute('data-satuan');

    inputHarga.value = harga || '';
    inputSatuan.value = satuan || '';
    updateTotal(); // hitung ulang jika sudah isi jumlah
  });

  // Ketika jumlah diubah
  inputJumlah.addEventListener('input', function () {
    updateTotal();
  });

  // Fungsi hitung total
  function updateTotal() {
    const harga = parseFloat(inputHarga.value) || 0;
    const jumlah = parseFloat(inputJumlah.value) || 0;
    const total = harga * jumlah;
    inputTotal.value = total.toFixed(0); // dua angka desimal
  }
</script>




</body>
</html>
