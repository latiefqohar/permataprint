<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "root", "permataprint")
    or die('gagal terkoneksi ke database');

//query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// registrasi
function registrasi($data)
{
    global $conn;

    $nama = strtolower(stripslashes($data["nama"]));
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    //cek username sudah terdaftar/belum
    $result = mysqli_query($conn, "SELECT username FROM user_admin WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert ('Username sudah terdaftar,Silahkan ganti username ...!');
            </script>";
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan data ke database
    mysqli_query($conn, "INSERT INTO user_admin VALUES ('', '$nama', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

// // registrasi user
// function registrasi($data) {
//     global $conn;

//     $nama = strtolower(stripslashes($data ["nama"] ) );
//     $username = strtolower( stripslashes($data ["username"] ) );
//     $email = strtolower( stripslashes($data ["email"] ) );
//     $ponsel = strtolower( stripslashes($data ["ponsel"] ) );
//     $alamat = strtolower( stripslashes($data ["alamat"] ) );
//     $password = mysqli_real_escape_string( $conn, $data ["password"] );
//     $password2 = mysqli_real_escape_string( $conn, $data ["password2"] );

//     //cek konfirmasi password
//     if ( $password !== $password2 ) {
//         echo "<script>
//                 alert('Konfirmasi password tidak sesuai');
//             </script>";
//         return false;
//     }

//     //cek username sudah terdaftar/belum
//     $result = mysqli_query( $conn, "SELECT username FROM user WHERE username = '$username'");
//     if ( mysqli_fetch_assoc($result) ) {
//         echo "<script>
//                 alert ('Username sudah terdaftar,Silahkan ganti username ...!');
//             </script>";
//     return false;
//     }

//     //enskripsi password
//     $password = password_hash($password , PASSWORD_DEFAULT);

//     //tambahkan data ke database
//     mysqli_query($conn, "INSERT INTO user VALUES ('', '$nama', '$username', '$email', '$ponsel', '$alamat', '$password')");
//     return mysqli_affected_rows($conn);

// }


// registrasi
function Daftar($data)
{
    global $conn;

    $nama = strtolower(stripslashes($data["nama"]));
    $cusname = strtolower(stripslashes($data["cusname"]));
    $email = strtolower(stripslashes($data["email"]));
    $ponsel = strtolower(stripslashes($data["ponsel"]));
    $alamat = strtolower(stripslashes($data["alamat"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    //cek username sudah terdaftar/belum
    $result = mysqli_query($conn, "SELECT cusname FROM user WHERE cusname = '$cusname'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert ('Username sudah terdaftar,Silahkan ganti username ...!');
            </script>";
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan data ke database
    mysqli_query($conn, "INSERT INTO user VALUES ('', '$nama', '$cusname','$email', '$ponsel', '$alamat', '$password')");
    return mysqli_affected_rows($conn);
}

function lengakapi_data($data)
{
    global $conn;

    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $umur = htmlspecialchars($data["umur"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $notelp = htmlspecialchars($data["notelp"]);

    mysqli_query($conn, "INSERT INTO detail_pelanggan VALUES (
    '$id_pelanggan', '$umur', '$jenis_kelamin','$alamat','$notelp')");
}
function tambah_produk($data)
{
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $kode = htmlspecialchars($data["kode"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    //upload foto 
    $rand = rand();
    $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
    $filename = $_FILES['foto']['name'];
    $ukuran_foto = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        header("location:tambahbaruadmin.php?alert=gagal_ekstensi");
    } else {
        if ($ukuran_foto < 1044070) {
            $xx = $rand . '_' . $filename;
            move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/' . $rand . '_' . $filename);
            //  mysqli_query($koneksi, "INSERT INTO masterproduk VALUES(NULL,'$nama','$kontak','$alamat','$xx')");
            header("location:produk.php?alert=berhasil");
        } else {
            header("location:tambahbaruadmin.php?alert=gagak_ukuran");
        }
    }

    //masukan data 
    $query = "INSERT INTO masterproduk VALUES (
            '', '$kode', '$nama_produk', '$harga',
                '$ukuran', '$jumlah', '$deskripsi', '$xx')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload_foto()
{
    $namafile = $_FILES['foto']['name'];
    $sizefile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmp_name = $_FILES['foto']['tmp_name'];

    //cek ada/tidak
    if ($error === 4) {
        echo "<script>
                alert('Anda Belum Meng-Upload File');
            </script>";
        return false;
    }

    //cek jenis file 
    $ekstensifileValid = ['jpg', 'jpeg', 'png'];
    $ekstensifile = explode('.', $namafile);
    $ekstensifile = strtolower(end($ekstensifile));
    if (!in_array($ekstensifile, $ekstensifileValid)) {
        echo "<script>
                alert('Format File yang anda upload tidak sesuai ');
            </script>";
        return false;
    }

    //cek ukuran file 
    $maxsize = 10000000;
    if ($sizefile > $maxsize) {
        echo "<script>
                alert('Ukuran File yang Anda upload terlalu besar');
            </script>";
        return false;
    }

    //generate nama file 
    $namafilebaru = uniqid();
    $namafilebaru .= ".";
    $namafilebaru .= $ekstensifile;
    move_uploaded_file($tmp_name, 'img/' . $namafilebaru);

    return $namafilebaru;
}
function edit_produk($data)
{
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $kode = htmlspecialchars($data["kode"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $jumlah = htmlspecialchars($data["jumlah"]);

    // if($_FILES["foto"]["error"] === 4) {
    //     $foto = $fotolama;
    // } else {
    //     $foto = upload_foto();
    // }

    $rand = rand();
    $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
    $filename = $_FILES['foto']['name'];
    $ukuran_foto = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        header("location:tambahbaruadmin.php?alert=gagal_ekstensi");
    } else {
        if ($ukuran_foto < 1044070) {
            $xx = $rand . '_' . $filename;
            move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/' . $rand . '_' . $filename);
            //  mysqli_query($koneksi, "INSERT INTO masterproduk VALUES(NULL,'$nama','$kontak','$alamat','$xx')");
            header("location:produk.php?alert=berhasil");
        } else {
            header("location:tambahbaruadmin.php?alert=gagak_ukuran");
        }
    }

    // update data 
    $query = "UPDATE masterproduk SET 
            kode = '$kode',
            nama_produk = '$nama_produk',
            harga = '$harga',
            ukuran= '$ukuran',
            jumlah = '$jumlah',
            upload_gambar = '$xx'
            WHERE id_produk = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_keranjang($id)
{
    global $conn;


    $produk = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_keranjang = '$id'");
    $row = mysqli_fetch_assoc($produk);


    //hapus foto dari folder
    // $path = "img/". $row["gambar"];

    // if(file_exists($path)){
    //     unlink($path);
    // }

    // hapus data dari database
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id'");
    return mysqli_affected_rows($conn);
}

function hapus_produk($id)
{
    global $conn;


    $produk = mysqli_query($conn, "SELECT * FROM masterproduk WHERE id_produk = '$id'");
    $row = mysqli_fetch_assoc($produk);


    //hapus foto dari folder
    // $path = "img/". $row["gambar"];

    // if(file_exists($path)){
    //     unlink($path);
    // }

    // hapus data dari database
    mysqli_query($conn, "DELETE FROM masterproduk WHERE id_produk = '$id'");
    return mysqli_affected_rows($conn);
}

//untuk user yang tidak login
function tambah_keranjang2($data)
{
    global $conn;

    $id_pelanggan = $data["id_pelanggan"];
    $id_produk = $data["id_produk"];

    mysqli_query($conn, "INSERT INTO keranjang2 VALUES('','$id_pelanggan','$id_produk')");
    return mysqli_affected_rows($conn);
}

//untuk user login
function tambah_keranjang($data)
{
    global $conn;

    $id_produk = htmlspecialchars($data["id_produk"]);
    $username = htmlspecialchars($data["username"]);
    $upload_gambar = htmlspecialchars($data["upload_gambar"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);
    $ukuran_produk = htmlspecialchars($data["ukuran_produk"]);
    $jumlah_produk = htmlspecialchars($data["jumlah_produk"]);
    $jumlah_produk_grosir = htmlspecialchars($data["jumlah_produk_grosir"]);
    $jenis_cat = htmlspecialchars($data["jenis_cat"]);
    $ukuran_desain = htmlspecialchars($data["ukuran_desain"]);
    // $file_desain = htmlspecialchars($data["file_desain"]);
    $deskripsi_desain = htmlspecialchars($data["deskripsi_desain"]);
    // $status = htmlspecialchars($data["status"]);
    $address = htmlspecialchars($data["address"]);
    $jenis_pembelian = htmlspecialchars($data["jenis_pembelian"]);
    $email_pembeli = htmlspecialchars($data["email"]);
 
    if ($jenis_pembelian== "Grosir") {
        $potongan = ($jumlah_produk_grosir/12)*10000;
        $harga_asli = $harga_produk * $jumlah_produk_grosir;
        $total_harga =  $harga_asli-$potongan;
        $jumlah_produk = $jumlah_produk_grosir;
    }else {
        $potongan = 0;
        $total_harga =  ($harga_produk * $jumlah_produk);
    }

     //upload foto 
     $rand = rand();
     $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
     $filename = $_FILES['file_desain']['name'];
     $ukuran_foto = $_FILES['file_desain']['size'];
     $ext = pathinfo($filename, PATHINFO_EXTENSION);
     $xx = "";
     if (!in_array($ext, $ekstensi)) {
        echo "extenssi tidak mendukung"; die();
     } else {
         if ($ukuran_foto < 10044070) {
             $xx = $rand . '_' . $filename;
             move_uploaded_file($_FILES['file_desain']['tmp_name'], 'gambar/' . $xx);
           
         } else {
            echo "Gagal upload"; die();
         }
     }
  
   
  
    mysqli_query(
        $conn,
        "INSERT INTO keranjang VALUES(
        '',
        '$id_produk',
        '$username',
        '$upload_gambar',
        '$nama_produk',
        '$ukuran_produk',
        '$jenis_cat',
        '$ukuran_desain',
        '$harga_produk',
        '$jumlah_produk',
        '$xx',
        '$deskripsi_desain',
        '1',
        '$address',
        '$total_harga',
        '$jenis_pembelian',
        '$potongan',
        '$email_pembeli')"
    );

    return mysqli_affected_rows($conn);
}

//untuk user login
// function tambah_validasi($data)
// {
//     global $conn;

//     $validasi = htmlspecialchars($data["validasi"]);

//     mysqli_query(
//         $conn,
//         "INSERT INTO validasi VALUES(
//         '',
//         '$validasi')"
//     );
//     return mysqli_affected_rows($conn);
// }

// riwayat
function riwayat()
{
    global $conn;

    $id = $_SESSION["id"];

    $produk = query("SELECT * FROM keranjang WHERE id_pelangan = $id");
    $jumlah = mysqli_query($conn, "SELECT COUNT(*) FROM keranjang WHERE id_pelangan = $id ");
    foreach ($produk as $key => $value) {
        $id_pelangan = $value["id_pelangan"];
        $id_produk = $value["id_produk"];
        $nama = $value["nama_pembeli"];
        $notelp = $value["no_telp"];
        $jumlah = $value["jumlah"];
        $ukuran = $value["ukuran"];
        $alamat = $value["Alamat"];
        $catatan = $value['catatan'];
        $total_harga = $value["total_harga"];
        $sql = "INSERT INTO riwayat (`id_riwayat`,`id_pelangan`, `id_produk`, `nama_pembeli`, `no_telp`, `jumlah`, `ukuran`, `Alamat`, `catatan`, `total_harga`) 
        VALUES (NULL,'$id_pelangan', '$id_produk', '$nama', '$notelp', '$jumlah', '$ukuran', '$alamat', '$catatan', '$total_harga');";

        $res = mysqli_query($conn, $sql);
    }
    return mysqli_affected_rows($conn);
}

function hapusdatapesanan($id)
{
    global $conn;


    $produk = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_keranjang = '$id'");
    $row = mysqli_fetch_assoc($produk);


    //hapus foto dari folder
    // $path = "img/". $row["gambar"];

    // if(file_exists($path)){
    //     unlink($path);
    // }

    // hapus data dari database
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id'");
    return mysqli_affected_rows($conn);
}
function tambah_ukuran($data)
{
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $jeniscat = htmlspecialchars($data["jeniscat"]);
    $ukurands = htmlspecialchars($data["ukurands"]);
    $hargads = htmlspecialchars($data["hargads"]);

    //masukan data 
    $query = "INSERT INTO ukuranharga VALUES (
            '', '$jeniscat','$ukurands',  '$hargads')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
