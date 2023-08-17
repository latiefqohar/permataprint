<?php

//agar dapat menggunakan setiap fungsi session disetiap halaman website
session_start();

//menghapus semua yang disimpan di session saat ini.
session_destroy();

header("Location: index.php");
