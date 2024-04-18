<?php 



$hostname = 'sql210.infinityfree.com';

$username = 'if0_36364204';

$password = 'Destinasi21';

$database = 'if0_36364204_destinasi_website';



// Buat koneksi

$koneksi = mysqli_connect($hostname, $username, $password, $database);



// Cek koneksi

if ($koneksi == null) {

    die('Koneksi gagal:' . mysqli_connect_error());

}