<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';

// Mendapatkan id blog dari URL
$id_blog = $_GET['id'];

// Query untuk mendapatkan data blog berdasarkan id
$query = "SELECT * FROM blogs WHERE id = $id_blog";
$result = $koneksi->query($query);

// Periksa apakah data blog ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $deskripsi = $row['dekripsi'];
} else {
    // Jika blog tidak ditemukan, tampilkan pesan error
    echo "Blog tidak ditemukan.";
    exit(); // Menghentikan eksekusi script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Destinasi Wisata</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Core theme CSS (includes Bootstrap)-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="/destinasi/public/assets/css/blog.css" rel="stylesheet" />
    <link rel="stylesheet" href="/destinasi/public/assets/css/home.css">

</head>

<body>
    <!-- NAVBAR -->
    <?php include '/xampp/htdocs/destinasi/app/view/user/navbar.php'; ?>
    <!-- NAVBAR -->


    <!-- Page Header-->
    <header class="masthead" style="background-image: url('/destinasi/uploads/<?php echo $row['path_gambar']; ?>')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1><?php echo $title; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p><?php echo $deskripsi; ?></p>
                </div>
            </div>
        </div>
    </main>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="/destinasi/public/assets/js/blog.js"></script>
</body>

</html>