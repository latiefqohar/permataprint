<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require '../functions.php';

// if (!isset($_SESSION["login1"])) {
//     header("location:login.php");
//     exit;
// }

if (isset($_POST["tambah_produk"])) {

  if (tambah_produk($_POST) > 0) {
    echo "<script>
                alert('Data Berhasil DiTambahkan ');
                document.location.href = 'produk.php';
            </script>";
  } else {
    echo "<script>
                alert('Data Gagal DiTambahkan ');
                document.location.href = 'produk.php';
            </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="tambahbaruadmin.css">
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

  <!-- kelola produk -->
  <div class="container">
    <h1 class="tulispro">tambah data produk</h1>
  </div>
  <form method="POST" enctype="multipart/form-data" class="pros">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Kode</label>
      <input type="text" name="kode" placeholder="Masukan Produk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
      <input type="text" name="nama_produk" placeholder="Masukan Produk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Harga</label>
      <input type="text" name="harga" placeholder="Masukan Harga" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Ukuran</label>
      <input type="text" name="ukuran" placeholder="Masukan Ukuran" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Jumlah</label>
      <input type="text" name="jumlah" placeholder="Masukan Jumlah" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
      <input type="text" name="deskripsi" placeholder="Masukan Deskripsi" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Masukan File Gambar Produk</label>
      <input class="form-control" name="foto" type="file" id="foto" required>
    </div>
    <button type="submit" class="btn btn-outline-primary bot" name="tambah_produk" id="tambah_produk">Tambah</button>
  </form>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>