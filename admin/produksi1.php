<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
include '../php/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
}

//menyertakan file php lain ke dalam suatu program PHP
require '../functions.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="admin2.css">
    <title>Admin Permata Print</title>
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
                        <a class="nav-link" href="dashboardadmin.php">Dashboard</a>
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
                            <li><a class="dropdown-item" href="produksi.php">Data Pesanan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Data Pesanan</b></h2>
        <br>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">id produk</th>
                    <th scope="col">nama produk</th>
                    <th scope="col">ukuran produk</th>
                    <th scope="col">jenis cat</th>
                    <th scope="col">ukuran desain</th>
                    <th scope="col">jumlah produk</th>
                    <th scope="col">Gambar Customer</th>
                    <th scope="col">total harga</th>
                    <th scope="col">nama customer</th>
                    <th scope="col">alamat pengiriman</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $no = 0;
                $query = mysqli_query($conn, "SELECT * FROM keranjang");
                while ($row = mysqli_fetch_array($query)) {
                    $no++;
                    $status = $row['status'];
                ?>
                    <!-- isi dalam tabel -->
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['id_produk']; ?></td>
                        <td><?php echo $row['nama_produk']; ?></td>
                        <td><?php echo $row['ukuran_produk']; ?></td>
                        <td><?php echo $row['jenis_cat']; ?></td>
                        <td><?php echo $row['ukuran_desain']; ?></td>
                        <td><?php echo $row['jumlah_produk']; ?></td>
                        <td><img src="../gambar/<?php echo $row['file_desain'] ?>" class="rounded rounded-3 w-100"></td>
                        <td><?php echo $row['total_harga']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['address']; ?></td>

                        <?php
                        if ($status >= 3) {
                            echo "<td><b>Pembayaran Sukses</b></span></td>";
                        } else if ($status >= 2) {
                            echo "<td><b>Pembayaran Pending</b></span></td>";
                        }else if ($status == -1) {
                            echo "<td><b>Pembayaran Gagal</b></span></td>";
                        } else {
                            echo "<td><b>Pembayaran Belum Dilakukan</b></span></td>";
                        } ?>

                        <td> <a href="hapusdatapesanan.php?id_keranjang=<?php echo $row['id_keranjang'] ?>" onclick="
                return confirm('Yakin Ingin menghapus data ini?')"><button class="btn btn-outline-danger">Hapus</button></a></td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>