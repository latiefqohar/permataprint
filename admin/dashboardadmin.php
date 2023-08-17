<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website //untuk memulai eksekusi session pada server dan kemudian menyimpannya pada browser
session_start();

//untuk mengecek apakah session "username" sudah di set //isset digunakan untuk dapat memeriksa apakah sebuah variabel telah di set.
if (!isset($_SESSION['username'])) {
  header("Location: loginadmin.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="admin2.css">
  <title>Document</title>
</head>

<body>
  <!-- header -->
  <ul class="header">
    <li class="head-link">Permata Print</li>
    <li class="nav-item dropdown login">
      <button class="btn dropdown-toggle text-white drop fs-4 fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $_SESSION["username"]; ?>
      </button>
      <ul class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item" href="logoutadmin.php">Log Out</a></li>
      </ul>
    </li>
  </ul>

  <!--navbar & header-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Master
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="produk.php">Data Produk</a></li>
              <li><a class="dropdown-item" href="mastercustomer.php">Data Customer</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Transaksi
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="produksi1.php">Data Pesanan</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <h1 class="dash">dashboard</h1>


  <?php
  // menghubungkan dengan koneksi database
  include '../php/koneksi.php';

  // mengambil data user
  $data_user = mysqli_query($conn, "SELECT * FROM user");

  $sql = mysqli_query($conn, "SELECT SUM(total_harga) as total FROM keranjang");
  $row = mysqli_fetch_array($sql);
  $sum = $row['total'];

  // jumlah pesanan
  $pesan = mysqli_query($conn, "SELECT id_keranjang FROM keranjang");

  // menghitung jumlah pesanan
  $pesan_baru = mysqli_num_rows($pesan);

  // menghitung jumlah data user
  $jumlah_user = mysqli_num_rows($data_user);
  ?>

  <!-- dashboard -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pesanan Baru</h5>
          <p class="card-text"><?php echo $pesan_baru; ?></p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Total Pendapatan</h5>
          <p class="card-text">Rp. <?php echo $sum; ?></p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Jumlah Customer</h5>
          <p class="card-text"><?php echo $jumlah_user; ?></p>
        </div>
      </div>
    </div>
  </div>







  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>