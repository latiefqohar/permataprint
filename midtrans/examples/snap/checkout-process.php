<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

session_start();
require_once dirname(__FILE__) . '/../../Midtrans.php';
require '../../../php/koneksi.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
//  //Prod
// Config::$serverKey = 'Mid-server-M6w5c1pfI0ygAbaf9OshrXkR';
// Config::$clientKey = 'Mid-client-7to7o1jrCgnOyvR0';

// sandbox
Config::$serverKey = 'SB-Mid-server-XTmZbyU0-QnbNf6DW4eQkygc';
Config::$clientKey = 'SB-Mid-client-GKTl_kc70VDdedfi';

// non-relevant function only used for demo/example purpose
// printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;
$id_keranjang = $_GET['id_keranjang'];

$query = "SELECT * FROM keranjang where id_keranjang= '" . $id_keranjang . "'";

$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_array($sql);
// var_dump($data['harga_produk']);die();
$username = $data["username"];
$upload_gambar = $data["upload_gambar"];
$nama_produk = $data["nama_produk"];
$ukuran_produk = $data["ukuran_produk"];
$jenis_cat = $data["jenis_cat"];
$ukuran_desain = $data["ukuran_desain"];
$harga_produk = $data["harga_produk"];
$jumlah_produk = $data["jumlah_produk"];
$file_desain = $data["file_desain"];
$deskripsi_desain = $data["deskripsi_desain"];
$total_harga = $data["total_harga"];
$email_pembeli = $data["email_pembeli"];

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
$transaction_details = array(
    'order_id' => $id_keranjang,
    'gross_amount' => $total_harga, // no decimal allowed for creditcard
);

// Optional
// $item1_details = array(
//     'id' => 'a1',
//     'price' => 10000,
//     'quantity' => $jumlah_produk,
//     'name' => $nama_produk
// );

// Optional
// $item2_details = array(
//     'id' => 'a2',
//     'price' => 20000,
//     'quantity' => 2,
//     'name' => "Orange"
// );

// Optional
// $item_details = array($item1_details);
// var_dump($item_details);
// die();

// Optional
// $billing_address = array(
//     'first_name'    => "Andri",
//     'last_name'     => "Litani",
//     'address'       => "Mangga 20",
//     'city'          => "Jakarta",
//     'postal_code'   => "16602",
//     'phone'         => "081122334455",
//     'country_code'  => 'IDN'
// );

// Optional
// $shipping_address = array(
//     'first_name'    => "Obet",
//     'last_name'     => "Supriadi",
//     'address'       => "Manggis 90",
//     'city'          => "Jakarta",
//     'postal_code'   => "16601",
//     'phone'         => "08113366345",
//     'country_code'  => 'IDN'
// );

// $query2 = "SELECT * FROM user where id='" . $_SESSION['id']['id']."'";
//     // $query = "SELECT * FROM destinasi where id_destinasi= '".$id_destinasi."'";

// $sql2 = mysqli_query($conn, $query2);
// $data2 = mysqli_fetch_array($sql2);

// // var_dump($namauser);
// // die();
// $name = $data2['cusname'];
// $address = $data2['alamat'];
// $email = $data2['email'];

// Optional
$customer_details = array(
    'first_name' => $username,
    'email'      => $email_pembeli,
    // 'billing_address'         => $address,
    // 'billing_address'  => $billing_address,
    // 'shipping_address' => $shipping_address
);

// Optional, remove this to display all available payment methods
// $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');

// Fill transaction details
$transaction = array(
    // 'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    // 'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
    // var_dump($snap_token);die();
} catch (\Exception $e) {
    echo $e->getMessage();
}


// echo "snapToken = ".$snap_token;

function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'Mid-server-M6w5c1pfI0ygAbaf9OshrXkR\';');
        die();
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
    <link rel="stylesheet" type="text/css" href="ilham.css">
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

    <!--content atas-->
    <div class="card-body" style="text-align: center;">
        <h2 style="margin-top:200px;">Ayo Bayar Sekarang</h2>

        <!-- <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->
        <div class="card-body">
            <!-- <p>Pesanan Berhasil Dibuat, Selesaikan Pembayaran Sekarang</p> -->
            <button id="pay-button" class="btn btn-success">PILIH METODE PEMBAYARAN</button>

            <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function() {
                    // SnapToken acquired from previous step
                    snap.pay('<?php echo $snap_token ?>?id_keranjang=<?= $id_keranjang ?>');
                };
            </script>

        </div>
        <!-- footer -->
        <div class="container-fluid" style="background-color: #242124; margin-top: 350px">
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
                    <h5>HUBUNGI KAMI</h3>
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
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
</body>

</html>




<!-- </div> -->