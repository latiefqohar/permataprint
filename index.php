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
  <link rel="stylesheet" type="text/css" href="ilham.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="  https://icons8.com/icon/z1an1lOJccC7/checklist">
  <title>Permata print</title>
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
            <a class="nav-link d-flex justify-content-between" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pilihan.php">Pemesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="katalog.php">Produk</a>
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

  <!--content atas-->
  <div class="container">
    <div class="row menu1">
      <div class="col">
        <img src="pic/Desain tanpa judul.png" style="width:850px; height:500px;">
      </div>
    </div>
    <div class="col">
      <div class="dop">
        <h2 class="loop">pemesanan</h2>
        <p class="ket">klik kotak hijau di bawah
          ini untuk pemesanan melalui whatsapp
        </p>
        <a href="https://api.whatsapp.com/send?phone=6285780178107">
          <button type="button" class="btn btn-lg">Whatsapp</button></a>
      </div>
    </div>
  </div>

  <!--Layanan kami-->
  <div class="katalog">
    <h1 class="kat">layanan kami</h1>
  </div>
  <div class="container kato text-center">
    <div class="row">
      <div class="col">
        <div class="card">
          <img src="icons/kaos.png" class="card-img-top" alt="..." height="320">
          <div class="card-body">
            <h5 class="card-title">KAOS CUSTOM</h5>
            <p><img width="46" height="46" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah.png" alt="external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah" />Kaos Dari Kami</p>
            <p><img width="46" height="46" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah.png" alt="external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah" />Tersedia Bermacam-Macam Kaos</p>
            <a href="https://api.whatsapp.com/send?phone=6281311394346" class="btn btn-primary">Tanya Kaos Custom</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="icons/printing.png" class="card-img-top" alt="..." height="320">
          <div class="card-body">
            <h5 class="card-title">JASA SABLON</h5>
            <p><img width="46" height="46" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah.png" alt="external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah" />Bawa Kaos Sendiri</p>
            <p><img width="46" height="46" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah.png" alt="external-checklist-essentials-pack-tanah-basah-glyph-tanah-basah" />Tanpa Minimal Pesanan</p>
            <a href="https://api.whatsapp.com/send?phone=6281311394346" class="btn btn-primary">Tanya Jasa Sablon</a>
          </div>
        </div>
      </div>
    </div>

    <!--Jenis Layanan-->
    <div class="container">
      <h1 class="jns_lyn">Teknik Sablon</h1>
      <div class="row menu2">
        <div class="col">
          <img class="gmbr1" src="pic/sablonmanual.jpg">
        </div>
        <div class="col">
          <h2 class="ket1">sablon manual</h2>
          <p class="p1">Sablon manual adalah teknik sablon yang menggunakan alat yang disebut
            layar (screen), yang tersedia dalam berbagai bentuk, ketebalan, ukuran
            dan juga jaring tipis dan tebal dari alat yang sesuai dengan kebutuhan kalian</p>
        </div>
      </div>
    </div>

    <!--produk-->
    <div class="katalog">
      <h1 class="kat">produk</h1>
    </div>
    <div class="container kato text-center">
      <div class="row">
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="pic/o-neck/hita_prev_ui.png" class="card-img-top" alt="..." width="180" height="270">
            <div class="card-body">
              <h5 class="card-title">Kaos Cotton Combed</h5>
              <a href="detailprodukcottoncombed.php" class="btn btn-success">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="pic/poly/polyhijau.png" class="card-img-top" alt="..." width="180" height="270">
            <div class="card-body">
              <h5 class="card-title">Kaos Polyster</h5>
              <a href="detailprodukpolyster.php" class="btn btn-success">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="pic/Hyget//hyget2.png" class="card-img-top" alt="..." width="180" height="270">
            <div class="card-body">
              <h5 class="card-title">Kaos Hyget</h5>
              <a href="detailprodukhyget.php" class="btn btn-success">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem; height: 26.2rem;">
            <img src="pic/jersey/jersey1.png" class="card-img-top" alt="..." width="180" height="270">
            <div class="card-body">
              <h5 class="card-title">Kaos Jersey</h5>
              <a href="detailprodukjersey.php" class="btn btn-success">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      <div class="col-3" style="color:white; margin-top:-1px;">
        <h5>LAYANAN KAMI</h5>
        <p><i class="bi bi-arrow-right-short"></i> Jual Baju Custom</p>
        <p><i class="bi bi-arrow-right-short"></i> Jasa Sablon Kaos</p>
      </div>
      <div class="col-3" style="color:white; margin-top:-1px;">
        <h5>HUBUNGI KAMI</h3>
          <p><i class="bi bi-telephone-fill"></i> +62-857-8017-8107</p>
      </div>
      <div class="col-2" style="color:white; margin-top:-1px;">
        <h5>ALAMAT</h5>
        <p><i class="bi bi-geo-alt-fill"></i> Jl. Pasir Awi, RT.003/RW.002, Sukaasih, Kec. Ps. Kemis, Kabupaten Tangerang, Banten 15560</p>
        <p><i class="bi bi-geo-alt-fill"></i> -6.184947, 106.534759</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>


</html>