<?php
require "../koneksi.php";

if (isset($_POST['tambah_pendapatan'])) {
  $tanggal_pendapatan = $_POST["tanggal_pendapatan"];
  $nama_pelanggan = $_POST["nama_pelanggan"];
  $nomor_pelanggan = $_POST["nomor_pelanggan"];
  $id_produk = $_POST["nama_produk"]; // <== select option yang dikirim adalah ID
  $harga_produk = $_POST["harga_produk"];
  $satuan_produk = $_POST["satuan_produk"];
  $jumlah_produk = $_POST["jumlah_produk"];
  $total_pendapatan = $_POST["total_pendapatan"];
  $metode_pembayaran = $_POST["metode_pembayaran"];
  $catatan_pendapatan = $_POST["catatan_pendapatan"];

  // Ambil nama_produk dari database berdasarkan id_produk
  $result = mysqli_query($con, "SELECT nama_produk FROM tb_produkjasa WHERE id_produk = '$id_produk'") or die(mysqli_error($con));
  $row = mysqli_fetch_assoc($result);
  $nama_produk = $row['nama_produk'];

  // Simpan ke database
  $query = "INSERT INTO tb_pendapatan 
      (tanggal_pendapatan, nama_pelanggan, nomor_pelanggan, id_produk, nama_produk, harga_produk, satuan_produk, jumlah_produk, total_pendapatan, metode_pembayaran, catatan_pendapatan)
      VALUES (
        '$tanggal_pendapatan',
        '$nama_pelanggan',
        '$nomor_pelanggan',
        '$id_produk',
        '$nama_produk',
        '$harga_produk',
        '$satuan_produk',
        '$jumlah_produk',
        '$total_pendapatan',
        '$metode_pembayaran',
        '$catatan_pendapatan'
      )";

  mysqli_query($con, $query) or die(mysqli_error($con));

  echo "<script>alert('Pendapatan berhasil ditambahkan!');window.location='pendapatan.php';</script>";
} 

else if (isset($_POST['edit_pendapatan'])) {
    $id_pendapatan = $_POST["id_pendapatan"];
    $tanggal_pendapatan = $_POST["tanggal_pendapatan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $nomor_pelanggan = $_POST["nomor_pelanggan"];
    $id_produk = $_POST["id_produk"]; // ini ID dari dropdown
    $harga_produk = $_POST["harga_produk"];
    $satuan_produk = $_POST["satuan_produk"];
    $jumlah_produk = $_POST["jumlah_produk"];
    $total_pendapatan = $_POST["total_pendapatan"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $catatan_pendapatan = $_POST["catatan_pendapatan"];

    // Ambil nama produk dari tb_produkjasa (opsional, jika masih disimpan di tb_pendapatan)
    $result = mysqli_query($con, "SELECT nama_produk FROM tb_produkjasa WHERE id_produk = '$id_produk'") or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);
    $nama_produk = $row['nama_produk'];

    // Jalankan UPDATE
    $query = "UPDATE tb_pendapatan SET 
        tanggal_pendapatan = '$tanggal_pendapatan',
        nama_pelanggan = '$nama_pelanggan',
        nomor_pelanggan = '$nomor_pelanggan',
        id_produk = '$id_produk',
        nama_produk = '$nama_produk',
        harga_produk = '$harga_produk',
        satuan_produk = '$satuan_produk',
        jumlah_produk = '$jumlah_produk',
        total_pendapatan = '$total_pendapatan',
        metode_pembayaran = '$metode_pembayaran',
        catatan_pendapatan = '$catatan_pendapatan'
        WHERE id_pendapatan = '$id_pendapatan'
    ";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Data pendapatan berhasil diperbarui!'); window.location='pendapatan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data pendapatan: " . mysqli_error($con) . "'); window.history.back();</script>";
    }
}


?>
