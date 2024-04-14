<?php
require '../config/database.php';

session_start();

// Cek apakah ada cookies login tersimpan
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
  // Jika ada, coba login menggunakan informasi cookies
  $email = $_COOKIE['email'];
  $password = $_COOKIE['password'];

  $query = "SELECT * FROM users WHERE email=? AND password=?";
  $stmt = mysqli_prepare($koneksi, $query);
  mysqli_stmt_bind_param($stmt, "ss", $email, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  // kalau cookienya ada, set session
  if ($result && $row = mysqli_fetch_assoc($result)) {
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['last_name'] = $row['last_name'];
    $_SESSION['role'] = $row['role'];
  }
}

// cek session
// if (isset($_SESSION['role'])) {
//   if ($_SESSION['role'] == 'Admin') {
//     header("Location: ../view/admin/dashboard.php");
//     exit();
//   } else {
//     header("Location: ../view/user/home.php");
//     exit();
//   }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../../public/assets/css/login.css" />
  <title>Destinasi Wisata</title>
</head>

<body>
  <!-- Section: Design Block -->
  <section>
    <div class="wrapper">
      <form action="../model/login.php" method="POST">
        <h1>Login</h1>
        <div class="input-box">
          <label class="form-label" for="email">Email address</label>
          <input type="email" id="email" name="email" class="form-control" />
        </div>
        <div class="input-box mt-5">
          <label class="form-label" for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" />
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="remember-forgot mt-5">
          <label class="form-check-label" for="rememberMe">
          <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">Remember Me</label>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
          <p>Belum memiliki akun? <a href="registrasi.php">Register</a></p>
        </div>
      </form>
    </div>
  </section>
  <!-- Section: Design Block -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>