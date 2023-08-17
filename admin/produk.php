<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require '../functions.php';


$produk = query("SELECT * FROM masterproduk ORDER BY id_produk DESC");
// if (isset($_POST["cari"])) {
//   $produk = cari($_POST["keyword"]);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="produk.css">
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
              <li><a class="dropdown-item" href="produksi1.php">Data Pesanan</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
    </div>

    <div class="d-float">
      <a href="tambahbaruadmin.php"><button class="btn btn-outline-primary mt-3 mb-3">Tambah
          Produk</button></a>
      <form class="d-flex" action="" method="post">
      </form>
    </div>
    <table class="table1">
      <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Ukuran</th>
        <th>Jumlah</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
      <?php $i = 1; ?>
      <?php foreach ($produk as $row) { ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td width="50px"><?php echo $row["kode"] ?></td>
          <td><?php echo $row["nama_produk"] ?></td>
          <td><?php echo $row["harga"] ?></td>
          <td><?php echo $row["ukuran"] ?></td>
          <td><?php echo $row["jumlah"] ?></td>
          <td><?php echo $row["deskripsi"] ?></td>
          <td> <img src="../gambar/<?php echo $row['upload_gambar'] ?>" width="150" height="130">

          </td>
          <td>
            <a href="edit_produk.php?id=<?php echo $row['id_produk'] ?>"><button class="btn btn-outline-success">Edit</button></a>

            <a href="hapus_produk.php?id=<?php echo $row['id_produk'] ?>" onclick="
              return confirm('Yakin Ingin menghapus data ini?')"><button class="btn btn-outline-danger">Hapus</button></a>
          </td>
        </tr>

        <?php $i++ ?>
      <?php } ?>
    </table>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>