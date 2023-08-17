<?php 

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

if ($_SESSION['username']) {
    session_unset();
    header("Location: loginadmin.php");
}
else if (_SESSION['cusname']){
    session_start();
}
