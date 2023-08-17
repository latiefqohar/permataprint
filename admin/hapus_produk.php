<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website //untuk memulai eksekusi session pada server dan kemudian menyimpannya pada browser
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require '../functions.php';

$id = $_GET["id"]; //ambil data

if (hapus_produk($id) > 0) {
    echo "<script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'produk.php';
        </script>";
} else {
    echo "<script>
            alert('Data Gagal Di Hapus');
            document.location.href = 'produk.php';
        </script>";
}
