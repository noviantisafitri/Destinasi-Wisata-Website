<?php
require '../config/database.php';

// Fungsi untuk mengatur cookies
function setLoginCookies($email, $password, $role)
{
    // Set cookies dengan masa aktif 30 hari
    setcookie("email", $email, time() + (86400 * 30));
    setcookie("password", $password, time() + (86400 * 30));
    setcookie("role", $role, time() + (86400 * 30));
}

// Jika tidak ada cookies login tersimpan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['foto'] = $row['foto'];

        // Jika checkbox dicentang, atur cookies
        if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == 'on') {
            setcookie("email", $email, time() + (86400 * 30), "/");
            setcookie("password", $password, time() + (86400 * 30), "/");
            setcookie("role", $role, time() + (86400 * 30), "/");
        }

        // Memeriksa role user
        if ($row['role'] == 'Admin') {
            header("Location: ../view/admin/dashboard.php");
            exit();
        } else if ($row['role'] == 'Pengguna') {
            header("Location: ../view/user/home.php");
            exit();
        } else if ($row['role'] == 'Superadmin'){
            header("Location: ../view/superadmin/dashboard.php");
            exit();
        }
    } else {
        echo "<script>alert('Email atau password salah. Silakan coba lagi.');</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }
}
