<?php
require_once __DIR__ . '/../assets/mpdf/vendor/autoload.php'; // panggil autoloader mPDF
include '../koneksi.php';

$tgl_awal = $_POST['tgl_awal'] ?? date('Y-m-d');
$tgl_akhir = $_POST['tgl_akhir'] ?? date('Y-m-d');

$tgl_awal_esc = mysqli_real_escape_string($con, $tgl_awal);
$tgl_akhir_esc = mysqli_real_escape_string($con, $tgl_akhir);

// Ambil data dari database
$query = mysqli_query($con, "SELECT * FROM tb_pendapatan WHERE tanggal_pendapatan BETWEEN '$tgl_awal_esc' AND '$tgl_akhir_esc' ORDER BY tanggal_pendapatan ASC");

// Persiapan data
$no = 1;
$total = 0;
$total_pndptn = 0;

$html = '
    <h2 align="center">LAPORAN PENDAPATAN</h2>
    <h3 align="center">Percetakan UD. HANA</h3>
    <p align="center">Periode: ' . $tgl_awal . ' s/d ' . $tgl_akhir . '</p>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Pelanggan</th>
                <th>No. WA</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
$total = 0;
while ($row = mysqli_fetch_assoc($query)) {
    $html .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $row['nama_pelanggan'] . '</td>
            <td>' . $row['nomor_pelanggan'] . '</td>
            <td>' . $row['nama_produk'] . '</td>
            <td>Rp. ' . number_format($row['harga_produk']) . '</td>
            <td>' . $row['jumlah_produk'] . '</td>
            <td>Rp. ' . number_format($row['total_pendapatan']) . '</td>
            <td>' . $row['metode_pembayaran'] . '</td>
            <td>' . $row['tanggal_pendapatan'] . '</td>
        </tr>';
    $total += $row['total_pendapatan'];
    $total_pndptn++;

}

$html .= '
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"><b>Total Pelanggan</b></td>
                <td colspan="3"><b>' . $total_pndptn . ' Pelanggan</b></td>
            </tr>
            <tr>
                <td colspan="6"><b>Total Pemasukan</b></td>
                <td colspan="3"><b>Rp. ' . number_format($total) . '</b></td>
            </tr>
        </tfoot>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('laporan_pendapatan_' . date('Ymd') . '.pdf', 'I'); // tampilkan di browser
