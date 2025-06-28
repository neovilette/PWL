<?php
include 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$product = null;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

if (!$product) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $stmt = $conn->prepare("UPDATE products SET nama_produk=?, harga=?, stok=? WHERE id=?");
    $stmt->bind_param("sdii", $nama, $harga, $stok, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}
?>
