<?php

//memulai session //agar dapat menggunakan setiap fungsi session disetiap halaman website
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

    <style>
        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }

        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 44mm;
            background: #FFF;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: .9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 50px;
            width: 150px;
            background: url(./img/logopanjang.png) no-repeat;
            background-size: 160px 50px;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(./img/logopanjang.png) no-repeat;
            background-size: 70px 70px;
            border-radius: 60px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: .5em;
            background: #EEE;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: .5em;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }


        /* @media print
{
body * { visibility: hidden; }
.invoice-POS * { visibility: visible; }
.invoice-POS { position: absolute; top: 40px; left: 30px; }
} */
    </style>

    <script>
        window.console = window.console || function(t) {};
    </script>



    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>


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

    <br>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM user WHERE cusname='" . $_SESSION['cusname'] . "';");
    while ($data = mysqli_fetch_array($query)) {

    ?>
        <div id="invoice-POS" class="invoice-POS">

            <center id="top">
                <div class="logo"></div>
                <div class="info">
                    <h2>Permata Print</h2>
                </div><!--End Info-->
            </center><!--End InvoiceTop-->

            <div id="mid">
                <div class="info">
                    <h2>Info Kontak</h2>
                    <p>
                        Nama : <?= $data['nama']; ?></br>
                        Alamat : <?= $data['alamat']; ?></br>
                        Email : <?= $data['email']; ?></br>
                        Telephone : <?= $data['ponsel']; ?></br> <?php } ?>
                    </p>
                </div>
            </div><!--End Invoice Mid-->


            <div id="bot">
                <?php
                // include('koneksi.php');
                $id_keranjang = $_GET["order_id"];
                $query2 = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_keranjang='$id_keranjang' ");
                mysqli_query($conn, "UPDATE keranjang set status='3' where id_keranjang='$id_keranjang'");

                while ($data2 = mysqli_fetch_assoc($query2)) {
                ?>
                    <div id="table">
                        <table>
                            <tr class="tabletitle">
                                <td class="item">
                                    <h2>Nama Produk</h2>
                                </td>
                                <td class="item">
                                    <h2>Jumlah Produk</h2>
                                </td>
                                <td class="Hours">
                                    <h2>Harga Produk</h2>
                                </td>
                                <td class="Rate">
                                    <h2>Total Harga</h2>
                                </td>
                            </tr>

                            <tr class="service">

                                <td class="tableitem">
                                    <p class="itemtext"><?= $data2['nama_produk']; ?></p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext"><?= $data2['jumlah_produk']; ?></p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">Rp.<?= $data2['harga_produk']; ?></p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">Rp.<?= $data2['total_harga']; ?></p>
                                </td>
                            </tr>

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate">
                                    <h2>Total</h2>
                                </td>
                                <td></td>
                                <td class="payment">
                                    <h2>Rp.<?= $data2['total_harga']; ?></h2>
                                </td> <?php } ?>
                            </tr>

                        </table>
                    </div><!--End Table-->

                    <div id="legalcopy">
                        <p class="legal"><strong>Terimakasih Atas Pesanan Anda !</strong> Harap Simpan Bukti Struk Ini Dan Serahkan Kepada Kasir Kami
                        </p>
                        <!-- <a href="tabelsukses.php"><button type="button" class="btn btn-success btn-sm"></a>Kembali</button> -->
                        <a type="button" href="strukpesan.php" type="button" id="get-weather" class="btn btn-success btn-sm">Kembali</a>
                        <!-- <button onclick={function()}>Print only the above div</button> -->
                    </div>

                    <!-- <script>
                          window.print();
                        </script> -->

                    <script>

                    </script>

            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                snap.pay('<?php echo $snap_token ?>');
            }
        </script>
</body>

</html>