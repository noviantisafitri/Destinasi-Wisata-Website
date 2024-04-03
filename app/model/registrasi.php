<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($password)) {
        echo "<script>alert('Password tidak boleh kosong');</script>";
        echo "<script>window.history.back();</script>"; 
        exit(); 
    }
    
    if (strlen($password) < 8 || strlen($password) > 16) {
        echo "<script>alert('Password harus diantara 8 dan 16 karakter');</script>";
        echo "<script>window.history.back();</script>"; 
        exit(); 
    }

    if ($password !== $confirm_password) {
        echo "<script>alert('Password tidak sesuai');</script>";
        echo "<script>window.history.back();</script>"; 
        exit(); 
    }

    $check_query = "SELECT * FROM users WHERE email=?";
    $check_stmt = mysqli_prepare($koneksi, $check_query);
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email sudah digunakan, silahkan gunakan Email lain');</script>";
        echo "<script>window.history.back();</script>"; 
        exit(); 
    }

    $role = 'Pengguna';

    $query = "INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $email, $password, $role);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Registrasi berhasil, silahkan Login";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    } else {
        $_SESSION['message'] = "Registrasi Gagal";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}
?>
