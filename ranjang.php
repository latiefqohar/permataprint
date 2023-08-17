<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require 'functions.php';

$total_belanja = 0;

if (isset($_SESSION["cusname"])) {
  $id_pelanggan =  $_SESSION["cusname"];
  $produk = mysqli_query($conn, "SELECT * FROM Keranjang LEFT JOIN masterproduk USING(id_produk) WHERE username = '$id_pelanggan' && status='1' ORDER BY id_keranjang DESC ");

  $jumlah = mysqli_query($conn, "SELECT COUNT(*)  FROM keranjang WHERE username = '$id_pelanggan' ");
  $jumlahproduk = mysqli_fetch_array($jumlah)[0];
}

if (isset($_POST["chekout"])) {
  header("location:isi_data.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="ranjang.css">
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
            <a class="nav-link d-flex justify-content-between" aria-current="page" href="index.php">Home</a>
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

  <!-- keranjang -->

  <div class="container mt-5">
    <?php if (!isset($_SESSION["cusname"])) { ?>
      <div class="pt-4">
        <div class="mt-4 alert alert-info" role="alert">
          Belum Ada Barang Yang Di Masukan
        </div>
      </div>

    <?php } else { ?>
      <h1 class="pt-4" style="color:#16DF7E"><b> KERANJANG BELANJA </b></h1>
      <!-- <h3><?php echo $jumlahproduk ?> Produk</h3> -->

      <?php foreach ($produk as $row) { ?>
        <?php
        //error_reporting(0);

        $harga = $row["harga_produk"];
        $jumlah = $row["jumlah_produk"];
        $total_harga = ($harga * $jumlah)-$row["potongan"];
        $total_belanja += $total_harga;
        $status = $row["status"];

        ?>



        <div id="load_cart">

          <div class="row g-0 position-relative mt-3 rounded rounded-3 shadow-lg">
            <div class="col-md-3 p-4 ">
              <img src="gambar/<?php echo $row['upload_gambar'] ?>" class="rounded rounded-3 w-100">
            </div>
            <div class="col-md-3 mt-3 px-2">
              <h2><?php echo $row['nama_produk'] ?></h2>
              <p>Harga : Rp. <?php echo number_format($row['harga_produk'], 2, ',', '.') ?></p>
              <p>Jumlah : <?php echo $row['jumlah_produk'] ?></p>
              <p>Ukuran Pakaian : <?php echo $row["ukuran_produk"] ?></p>
              <p>Jenis Cat : <?php echo $row["jenis_cat"] ?></p>
              <p>Ukuran Desain : <?php echo $row["ukuran_desain"] ?></p>
              <p> Catatan : <?= $row["deskripsi_desain"] ?></p>
              <p> Alamat Pengiriman : <?= $row["address"] ?></p>

              <p> Status :
                <?php
                if ($status >= 3) {
                  echo "<td><b>Pembayaran Sukses</b></span></td>";
                } else if ($status >= 2) {
                  echo "<td><b>Pembayaran Pending</b></span></td>";
                } else if ($status = 1) {
                  echo "<td><b>Pembayaran Belum Dilakukan</b></span></td>";
                } ?> </p>

            </div>



            <div class="col-md-3 mt-3">
              <div class="d-flex px-2">
                <h4>
                  <a href="hapus_keranjang.php?id_keranjang=<?php echo $row['id_keranjang'] ?>" class="text-decoration-none" onclick="
                    return confirm('Yakin ingin menghapus Produk dari kerenjang')">
                    <i class="bi bi-trash-fill text-danger w-100 h-100">Hapus</i>
                  </a>
                </h4>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <h3 class="mt-3"><b> TOTAL BELANJAAN : Rp. <?php echo number_format($total_belanja, 2, ',', '.') ?></b></h3>
      <form action="" method="post">
        <a href="basket.php?id_keranjang=<?php echo $row['id_keranjang']; ?>" name="chekout">
          <button type="button" class="btn btn-success"><i class="bi bi-cart-check-fill me-2"></i>checkout</button></a>
        <a href="pilihan.php">
          <button type="button" class="btn btn-success">Kembali</button></a>
      </form>

    <?php } ?>

  </div>

  <!-- footer -->
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
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
        <h5>LAYANAN KAMI</h5>
        <p><i class="bi bi-arrow-right-short"></i> Jual Baju Custom</p>
        <p><i class="bi bi-arrow-right-short"></i> Jasa Sablon Kaos</p>
      </div>
      <div class="col-3" style="color:white; margin-top:50px;">
        <h5>HUBUNGI KAMI</h5>
        <p><i class="bi bi-telephone-fill"></i> +62-857-8017-8107</p>
      </div>
      <div class="col-2" style="color:white; margin-top:50px;">
        <h5>ALAMAT</h5>
        <p><i class="bi bi-geo-alt-fill"></i> Jl. Pasir Awi, RT.003/RW.002, Sukaasih, Kec. Ps. Kemis, Kabupaten Tangerang, Banten 15560</p>
        <p><i class="bi bi-geo-alt-fill"></i> -6.184947, 106.534759</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>