<?php
require "../koneksi.php";

if (isset($_POST['tambah_pengeluaran'])) {

  $tanggal_pengeluaran = $_POST["tanggal_pengeluaran"];
  $jenis_pengeluaran = $_POST["jenis_pengeluaran"];
  $rincian_pengeluaran = $_POST["rincian_pengeluaran"];
  $jumlah_pengeluaran = $_POST["jumlah_pengeluaran"];
  $metode_pengeluaran = $_POST["metode_pengeluaran"];
  $kepada_pengeluaran = $_POST["kepada_pengeluaran"];

  // Default nama file NULL
  $nama_file = null;

  // Cek apakah ada file yang diupload
  if (isset($_FILES["bukti_pengeluaran"]) && $_FILES["bukti_pengeluaran"]["error"] == 0) {
    $nama_file = time() . '-' . basename($_FILES["bukti_pengeluaran"]["name"]);
    $target = "C://xampp/htdocs/ud_hana/bukti_pengeluaran";
    $target_file = $target . '/' . $nama_file;

    // Pindahkan file
    move_uploaded_file($_FILES["bukti_pengeluaran"]["tmp_name"], $target_file);
  }

  // Simpan ke database
  $query = "INSERT INTO tb_pengeluaran 
    (tanggal_pengeluaran, jenis_pengeluaran, rincian_pengeluaran, jumlah_pengeluaran, metode_pengeluaran, kepada_pengeluaran, bukti_pengeluaran)
    VALUES (
      '$tanggal_pengeluaran',
      '$jenis_pengeluaran',
      '$rincian_pengeluaran',
      '$jumlah_pengeluaran',
      '$metode_pengeluaran',
      '$kepada_pengeluaran',
      " . ($nama_file ? "'$nama_file'" : "NULL") . "
    )";

  mysqli_query($con, $query) or die(mysqli_error($con));

  echo "<script>alert('Data Sudah Ditambahkan!');window.location='pengeluaran.php';</script>";
}

else if (isset($_POST['edit_pengeluaran'])) {

  $id_pengeluaran = $_POST["id_pengeluaran"];
  $tanggal_pengeluaran = $_POST["tanggal_pengeluaran"];
  $jenis_pengeluaran = $_POST["jenis_pengeluaran"];
  $rincian_pengeluaran = $_POST["rincian_pengeluaran"];
  $jumlah_pengeluaran = $_POST["jumlah_pengeluaran"];
  $metode_pengeluaran = $_POST["metode_pengeluaran"];
  $kepada_pengeluaran = $_POST["kepada_pengeluaran"];
  $bukti_lama = $_POST['bukti_pengeluaran'];


  // cek apakah pengguna memilih untuk mengupload gambar baru
  if (!empty($_FILES["bukti_pengeluaran"]["name"])) {
      // hapus gambar lama
      unlink("C://xampp/htdocs/ud_hana/bukti_pengeluaran/$bukti_lama");
      
      // ambil data gambar baru
      $nama_file = time(). '-' . basename($_FILES["bukti_pengeluaran"]["name"]);
      $target = "C://xampp/htdocs/ud_hana/bukti_pengeluaran";
      $target_dir = $target;
      $target_file = $target_dir . '/' . $nama_file;
      
      if (move_uploaded_file($_FILES["bukti_pengeluaran"]["tmp_name"], $target_file)) {
        // update DB jika berhasil upload
        mysqli_query($con, "UPDATE tb_pengeluaran SET tanggal_pengeluaran='$tanggal_pengeluaran', jenis_pengeluaran='$jenis_pengeluaran', rincian_pengeluaran='$rincian_pengeluaran', jumlah_pengeluaran='$jumlah_pengeluaran', metode_pengeluaran='$metode_pengeluaran', kepada_pengeluaran='$kepada_pengeluaran', bukti_pengeluaran='$nama_file' WHERE id_pengeluaran='$id_pengeluaran'");
    } else {
        echo "<script>alert('Gagal mengupload gambar baru.');</script>";
        exit;
    }

  } else {
      // update data kamar tanpa mengubah gambar
      mysqli_query($con, "UPDATE tb_pengeluaran SET tanggal_pengeluaran='$tanggal_pengeluaran', jenis_pengeluaran='$jenis_pengeluaran', rincian_pengeluaran='$rincian_pengeluaran', jumlah_pengeluaran='$jumlah_pengeluaran', metode_pengeluaran='$metode_pengeluaran', kepada_pengeluaran='$kepada_pengeluaran' WHERE id_pengeluaran='$id_pengeluaran'");
  }

  echo "<script>alert('Data berhasil di Update');window.location='pengeluaran.php';</script>";


}

?>
