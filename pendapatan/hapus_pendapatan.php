<?php
// berisi dari koneksi dari config
require "../koneksi.php";

$id = $_GET['id'];

// delete user data from database
mysqli_query($con, "DELETE FROM tb_pendapatan WHERE id_pendapatan = '$id'") or die (mysqli_error($con));

// redirect to pendapatan page
echo "<script>alert('Berhasil Hapus Data!');window.location='pendapatan.php';</script>";

?>