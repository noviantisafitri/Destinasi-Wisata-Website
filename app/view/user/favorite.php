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

<body>
    <?php include 'navbar.php'; ?>
    <section class="popular" id="destination">
        <div class="container">

            <p class="section-subtitle">Daftar Favorite</p>

            <h2 class="h2 section-title mb-5">Destinasi Wisata</h2>

            <!-- <p class="section-text">
                Temukan destinasi populer dan menarik yang tak boleh Anda lewatkan! Jelajahi tempat-tempat yang penuh pesona dan keunikan untuk menciptakan pengalaman tak terlupakan.
            </p> -->

            <ul class="popular-list">
                <?php
                $modal_count = 0;
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT d.*
                                FROM destinasi d
                                INNER JOIN favorites f ON d.id = f.destination_id
                                WHERE f.user_id = ?";
                    $stmt = mysqli_prepare($koneksi, $query);
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $modal_count++;
                            $destination_id = $row['id'];
                            $title = $row['title'];
                            $location = $row['location'];
                            $description = $row['description'];
                            $upload_path = $row['upload_path'];
                ?>
                            <li>
                                <div class="popular-card">
                                    <figure class="card-img">
                                        <img src="../../../uploads/<?= $upload_path ?>" alt="<?= $title ?>" loading="lazy">
                                    </figure>
                                    <div class="card-content">
                                        <div class="card-rating">
                                        <button type="button" class="btn-favorite" data-destination-id="<?= $row['id'] ?>"><i style="font-size: 24px; color: white;" class='bx bxs-bookmark'></i></button>
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
                            </li>
                <?php
                        }
                    } else {
                        // echo "Tidak ada daftar destinasi difavorite";
                    }
                } else {
                    // echo ("User tidak ditemukan");
                }
                ?>
            </ul>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const favoriteButtons = document.querySelectorAll('.btn-favorite');

            favoriteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const destinationId = this.getAttribute('data-destination-id');
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '../../model/delete_favorite.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            alert(xhr.responseText);
                            location.reload();
                        } else {
                            alert('Gagal menyimpan data favorit.');
                        }
                    };
                    xhr.send('destination_id=' + encodeURIComponent(destinationId));
                });
            });
        });
    </script>