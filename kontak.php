<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require 'functions.php';

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

  <!--kontak-->
  <div class="map">
    <h5 style="margin-top:10vh;">MAP</h5>
    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d247.91215127280506!2d106.53468111919318!3d-6.184997564868635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMTEnMDUuOSJTIDEwNsKwMzInMDUuMSJF!5e0!3m2!1sid!2sid!4v1685437316080!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

  <!-- footer -->
  <br>
  <br>
  <br>
  <br>
  <br>
  <div style="border-top: 5px solid #16DF7E; padding: 20px; margin-top: 20px; "></div>
  <div class="container-fluid">
    <div class="row g-3">
      <div class="col-4" style="margin-left: 40px;">
        <p style="color: #16DF7E; font-weight: bold; font-size: 20px;">PERMATA PRINT</p>
        <p>Jl. Tanah Merah Indah 1 No.10C</p>
        <p>+62-857-8017-8107</p>
        <p>PermataPrint@gmail.com</p>
      </div>
      <div class="col-4">
        <p>Menu</p>
        <p>Produk</p>
        <p>Tentang Kami</p>
        <p>Hubungi Kami</p>
      </div>
    </div>
    <div class="copy" style="background-color:#16DF7E; text-align: center; color: white; padding: 0.5px; margin-top: 20px">
      <p>Copyright&copy;PermataPrint</p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>