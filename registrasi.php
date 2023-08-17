<?php

//menyertakan file php lain ke dalam suatu program PHP
include 'php/koneksi.php';

error_reporting(0);

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

if (isset($_SESSION['cusname'])) {
  header("Location: index.php");
}

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $cusname = $_POST['cusname'];
  $email = $_POST['email'];
  $ponsel = $_POST['ponsel'];
  $alamat = $_POST['alamat'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);

  if ($password == $cpassword) {
    $sql = "SELECT * FROM user WHERE email='$email' AND cusname='$cusname'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO user (nama, cusname, email, ponsel, alamat, password)
                    VALUES ('$nama', '$cusname', '$email', '$ponsel', '$alamat', '$password')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo "<script>alert('Selamat, registrasi berhasil!')</script>";
        $nama = "";
        $cusname = "";
        $email = "";
        $ponsel = "";
        $alamat = "";
        $_POST['password'] = "";
        $_POST['cpassword'] = "";
      } else {
        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
      }
    } else {
      echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
    }
  } else {
    echo "<script>alert('Password Tidak Sesuai')</script>";
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
  <link rel="stylesheet" type="text/css" href="registrasi.css">
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

  <div class="container registrasi">
    <h3 class="new">Pendaftaran Akun Baru</h3>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama</label>
        <input type="text" placeholder="Nama Lengkap" name="nama" value="<?php echo $nama; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Username</label>
        <input type="text" placeholder="Username" name="cusname" value="<?php echo $cusname; ?>" required class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Telepon</label>
        <input type="text" placeholder="Telepon" name="ponsel" value="<?php echo $ponsel; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Alamat</label>
        <input type="text" placeholder="Alamat" name="alamat" value="<?php echo $alamat; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Password</label>
        <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
        <input type="password" placeholder="Konfirmasi Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <button name="submit" class="btn btn-primary" href="login.php">Register</button>
    </form>
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