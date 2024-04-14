<?php
session_start();
require '../../config/database.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Pengguna') {
    header("Location: ../../view/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinasi Wisata Kaltim</title>

  <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- 
    - custom css link
  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../../../public/assets/css/home.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <?php include 'navbar.php'; ?>



  <main>
    <article>

      <!-- 
        - #HERO
      -->
      <?php include 'welcome.php'; ?>

      <!-- 
        - #POPULAR
      -->

      <?php include 'destinasi.php' ?>

      <!-- 
        - #BLOG
      -->

      <?php include 'blog.php' ?>

      <!-- 
        - #GALLERY
      -->

      <?php include 'galery.php' ?>

      <!-- 
        - #CONTACT
      -->

      <?php include 'contact.php' ?>

  <!-- 
    - custom js link
  -->
  <script src="../../../public/assets/js/user.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

      navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function() {
          // Menghapus class 'active' dari semua link navbar
          navLinks.forEach(function(link) {
            link.classList.remove('active');
          });

          // Menambahkan class 'active' ke link yang diklik
          this.classList.add('active');
        });
      });
    });
  </script>
</body>

</html>