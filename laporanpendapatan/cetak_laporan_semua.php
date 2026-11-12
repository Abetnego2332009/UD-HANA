<?php
require_once __DIR__ . '/../assets/mpdf/vendor/autoload.php'; // Panggil autoloader mPDF
include '../koneksi.php';

// Query semua data
$sql_pendapatan = mysqli_query($con, "SELECT * FROM tb_pendapatan ORDER BY tanggal_pendapatan ASC") or die(mysqli_error($con));

// Persiapan data
$no = 1;
$total = 0;
$total_pndptn = 0;

$html = '
<style>
    body { font-family: Roboto; font-size: 14px; }
    h2, h3 { margin: 0; text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: center; }
</style>

<h2><b>LAPORAN PENDAPATAN</b></h2>
<br>
<h3>Percetakan UD. HANA</h3>
<hr>
<table>
    <thead>
        <tr>
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
    <tbody>';

if (mysqli_num_rows($sql_pendapatan) > 0) {
    while ($data = mysqli_fetch_array($sql_pendapatan)) {
        $html .= '<tr>
            <td>' . $no++ . '</td>
            <td>' . htmlspecialchars($data['nama_pelanggan']) . '</td>
            <td>' . htmlspecialchars($data['nomor_pelanggan']) . '</td>
            <td>' . htmlspecialchars($data['nama_produk']) . '</td>
            <td>Rp. ' . number_format($data['harga_produk']) . '</td>
            <td>' . $data['jumlah_produk'] . '</td>
            <td>Rp. ' . number_format($data['total_pendapatan']) . '</td>
            <td>' . htmlspecialchars($data['metode_pembayaran']) . '</td>
            <td>' . $data['tanggal_pendapatan'] . '</td>
        </tr>';
        $total += $data['total_pendapatan'];
        $total_pndptn++;
    }
} else {
    $html .= '<tr><td colspan="9">Tidak ada data pendapatan pada periode ini.</td></tr>';
}

$html .= '
    </tbody>
    <tr>
        <td colspan="6"><b>Total Pelanggan</b></td>
        <td colspan="3"><b>' . $total_pndptn . ' Pelanggan</b></td>
    </tr>
    <tr>
        <td colspan="6"><b>Total Pendapatan</b></td>
        <td colspan="3"><b>Rp. ' . number_format($total) . '</b></td>
    </tr>
</table>';

// Cetak ke PDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('laporan_semua_data.pdf', 'I'); // 'I' untuk langsung tampil di browser
