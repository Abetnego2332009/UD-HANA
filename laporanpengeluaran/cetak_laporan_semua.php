<?php
require_once __DIR__ . '/../assets/mpdf/vendor/autoload.php'; // Panggil autoloader mPDF
include '../koneksi.php';

// Query semua data
$sql_pengeluaran = mysqli_query($con, "SELECT * FROM tb_pengeluaran ORDER BY tanggal_pengeluaran ASC") or die(mysqli_error($con));

// Persiapan data
$no = 1;
$total = 0;
$total_pnglrn = 0;

$html = '
<style>
    body { font-family: Roboto; font-size: 14px; }
    h2, h3 { margin: 0; text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: center; }
</style>

<h2><b>LAPORAN PENGELUARAN</b></h2>
<br>
<h3>Percetakan UD. HANA</h3>
<hr>
<table>
    <thead>
        <tr>
            <th style="width:5%">#</th>
            <th>Jenis Pengeluaran</th>
            <th>Jumlah (Rp)</th>
            <th>Metode Pembayaran</th>
            <th>Dibayarkan Kepada</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>';

if (mysqli_num_rows($sql_pengeluaran) > 0) {
    while ($data = mysqli_fetch_array($sql_pengeluaran)) {
        $html .= '<tr>
            <td>' . $no++ . '</td>
            <td>' . htmlspecialchars($data['jenis_pengeluaran']) . '</td>
            <td>Rp. ' . number_format($data['jumlah_pengeluaran']) . '</td>
            <td>' . htmlspecialchars($data['metode_pengeluaran']) . '</td>
            <td>' . htmlspecialchars($data['kepada_pengeluaran']) . '</td>
            <td>' . $data['tanggal_pengeluaran'] . '</td>
        </tr>';
        $total += $data['jumlah_pengeluaran'];
        $total_pnglrn++;
    }
} else {
    $html .= '<tr><td colspan="6">Tidak ada data pengeluaran pada periode ini.</td></tr>';
}

$html .= '
    </tbody>
    <tr>
        <td colspan="4"><b>Total Pengeluaran</b></td>
        <td colspan="2"><b>Rp. ' . number_format($total) . '</b></td>
    </tr>
</table>';

// Cetak ke PDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('laporan_semua_data.pdf', 'I'); // 'I' untuk langsung tampil di browser
