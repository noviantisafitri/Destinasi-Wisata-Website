<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Pengguna') {
    header("Location: /destinasi/app/view/login.php");
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
    <link rel="stylesheet" href="/destinasi/public/assets/css/home.css">

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php include '/xampp/htdocs/destinasi/app/view/user/navbar_search.php'; ?>
    <section class="pt-5" id="destination">
        <div class="more-destination-container mt-5 mx-5">
            <a href="/destinasi/app/view/user/#destination.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="container">

            <p class="section-subtitle">Telusuri Tempat</p>

            <h2 class="h2 section-title">Destinasi Populer</h2>

            <p class="section-text">
                Temukan destinasi populer dan menarik yang tak boleh Anda lewatkan! Jelajahi tempat-tempat yang penuh pesona dan keunikan untuk menciptakan pengalaman tak terlupakan.
            </p>

            <ul class="popular-list">
                <?php
                $modal_count = 0; 
                $query = "SELECT * FROM destinasi";
                $result = mysqli_query($koneksi, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $modal_count++; 
                        $title = $row['title'];
                        $location = $row['location'];
                        $description = $row['description'];
                        $upload_path = $row['upload_path'];
                ?>
                        <li>
                            <div class="popular-card">
                                <figure class="card-img">
                                    <img src="/destinasi/uploads/<?= $upload_path ?>" alt="<?= $title ?>" loading="lazy">
                                </figure>
                                <div class="card-content">
                                    <!-- Button favorite -->
                                    <div class="card-rating">
                                        <button type="button" class="btn-favorite" data-destination-id="<?= $row['id'] ?>"><i style="font-size: 24px; color: white;" class='bx bx-bookmark'></i></button>


                                        <!-- <button type="submit" name="save_favorite" class="btn-favorite">Favorite</button> -->
                                    </div>
                                    <p class="card-subtitle">
                                        <a href="#"><?= $location ?></a>
                                    </p>
                                    <h3 class="h3 card-title">
                                        <a href="#"><?= $title ?></a>
                                    </h3>
                                    <p class="card-text">
                                        <?= substr($description, 0, 50) ?> <?= strlen($description) > 50 ? '...' : '' ?>
                                    </p>

                                    <div class="btn-read" style="display: flex; justify-content: space-between; align-items: center; font-size: 16px;">

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $modal_count ?>">
                                            Read More
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $modal_count ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $modal_count ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel<?= $modal_count ?>"><?= $title ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="/destinasi/uploads/<?= $upload_path ?>" alt="<?= $title ?>" loading="lazy" style="width: 100%;">
                                                        <a href="#"><?= $location ?></a>
                                                        <?= $description ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </li>
                <?php
                    }
                } else {
                    echo "<li>No destination available.</li>";
                }
                ?>
            </ul>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>