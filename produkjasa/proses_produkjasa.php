<?php require "../koneksi.php";

if(isset($_POST['tambah_produk'])){


	$nama_produk = $_POST["nama_produk"];
	$kategori_produk = $_POST["kategori_produk"];
	$harga_produk = $_POST["harga_produk"];
	$satuan_produk = $_POST["satuan_produk"];

	mysqli_query($con, "INSERT INTO tb_produkjasa (nama_produk, kategori_produk, harga_produk, satuan_produk) VALUES('$nama_produk', '$kategori_produk', '$harga_produk', '$satuan_produk')") or die(mysqli_error($con));

	echo "<script>alert('Produk/Jasa berhasil di Tambahkan!');window.location='produkjasa.php';</script>";

} else if(isset($_POST['edit_produk'])){


	// ambil data produk yang ingin diubah
	$id_produk = $_POST['id_produk'];
	$nama_produk = $_POST['nama_produk'];
	$kategori_produk = $_POST['kategori_produk'];
	$harga_produk = $_POST['harga_produk'];
	$satuan_produk = $_POST['satuan_produk'];

    mysqli_query($con, "UPDATE tb_produkjasa SET id_produk='$id_produk', nama_produk='$nama_produk', kategori_produk='$kategori_produk', harga_produk='$harga_produk', satuan_produk='$satuan_produk'");
	echo "<script>alert('Data Produk / Jasa Sudah di Update');window.location='produkjasa.php';</script>";
}
?>
