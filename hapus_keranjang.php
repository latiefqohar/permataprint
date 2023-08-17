<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require 'functions.php';

//ambil data
$id = $_GET["id_keranjang"];

if (hapus_keranjang($id) > 0) {
    echo "<script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'ranjang.php';
        </script>";
} else {
    echo "<script>
            alert('Data Gagal Di Hapus');
            document.location.href = 'ranjang.php';
        </script>";
}
