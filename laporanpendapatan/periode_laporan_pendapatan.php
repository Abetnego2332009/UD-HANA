<?php
// memanggil data config
include '../koneksi.php'; 

$tgl_awal = $_POST['tgl_awal'] ?? null;
$tgl_akhir = $_POST['tgl_akhir'] ?? null;

// Validasi awal
if (!$tgl_awal || !$tgl_akhir) {
    die("Tanggal awal dan akhir tidak boleh kosong.");
}

$tgl_awal_esc = mysqli_real_escape_string($con, $tgl_awal);
$tgl_akhir_esc = mysqli_real_escape_string($con, $tgl_akhir);

// Query data sesuai periode
$sql_pendapatan = mysqli_query($con, "SELECT * FROM tb_pendapatan WHERE tanggal_pendapatan BETWEEN '$tgl_awal_esc' AND '$tgl_akhir_esc' ORDER BY tanggal_pendapatan ASC") or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../head.php';?>

<body style="margin: 30px">
<center>
    <h4><b>Laporan Data</b></h4>
    <h3>Percetakan UD. HANA</h3>
    <p>Periode : <?= $tgl_awal; ?> s/d <?= $tgl_akhir; ?></p>
    <br><hr>
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="text-center">
                <th style="width:5%">#</th>
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
        <tbody>
            <?php 
            $no = 1;
            $total = 0;
            $total_pndptn = 0;

            if (mysqli_num_rows($sql_pendapatan) > 0) {
                while ($data = mysqli_fetch_array($sql_pendapatan)) {
                    $total += $data['total_pendapatan'];
                    $total_pndptn++; ?>
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
            <?php }
            } else { ?>
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data pendapatan pada periode ini.</td>
                </tr>
            <?php } ?>
        </tbody>
        <tr>
            <td colspan="6"><h5><b>Total Pendapatan</b></h5></td>
            <td colspan="2"><h5><b><?= $total_pndptn; ?> Pelanggan</b></h5></td>
        </tr>
        <tr>
            <td colspan="6"><h5><b>Total Pemasukan</b></h5></td>
            <td colspan="2"><h5><b>Rp. <?= number_format($total); ?></b></h5></td>
        </tr>
    </table>
</center>
<script>
    window.print();
</script>

</body>
</html>
