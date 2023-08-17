<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require 'functions.php';


$produk = query("SELECT * FROM masterproduk ORDER BY id_produk DESC");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="katalog.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="  https://icons8.com/icon/z1an1lOJccC7/checklist">
    <title>Permata Print</title>
</head>

<body>
    <!--navbar & header-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PERMATA PRINT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-between" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pilihan.php">Pemesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_harga.php">Daftar Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="caraorder.php">Cara Pemesanan</a>
                    </li>
                    <li class="nav-item dro">
                        <a class="nav-link" href="ranjang.php"><i class="bi bi-cart"></i> </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person"></i>
                            <?php
                            if (isset($_SESSION["cusname"])) {
                                echo $_SESSION["cusname"];
                            } else {
                                echo 'user';
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="registrasi.php">Register</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--konten-->
    <div class="kon">
        <h2>Jual Kaos Custom Satuan</h2>
    </div>

    <!--produk-->
    <div class="katalog">
        <h1 class="kat">produk</h1>
    </div>
    <div class="container text-center">
        <img src="pic/jersey/jersey1.png" class="card-img-top" alt="..." width="80" height="890">
        <h2 style="padding-bottom: 10px; font-weight: bold;">KAOS JERSEY</h2>
        <p>Jersey adalah salah satu jenis kain rajut yang kerap digunakan bahan pembuatan industri konveksi. saat ini, bahan
            jersey lebih sering dijadikan sebagai campuran bahan antara sintetis dan juga serat katun.
        </p>
        <h2 style="padding-bottom: 10px; font-weight: bold;">Karakteristik Kaos Jersey</h2>
        <p>-> Tidak mudah kusut</p>
        <p>-> Menyerap Keringat</p>
        <p>-> Mudah di cuci</p>
    </div>

    <!-- footer -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid" style="background-color: #242124;">
        <div class="row g-4">
            <div class="col-3" style="margin-left: 40px; margin-top:50px;">
                <h3 style="color:white; font-weight: bold;">PERMATA PRINT</h3>
            </div>
            <div class="col-3" style="color:white; margin-top:50px;">
                <h3>LAYANAN KAMI</h3>
                <p><i class="bi bi-arrow-right-short"></i> Jual Baju Custom</p>
                <p><i class="bi bi-arrow-right-short"></i> Jasa Sablon Kaos</p>
            </div>
            <div class="col-3" style="color:white; margin-top:50px;">
                <h3>HUBUNGI KAMI</h3>
                <p><i class="bi bi-telephone-fill"></i> +62-857-8017-8107</p>
            </div>
            <div class="col-2" style="color:white; margin-top:50px;">
                <h3>ALAMAT</h3>
                <p><i class="bi bi-geo-alt-fill"></i> Jl. Pasir Awi, RT.003/RW.002, Sukaasih, Kec. Ps. Kemis, Kabupaten Tangerang, Banten 15560</p>
                <p><i class="bi bi-geo-alt-fill"></i> -6.184947, 106.534759</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>