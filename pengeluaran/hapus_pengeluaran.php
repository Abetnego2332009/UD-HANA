<?php
// berisi dari koneksi dari config
require "../koneksi.php";

$id = $_GET['id'];

// get kategori data
$query = mysqli_query($con, "SELECT * FROM tb_pengeluaran WHERE id_pengeluaran = '$id'");
$data = mysqli_fetch_array($query);

// delete produk data from database
mysqli_query($con, "DELETE FROM tb_pengeluaran WHERE id_pengeluaran = '$id'") or die (mysqli_error($con));

// check if there is a related image file
if (!empty($data['bukti_pengeluaran'])) {
  // delete the image file
  $image_path = "C://xampp/htdocs/ud_hana/bukti_pengeluaran/" . $data['bukti_pengeluaran'];
  if (file_exists($image_path)) {
    unlink($image_path);
  }
}

// redirect to produk page
echo "<script>alert('Data berhasil di Hapus!');window.location='pengeluaran.php';</script>";



?>