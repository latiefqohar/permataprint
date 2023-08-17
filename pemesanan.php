<?php

session_start(); //agar dapat menggunakan setiap fungsi session disetiap halaman website
require 'functions.php'; //menyertakan file php lain ke dalam suatu program PHP

$id = $_GET["id_produk"]; //menampilkan data dari tabel yang ingin ditampilkan
$produk = query("SELECT * FROM masterproduk WHERE id_produk = $id")[0]; //menampilkan seluruh data baru tabel masterproduk dengan kriteria spesifik

$produk1 = query("SELECT * FROM keranjang");

$cusname = '';
$cusemail = '';
if (isset($_SESSION['cusname'])) { //untuk mengecek apakah session "cusname" sudah di registrasi //isset digunakan untuk dapat memeriksa apakah sebuah variabel telah di set.
  $cusname =  $_SESSION['cusname'];
}
if (isset($_SESSION['cusemail'])) { //untuk mengecek apakah session "cusemail" sudah di registrasi //isset digunakan untuk dapat memeriksa apakah sebuah variabel telah di set.
  $cusemail =  $_SESSION['cusemail'];
}
// $user= query("SELECT * FROM user WHERE id = $id")[0];

if (isset($_POST["tambah"])) { //post {untuk mengirimkan data atau nilai langsung ke action php yang ditampung, tanpa menampilkan url bar}

  if (tambah_keranjang($_POST) > 0) {
    echo "<script type = 'text/JavaScript'>
                alert('Data Berhasil Di Ubah');
                document.location.href = 'ranjang.php';
            </script>";
  } else {
    echo "<script type = 'text/JavaScript'>
                alert('Data Gagal Di Ubah');
                document.location.href = 'pemesanan.php';
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="pemesanan.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>Document</title>
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

  <!--form pemesanan-->
  <div class="container-fluid">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Produk</a></li>
    </ul>
    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <div class="container">
          <div class="row">
            <div class="col">
              <img class="rr" src="gambar/<?php echo $produk['upload_gambar'] ?>" width="800px" height="800px">
            </div>
            <div class="col">
              <form method="post" enctype="multipart/form-data">
                <fieldset>
                  <legend><?php echo $produk['nama_produk'] ?></legend>
                  <h4>Rp. <?php echo $produk["harga"] ?></h4>

                  <div class="mb-3 mbb">
                    <label for="ukuran_produk" class="form-label">Pilih Ukuran Produk:</label>
                    <select name="ukuran_produk" id="ukuran_produk" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option selected>Pilih Ukuran</option>
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                    </select>
                  </div>

                  <p class="text fw-bold">Jenis Pembelian</p>
                  <div class="input-group mb-3">
                       <input type="radio" id="tipe_satuan"  checked name="jenis_pembelian" value="Satuan">
                      <label for="laki-laki"> Satuan</label><br>

                      <input type="radio" id="tipe_grosir"  name="jenis_pembelian" value="Grosir">
                      <label for="perempuan"> Grosir</label><br>
                  </div>

                  <div id="qty_grosir" style="display:none;">
                  <p class="text fw-bold">Jumlah Pembelian Produk (Grosir):</p>
                  <div class="input-group mb-3">
                    <select name="jumlah_produk_grosir" class="form-control">
                      <option value="12">12 Pcs</option>
                      <option value="24">24 Pcs</option>
                      <option value="36">36 Pcs</option>
                      <option value="48">48 Pcs</option>
                      <option value="60">60 Pcs</option>
                      <option value="72">72 Pcs</option>
                    </select>
                  </div>
                  </div>

                  <div id="qty_satuan">
                  <p class="text fw-bold">Jumlah Pembelian Produk:</p>
                  <div class="input-group mb-3">
                    <input name="jumlah_produk" id="jumlah_produk" type="number" class="form-control" value="1" min="1" max="500">
                  </div>
                  </div>

                  <div class="mb-3 mbb">
                    <label for="jenis_cat" class="form-label">Pilih Jenis Cat:</label>
                    <select name="jenis_cat" id="jenis_cat" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option selected>Pilih Jenis Cat</option>
                      <option value="Rubber">Rubber</option>
                      <option value="Plastisol">Plastisol</option>
                    </select>
                  </div>


                  <div class="mb-3 mbb">
                    <label for="ukuran_desain" class="form-label">Pilih Ukuran desain:</label>
                    <select name="ukuran_desain" id="ukuran_desain" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option selected>Pilih ukuran desain</option>
                      <option value="1 - 3 warna + A6 (20 x 7 cm))">1 - 3 warna + A6 (20 x 7 cm)</option>
                      <option value="1 - 3 warna + A6 (14 x 10 cm))">1 - 3 warna + A6 (14 x 10 cm)</option>
                      <option value="1 - 3 warna + A5 (20 x 14 cm)">1 - 3 warna + A5 (20 x 14 cm)</option>
                      <option value="1 - 3 warna + A5 (28 x 10 cm)">1 - 3 warna + A5 (28 x 10 cm)</option>
                      <option value="1 - 3 warna + A4 (20 x 28 cm)">1 - 3 warna + A4 (20 x 28 cm)</option>
                      <option value="1 - 3 warna + A3 (28 x 40 cm)">1 - 3 warna + A3 (28 x 40 cm)</option>

                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="file_desain" class="form-label">Masukan File Desain: </label>
                    <input name="file_desain" id="file_desain" class="form-control"  type="file" id="foto" required>
                  </div>

                  <div class="mb-3">
                    <label for="deskripsi_desain" class="form-label">Berikan Deskripsi:</label>
                    <input name="deskripsi_desain" id="deskripsi_desain" type="text" name="nama_produk" placeholder="Masukan Deskripsi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <p class="dec" style="padding-top: 10px;">Berikan Deskripsi lebih detail mengenai warna yang terdapat di desain Anda ke Permata Print
                    </p>
                  </div>

                  <div class="mb-3">
                    <label for="address" class="form-label">Alamat Pengiriman:</label>
                    <input name="address" id="address" type="text" name="address" placeholder="Masukan address" class="form-control" id="exampleInputEmail1">
                    <p class="dec" style="padding-top: 10px;">
                    </p>
                  </div>

                  <input type="hidden" name="id_produk" id="id_produk" value="<?php echo $produk['id_produk'] ?>"></input>
                  <input type="hidden" name="username" id="username" value="<?php echo $cusname; ?>"></input>
                  <input type="hidden" name="email" id="email" value="<?php echo $cusemail; ?>"></input>
                  <input type="hidden" name="upload_gambar" id="upload_gambar" value="<?php echo $produk['upload_gambar'] ?>"></input>
                  <input type="hidden" name="nama_produk" id="nama_produk" value="<?php echo $produk['nama_produk'] ?>"></input>
                  <input type="hidden" name="harga_produk" id="harga_produk" value="<?php echo $produk['harga'] ?>"></input>

                  <button type="submit" class="btn btn-success" name="tambah" id="tambah">Tambah Ke Keranjang</button>

                  <div class="cat mb-3">
                    <p class="cat2"><?php echo $produk['deskripsi'] ?></p></br>
                    <p class="cat1"><b>Ukuran Desain :</b></p>
                    <p class="cat1"><img src="pic/area-cetak-print-dtg.jpg" width="400px" height="600px"></p>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!--upload dan gambar-->
      <div id="menu1" class="tab-pane fade">
        <form method="POST" enctype="multipart/form-data" class="pros">
          <div class="mb-3">
            <label for="formFile" class="form-label">Masukan File Gambar </label>
            <input class="form-control" name="foto" type="file" id="foto" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Berikan Deskripsi</label>
            <input type="text" name="nama_produk" placeholder="Masukan Deskripsi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <p class="">Berikan Deskripsi Gambar Anda ke Permata Print Seperti Warna Yang Terdapat Di Gambar, Cat Yang Ingin Digunakan, Posisi Gambar Yang Diinginkan</p>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
      </div>
      <div id="menu3" class="tab-pane fade">
        <h3>Menu 3</h3>
        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
      </div>
    </div>
  </div> -->
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
</body>

</html>

<script>
  const tipeGrosir = document.getElementById('tipe_grosir');
  const tipeSatuan = document.getElementById('tipe_satuan');
  const hargaGrosirDropdown = document.getElementById('qty_grosir');
  const hargaSatuanInput = document.getElementById('qty_satuan');

  tipeGrosir.addEventListener('change', function () {
      if (tipeGrosir.checked) {
          hargaGrosirDropdown.style.display = 'block';
          hargaSatuanInput.style.display = 'none';
      }
  });

  tipeSatuan.addEventListener('change', function () {
      if (tipeSatuan.checked) {
          hargaGrosirDropdown.style.display = 'none';
          hargaSatuanInput.style.display = 'block';
      }
  });
</script>
