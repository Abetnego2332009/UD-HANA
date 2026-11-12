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
            <i class="fas fa-table text-primary"></i><span style="color: blue;"> LAPORAN PENDAPATAN</span>
              <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
              </div>
          </div>

          <div class="card-body">
            

            <div class="table-responsive">


            <!-- FORM UTAMA -->
            <form method="post">     
                <table class="">
                    <tr>
                        <th>Tanggal Awal</th>
                        <td>
                            <input type="date" name="tgl_awal" id="tgl_awal" required class="form-control" 
                                   style="margin-left: 50px; width:300px; margin-bottom: 10px;">
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Akhir</th>
                        <td>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" required class="form-control" 
                                   style="margin-left: 50px; width:300px; margin-right:10px">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-danger" name="filter">
                                <i class="fas fa-eye"></i> Tampilkan
                            </button>
                        </td>
                        <td>
                            <a href="" class="btn btn-default">
                                <i class="fas fa-retweet"></i> Reset
                            </a>
                        </td>
                    </tr>
                </table>
            </form>

            <!-- FORM CETAK -->
            <form method="post" action="cetak_laporan_periode.php" target="_blank" onsubmit="return setTanggalCetakPDF();">  
                <input type="hidden" name="tgl_awal" id="pdf_tgl_awal">
                <input type="hidden" name="tgl_akhir" id="pdf_tgl_akhir">
                
                <button type="submit" class="btn btn-info btn-sm" style="margin-top: 20px;">
                    <i class="fas fa-file-pdf"></i> Cetak Laporan Pendapatan Per Periode
                </button>
                
                <a href="cetak_laporan_semua.php" target="_blank" class="btn btn-secondary btn-sm" style="margin-top: 20px;">
                    <i class="fas fa-print"></i> Cetak Laporan Pendapatan Keseluruhan
                </a>
            </form>



              <hr>
                  
              <table class="table table-bordered table-striped" id="example2">
                <thead>
                  <tr role="row" class="text-center">
                      <th>#</th>
                      <th>Pelanggan</th>
                      <th>Nomor Telepon / WA</th>
                      <th>Produk / Jasa</th>
                      <th>Harga (Rp)</th>
                      <th>Jumlah</th>
                      <th>Total Pendapatan</th>
                      <th>Metode Pembayaran</th>
                      <th>Tanggal</th>
                  </tr>
                </thead>

                  <tbody align="center" >

                    <?php
                    $no = 1;
                    if(isset($_POST['filter'])){
                        $tgl_awal = mysqli_real_escape_string($con, $_POST['tgl_awal']);
                        $tgl_akhir = mysqli_real_escape_string($con, $_POST['tgl_akhir']);
                        $sql_pendapatan = mysqli_query($con, "SELECT * FROM tb_pendapatan WHERE tanggal_pendapatan BETWEEN '$tgl_awal' AND '$tgl_akhir'") or die(mysqli_error($con));
                    } else {
                        // query untuk mengambil semua data dari tabel 
                        $sql_pendapatan = mysqli_query($con, "SELECT * FROM tb_pendapatan") or die(mysqli_error($con));
                    }
                    // cek data, jika ada data maka di looping
                    if (mysqli_num_rows($sql_pendapatan) > 0) {
                        $total = 0;
                        $data_pndptn = array();

                        // query untuk mengambil data dan membentuknya dalam array
                        while ($data = mysqli_fetch_array($sql_pendapatan)) { 
                            $data_pndptn[] = $data;
                            ?>
                        
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_pelanggan']; ?></td>
                            <td><?= $data['nomor_pelanggan']; ?></td>
                            <td><?= $data['nama_produk']; ?></td>
                            <td>Rp. <?= number_format($data['harga_produk']); ?></td>
                            <td><?= $data['jumlah_produk']; ?></td>
                            <td>Rp. <?= number_format($data['total_pendapatan']); ?></td>
                            <td><?= $data['metode_pembayaran']; ?></td>
                            <td><?= $data['tanggal_pendapatan']; ?></td>
                        </tr>

                        <!-- Menghitung total pemasukan -->
                            <?php $total += $data['total_pendapatan']; ?>
                            <!-- menghitung total pelanggan -->
                            <?php $total_pndptn = count($data_pndptn); ?>
                            
                        <?php } 
                      } ?>

                  </tbody>
              </table>

              <hr>

              <div class="row g-3">
                  <div class="col-md-3">
                       <div class="alert alert-primary alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5>
                              <i class="icon fas fa-info-circle"></i> Total Pelanggan</h5>
                          <h2>
                              <?= $total_pndptn ?> Pelanggan
                          </h2>
                      </div>
                  </div>
                  <div class="col-md-3">
                       <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5>
                              <i class="icon fas fa-info-circle"></i> Total Pemasukan</h5>
                          <h2>
                              Rp. <?= number_format($total); ?>
                          </h2>
                      </div>
                  </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </section>
</div>





<?php include '../footer.php';?>

</div>

<?php include '../javascript.php';?>


<script>
function setTanggalCetakPDF() {
    const tglAwal = document.querySelector('input[name="tgl_awal"]').value;
    const tglAkhir = document.querySelector('input[name="tgl_akhir"]').value;

    // Validasi input
    if (!tglAwal || !tglAkhir) {
        alert("Silakan isi tanggal awal dan tanggal akhir terlebih dahulu!");
        return false; // Batalkan submit
    }

    // Jika valid, set nilai ke input hidden
    document.getElementById('pdf_tgl_awal').value = tglAwal;
    document.getElementById('pdf_tgl_akhir').value = tglAkhir;
    
    return true; // Lanjutkan submit
}
</script>


</body>
</html>
