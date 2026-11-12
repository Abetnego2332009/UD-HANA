<?php
// berisi dari koneksi dari config
require "../koneksi.php";

$id = $_GET['id'];

// delete user data from database
mysqli_query($con, "DELETE FROM tb_user WHERE id_user = '$id'") or die (mysqli_error($con));

// redirect to user page
echo "<script>alert('Berhasil Hapus Data!');window.location='pengguna.php';</script>";

?>