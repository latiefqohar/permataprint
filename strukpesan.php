<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//if (!isset($_SESSION['cusname'])) {
//  header("Location: login.php");
//}

//menyertakan file php lain ke dalam suatu program PHP
require 'functions.php';

// if (!isset($_SESSION["login1"])) {
//     header("location:login.php");
//     exit;
// }

// $produk = query("SELECT * FROM masterproduk ORDER BY id_produk DESC");

// $total_belanja = 0;

if (isset($_SESSION["cusname"])) {
    $id_pelanggan =  $_SESSION["cusname"];
    //   $produk = mysqli_query($conn, "SELECT * FROM Keranjang LEFT JOIN masterproduk USING(id_produk) WHERE username = '$id_pelanggan' ORDER BY id_keranjang DESC ");

    //   $jumlah = mysqli_query($conn, "SELECT COUNT(*)  FROM keranjang WHERE username = '$id_pelanggan' ");
    //   $jumlahproduk = mysqli_fetch_array($jumlah)[0];
    // }

    // if (isset($_POST["chekout"])) {
    //   header("location:isi_data.php");
}
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
    <style>
        table,
        tr,
        td {
            border: 1px solid black;
        }

        thead {
            background-color: #cccddd;
        }

        .container {
            margin-top: 30px;
            text-align: center;
        }

        h2 {
            margin-top: 90px;
        }

        table.center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
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

    <!--content atas-->
    <h2>Struck Pesanan Anda</h2>
    <div class="container">
        <table class="center">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Produk</td>
                    <td>Harga Produk</td>
                    <td>Jumlah</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM Keranjang LEFT JOIN masterproduk USING(id_produk) WHERE username = '$id_pelanggan' ORDER BY id_keranjang DESC");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama_produk'] ?></td>
                    <td><?php echo $data['harga_produk'] ?></td>
                    <td><?php echo $data['jumlah_produk'] ?></td>
                    <td>
                        <a type="button" href="pembayaransukses.php?order_id=<?php echo $data['id_keranjang']; ?>" type="button" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>


    <!-- <div class="col">
          <div class="card h-100">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Nama Produk</h5>
              <p class="card-text">Rp. </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card h-100">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Nama Produk</h5>
              <p class="card-text">Rp. </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
          </div>
        </div> -->
    <!-- </div> -->
    <!-- </div> -->





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
                <h5>HUBUNGI KAMI</h5>
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