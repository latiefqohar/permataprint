<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menyertakan file php lain ke dalam suatu program PHP
require 'functions.php';

$total_belanja = 0;

if (isset($_SESSION["cusname"])) {
  $id_pelanggan =  $_SESSION["cusname"];
  $produk = mysqli_query($conn, "SELECT * FROM Keranjang LEFT JOIN masterproduk USING(id_produk) WHERE username = '$id_pelanggan' && STATUS='1' ORDER BY id_keranjang DESC");

  $jumlah = mysqli_query($conn, "SELECT COUNT(*)  FROM keranjang WHERE username = '$id_pelanggan' ");
  $jumlahproduk = mysqli_fetch_array($jumlah)[0];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="basket.css">
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


  <div class="container" style="padding-bottom: 200px;">
    <h2 style="color: #16DF7E"><b>Checkout</b></h2>
    <div class="row">
      <div class="col-md-6">
        <h4>Daftar Pesanan</h4>
        <table class="table table-stripped">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Sub Total</th>
            <th>Diskon</th>
            <th>Alamat Pengiriman</th>
            <th>Status</th>

          </tr>
          <?php
          $no = 0;
          $hasil = 0;
          while ($row = mysqli_fetch_assoc($produk)) {
            $no++;
            $status = $row['status'];
            //   var_dump($status);
            //   die();

          ?>



            <tr>
              <td><?= $no; ?></td>
              <td><?php echo $row['nama_produk'] ?></td>
              <td><?php echo $row['harga_produk'] ?></td>
              <td><?php echo $row['jumlah_produk'] ?></td>
              <td><?php echo ($row['jumlah_produk'] * $row['harga_produk']) ?></td>
              <td><?php echo $row['potongan'] ?></td>
              <td><?php echo $row['address'] ?></td>

              <?php if ($status >= 3) {
                echo "<td><b>Pembayaran Sukses</b></span></td>";
              } else if ($status >= 2) {
                echo "<td><b>Pembayaran Pending</b></span></td>";
              } else if ($status = 1) {
                echo "<td><b>Pembayaran Belum Dilakukan</b></span></td>";
              }
              ?>
            </tr>
            </tr>


          <?php
            //error_reporting(0);

            $harga = $row["harga_produk"];
            $jumlah = $row["jumlah_produk"];
            $total_harga = ($harga * $jumlah)-$row["potongan"];
            //+= (pengisian nilai dan penambahan nilai)
            $total_belanja += $total_harga;
          } ?>
          <tr>

            <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = <?php echo $total_belanja; ?></td>
          </tr>
        </table>
      </div>
      <!-- <?php
            // var_dump($caridestinasi['id_transaksi'];);
            // die(); 
            ?>
      <a id="pay-button" href="transaksi.php?id_keranjang=<?php echo $row['id_keranjang']; ?>" type="button" class="btn btn-primary">Bayar</a> -->
    </div>

    <?php

    $no = 0;
    $id_keranjang = $_GET["id_keranjang"];
    // var_dump($id_transaksi);
    // die();
    // $query = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE id_user='" . $_SESSION['user_id']['id_user'] . "';");
    $query = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_keranjang='$id_keranjang' ");

    while ($row = mysqli_fetch_assoc($query)) {
    ?>

      <?php
      // var_dump($caridestinasi['id_transaksi'];);
      // die(); 
      ?>
      <a id="pay-button" href="transaksi.php?id_keranjang=<?php echo $row['id_keranjang']; ?>" type="button" class="btn btn-success">Bayar</a>
  </div>
  </div>
  </div>
<?php } ?>


</div>

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
      <h3>LAYANAN KAMI</h3>
      <p><i class="bi bi-arrow-right-short"></i> Jual Baju Custom</p>
      <p><i class="bi bi-arrow-right-short"></i> Jasa Sablon Kaos</p>
    </div>
    <div class="col-3" style="color:white; margin-top:50px;">
      <h3>HUBUNGI KAMI</h3>
      <p><i class="bi bi-telephone-fill"></i> +62-857-8017-8107</p>
    </div>
    <div class="col-2" style="color:white; margin-top:50px;">
      <h3>ALAMAT</h3>
      <p><i class="bi bi-geo-alt-fill"></i> Jl. Pasir Awi, RT.003/RW.002, Sukaasih, Kec. Ps. Kemis, Kabupaten Tangerang, Banten 15560</p>
      <p><i class="bi bi-geo-alt-fill"></i> -6.184947, 106.534759</p>
    </div>
  </div>
</div>
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