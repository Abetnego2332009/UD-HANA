<?php
require "../koneksi.php";

if (isset($_POST['tambah_pelanggan'])) {
  $tanggal_pelanggan = $_POST["tanggal_pelanggan"];
  $jenis_pelanggan = $_POST["jenis_pelanggan"];
  $nomor_pelanggan = $_POST["nomor_pelanggan"];
  $email_pelanggan = $_POST["email_pelanggan"];
  $alamat_pelanggan = $_POST["alamat_pelanggan"];
  $catatan_pelanggan = $_POST["catatan_pelanggan"];

  // Simpan ke database
  $query = "INSERT INTO tb_pelanggan 
      (tanggal_pelanggan, jenis_pelanggan, nomor_pelanggan, email_pelanggan, alamat_pelanggan, catatan_pelanggan)
      VALUES (
        '$tanggal_pelanggan',
        '$jenis_pelanggan',
        '$nomor_pelanggan',
        '$email_pelanggan',
        '$alamat_pelanggan',
        '$catatan_pelanggan'
      )";

  mysqli_query($con, $query) or die(mysqli_error($con));

  echo "<script>alert('Data berhasil ditambahkan!');window.location='pelanggan.php';</script>";
} 

else if (isset($_POST['edit_pelanggan'])) {
    $id_pelanggan = $_POST["id_pelanggan"];
    $tanggal_pelanggan = $_POST["tanggal_pelanggan"];
    $jenis_pelanggan = $_POST["jenis_pelanggan"];
    $nomor_pelanggan = $_POST["nomor_pelanggan"];
    $email_pelanggan = $_POST["email_pelanggan"];
    $alamat_pelanggan = $_POST["alamat_pelanggan"];
    $catatan_pelanggan = $_POST["catatan_pelanggan"];

    // Jalankan UPDATE
    $query = "UPDATE tb_pelanggan SET 
        tanggal_pelanggan = '$tanggal_pelanggan',
        jenis_pelanggan = '$jenis_pelanggan',
        nomor_pelanggan = '$nomor_pelanggan',
        email_pelanggan = '$email_pelanggan',
        alamat_pelanggan = '$alamat_pelanggan',
        catatan_pelanggan = '$catatan_pelanggan'
        WHERE id_pelanggan = '$id_pelanggan'
    ";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='pelanggan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($con) . "'); window.history.back();</script>";
    }
}


?>
