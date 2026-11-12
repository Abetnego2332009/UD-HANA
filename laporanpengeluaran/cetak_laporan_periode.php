<?php
require_once __DIR__ . '/../assets/mpdf/vendor/autoload.php'; // panggil autoloader mPDF
include '../koneksi.php';

$tgl_awal = $_POST['tgl_awal'] ?? date('Y-m-d');
$tgl_akhir = $_POST['tgl_akhir'] ?? date('Y-m-d');

$tgl_awal_esc = mysqli_real_escape_string($con, $tgl_awal);
$tgl_akhir_esc = mysqli_real_escape_string($con, $tgl_akhir);

// Ambil data dari database
$query = mysqli_query($con, "SELECT * FROM tb_pengeluaran WHERE tanggal_pengeluaran BETWEEN '$tgl_awal_esc' AND '$tgl_akhir_esc' ORDER BY tanggal_pengeluaran ASC");

// Persiapan data
$no = 1;
$total = 0;
$total_pndptn = 0;

$html = '
    <h2 align="center">LAPORAN PENGELUARAN</h2>
    <h3 align="center">Percetakan UD. HANA</h3>
    <p align="center">Periode: ' . $tgl_awal . ' s/d ' . $tgl_akhir . '</p>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Pengeluaran</th>
                <th>Jumlah (Rp)</th>
                <th>Metode Pembayaran</th>
                <th>Dibayarkan Kepada</th>
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
            <td>' . $row['jenis_pengeluaran'] . '</td>
            <td>Rp. ' . number_format($row['jumlah_pengeluaran']) . '</td>
            <td>' . $row['metode_pengeluaran'] . '</td>
            <td>' . $row['kepada_pengeluaran'] . '</td>
            <td>' . $row['tanggal_pengeluaran'] . '</td>
        </tr>';
    $total += $row['jumlah_pengeluaran'];
    $total_pndptn++;

}

$html .= '
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><b>Total Pengeluaran</b></td>
                <td colspan="2"><b>Rp. ' . number_format($total) . '</b></td>
            </tr>
        </tfoot>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('laporan_pengeluaran_' . date('Ymd') . '.pdf', 'I'); // tampilkan di browser
