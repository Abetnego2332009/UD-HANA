<?php
include '../koneksi.php';

if (isset($_GET['id_produk']) && is_numeric($_GET['id_produk'])) {
    $id_produk = intval($_GET['id_produk']);
    $stmt = $con->prepare("SELECT harga_produk, satuan_produk FROM tb_produkjasa WHERE id_produk = ?");
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['harga_produk' => 0, 'satuan_produk' => '']);
    }
    $stmt->close();
}
?>
