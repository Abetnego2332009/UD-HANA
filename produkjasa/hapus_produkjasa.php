<?php
// berisi dari koneksi dari config
require "../koneksi.php";

$id = $_GET['id'];

// delete user data from database
mysqli_query($con, "DELETE FROM tb_produkjasa WHERE id_produk = '$id'") or die (mysqli_error($con));

// redirect to produk page
echo "<script>alert('Berhasil Hapus Data!');window.location='produkjasa.php';</script>";

?>