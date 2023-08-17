<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require 'php/koneksi.php';

if (isset($_SESSION["cusname"])) {
    $id_pelanggan =  $_SESSION["cusname"];
    // $produk = mysqli_query($conn, "SELECT * FROM Keranjang LEFT JOIN masterproduk USING(id_produk) WHERE username = '$id_pelanggan' ORDER BY id_keranjang DESC ");

    $jumlah = mysqli_query($conn, "SELECT COUNT(*)  FROM keranjang WHERE username = '$id_pelanggan' ");
    $jumlahproduk = mysqli_fetch_array($jumlah)[0];
}

// $id_destinasi = $_GET["id_destinasi"];
$id_keranjang = $_GET["id_keranjang"];

// die();

// $id_transaksi = $_POST["id_transaksi"];
$username = $_POST["username"];
$upload_gambar = $_POST["upload_gambar"];
$nama_produk = $_POST["nama_produk"];
$ukuran_produk = $_POST["ukuran_produk"];
$jenis_cat = $_POST["jenis_cat"];
$ukuran_desain = $_POST["ukuran_desain"];
$harga_produk = $_POST["harga_produk"];
$jumlah_produk = $_POST["jumlah_produk"];
$file_desain = $_POST["file_desain"];
$deskripsi_desain = $_POST["deskripsi_desain"];
$status = $_POST["status"];
$total_harga = $_POST["total_harga"];
// $id_user = $_SESSION['user_id']['id_user'];
// $harga_total = $price * $qty;
// $id_transaksi = rand();
// $id_transaksi = $_GET['id_transaksi'];




// $query_sql = "INSERT INTO transaksi (tujuan, tglberangkat, tglkembali, jamberangkat, jamkembali, destinasi, qty, price)
// 			  VALUES              ('$tujuan', '$tglberangkat', '$tglkembali', '$jamberangkat', '$jamkembali', '$destinasi', '$qty', '$harga_total')";

$query_sql = "SELECT * FROM keranjang WHERE id_keranjang='$id_keranjang'";


// header("location: ./midtrans/examples/snap/checkout-process.php?id_transaksi='".$id_transaksi."'");
header("location: ./midtrans/examples/snap/checkout-process.php?id_keranjang=$id_keranjang");
// Belum bisa
