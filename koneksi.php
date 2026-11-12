<?php
// Setting default timezone
date_default_timezone_set('Asia/Jakarta');

// Panggil session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Aktifkan error reporting yang baik untuk mysqli (gunakan try-catch)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $con = new mysqli("localhost", "root", "", "ud_hana");
    $con->set_charset("utf8mb4"); // opsional tapi direkomendasikan
} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Database error, silakan coba lagi nanti.');
}

// Fungsi base url agar dinamis
function base_url($url = null)
{
    $base_url = "http://localhost/ud_hana";
    return $url ? $base_url . "/" . $url : $base_url;
}

// Fungsi untuk mengganti format tanggal ke format Indonesia
function tgl_indo($tgl)
{
    if (!$tgl || strlen($tgl) < 10) return $tgl;
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return "$tanggal/$bulan/$tahun";
}