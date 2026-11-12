<!-- index utama saat di akses -->
<?php
require_once 'koneksi.php';
// cek login session
if (isset($_SESSION['user'])) {
    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Kasir') {
        echo "<script>alert('Login Berhasil');window.location= '" . base_url('dashboard.php') . "';</script>";
    } else {
        echo "<script>alert('Login Gagal');window.location= '" . base_url('index.php') . "';</script>";
    }
}
