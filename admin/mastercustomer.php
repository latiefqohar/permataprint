<?php

//menyertakan file php lain ke dalam suatu program PHP
include '../functions.php';

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: loginadmin.php");
}

if (isset($_GET['page'])) {
  $kode = $_GET['kode'];
  $result = mysqli_query($conn, "DELETE FROM user WHERE id = '$kode'");

  if ($result) {
    echo "
		<script>
		alert('DATA BERHASIL DIHAPUS');
		window.location = 'mastercustomer.php';
		</script>
		";
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
  <link rel="stylesheet" type="text/css" href="admin2.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
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
            <a class="nav-link dropdown-toggle" href="produk.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Master
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="produk.php">Data Produk</a></li>
              <li><a class="dropdown-item" href="mastercustomer.php">Data Customer</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="produksi1.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

  <div class="container">
    <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Data Customer</b></h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Ponsel</th>
          <th scope="col">Alamat</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM user order by id asc");
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>

            <th scope="row"><?php echo $no; ?></th>
            <td><?= $row['nama'];  ?></td>
            <td><?= $row['email'];  ?></td>
            <td><?= $row['ponsel'];  ?></td>
            <td><?= $row['alamat'];  ?></td>
            <td><a href="mastercustomer.php?kode=<?php echo $row['id']; ?>&page=del" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="bi bi-trash3"></i></a></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

  </div>
  <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
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