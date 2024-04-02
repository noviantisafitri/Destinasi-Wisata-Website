<?php
require '/xampp/htdocs/destinasi/app/config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        
        setcookie("email", $row['email'], time() + (86400 * 30), "/");
        setcookie("first_name", $row['first_name'], time() + (86400 * 30), "/");
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];

        // Memeriksa role user
        if ($row['role'] == 'Admin') {
            header("Location: /destinasi/app/view/admin/dashboard.php");
        } else {
            header("Location: /destinasi/app/view/user/home.php"); 
        }
        exit();
    } else {
        echo "Email atau password salah. Silakan coba lagi.";
    }
}
?>