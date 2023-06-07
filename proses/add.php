<?php
include '../koneksi/koneksi.php';

if (isset($_GET['produk']) && isset($_GET['kd_cs']) && isset($_GET['hal'])) {
    $kd_produk = $_GET['produk'];
    $kd_cs = $_GET['kd_cs'];
    $hal = $_GET['hal'];

    // Query untuk mendapatkan data produk berdasarkan kode produk
    $query_produk = "SELECT * FROM produk WHERE kode_produk = '$kd_produk'";
    $result_produk = mysqli_query($conn, $query_produk);
    $row_produk = mysqli_fetch_assoc($result_produk);

    // Periksa apakah produk sudah ada dalam keranjang
    $query_cek_keranjang = "SELECT * FROM keranjang WHERE kode_customer = '$kd_cs' AND kode_produk = '$kd_produk'";
    $result_cek_keranjang = mysqli_query($conn, $query_cek_keranjang);

    if (mysqli_num_rows($result_cek_keranjang) > 0) {
        // Jika produk sudah ada dalam keranjang, update jumlahnya
        $query_update_keranjang = "UPDATE keranjang SET qty = qty + 1 WHERE kode_customer = '$kd_cs' AND kode_produk = '$kd_produk'";
        mysqli_query($conn, $query_update_keranjang);
    } else {
        // Jika produk belum ada dalam keranjang, tambahkan produk ke dalam keranjang
        $query_tambah_keranjang = "INSERT INTO keranjang (kode_customer, kode_produk, nama_produk, harga, qty) VALUES ('$kd_cs', '$kd_produk', '{$row_produk['nama']}', {$row_produk['harga']}, 1)";
        mysqli_query($conn, $query_tambah_keranjang);
    }

    if ($hal == 1) {
        header("Location: ../index.php");
    } elseif ($hal == 2) {
        header("Location: detail_produk.php?produk=$kd_produk");
    } else {
        header("Location: keranjang.php");
    }
} else {
    // Jika tidak ada parameter yang diberikan, kembali ke halaman sebelumnya
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>
