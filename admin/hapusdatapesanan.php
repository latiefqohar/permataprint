<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website //untuk memulai eksekusi session pada server dan kemudian menyimpannya pada browser
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require '../functions.php';

//ambil data
$id = $_GET["id_keranjang"];

if (hapusdatapesanan($id) > 0) {
    echo "<script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'produksi1.php';
        </script>";
} else {
    echo "<script>
            alert('Data Gagal Di Hapus');
            document.location.href = 'produksi1.php';
        </script>";
}
