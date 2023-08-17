<?php

//menyertakan file php lain ke dalam suatu program PHP
include '../php/koneksi.php';

error_reporting(0);

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//untuk mengecek apakah session "username" sudah di set //isset digunakan untuk dapat memeriksa apakah sebuah variabel telah di set.
if (isset($_SESSION['username'])) {
    header("Location: dashboardadmin.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);;

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: dashboardadmin.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Administrator CV PERMATA PRINT</title>
</head>

<body>

    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error'] ?>
    </div>

    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="Email" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Anda belum punya akun? <a href="registeradmin.php">Register</a></p>
        </form>
    </div>



</body>

</html>