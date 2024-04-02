<?php
require '/xampp/htdocs/destinasi/app/config/database.php';

// Periksa apakah ada input pencarian
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user_id = $_SESSION['user_id'];

    $query = "SELECT d.*
                FROM destinasi d
                INNER JOIN favorites f ON d.id = f.destination_id
                WHERE f.user_id = ? AND d.title LIKE ?";
    $stmt = mysqli_prepare($koneksi, $query);
    $searchParam = "%$search%";
    mysqli_stmt_bind_param($stmt, "is", $user_id, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
?>
        <!-- Sembunyikan konten yang ada di halaman -->
        <script>
            // Fungsi untuk menyembunyikan elemen
            function hideContent() {
                document.getElementById("destination").style.display = "none";
            }

            // Panggil fungsi ketika halaman dimuat
            window.onload = hideContent;
        </script>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $destination_id = $row['id'];
            $title = $row['title'];
            $location = $row['location'];
            $description = $row['description'];
            $upload_path = $row['upload_path'];
        ?>
            <div class="more-destination-container m-5">
                <a href="/destinasi/app/view/user/favorite.php" class="btn btn-primary">Kembali</a>
            </div>
            <ul id="content" class="popular-list m-5">
                <li>
                    <div class="popular-card">
                        <figure class="card-img">
                            <img src="/destinasi/uploads/<?= $upload_path ?>" alt="<?= $title ?>" loading="lazy">
                        </figure>
                        <div class="card-content">
                            <div class="card-rating">
                                <button type="button" class="btn-favorite" data-destination-id="<?= $destination_id ?>">Hapus Favorite</button>
                            </div>
                            <p class="card-subtitle">
                                <a href="#"><?= $location ?></a>
                            </p>
                            <h3 class="h3 card-title">
                                <a href="#"><?= $title ?></a>
                            </h3>
                            <p class="card-text">
                                <?= $description ?>
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        <?php
        }
    } else {
        ?>
        <script>
            // Fungsi untuk menyembunyikan elemen
            function hideContent() {
                document.getElementById("destination").style.display = "none";
            }

            // Panggil fungsi ketika halaman dimuat
            window.onload = hideContent;
        </script>
        <div class="more-destination-container m-5">
            <a href="/destinasi/app/view/user/favorite.php" class="btn btn-primary">Back</a>
        </div>
        <div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
            <h4>Destinasi Wisata tidak ditemukan</h4>
        </div>



<?php
    }
}
?>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <form class="d-flex" role="search" method="GET" action="">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" style="width: 18rem;">
                <button class="btn btn-outline-primary text-dark" type="submit">Search</button>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto" style="font-size: 16px;">
                    <a class="nav-link" aria-current="page" href="/destinasi/app/view/user/#home">Home</a>
                    <a class="nav-link" href="/destinasi/app/view/user/#destination">Destinasi</a>
                    <a class="nav-link" href="/destinasi/app/view/user/#gallery">Galeri</a>
                    <a class="nav-link" href="/destinasi/app/view/user/favorite.php">Favorite</a>
                    <div class="navbar-nav ms-auto" style="font-size: 18px;">
          <a class="nav-link btn text-primary" href="/destinasi/app/view/login.php"><?php echo "Halo, " . $_SESSION['first_name'] ?> <i style="font-size: 26px; float: inline-end; margin-left: 5px;" class='bx bx-log-out'></i></a>
        </div>
                </div>
            </div>
        </div>
    </nav>
</header>