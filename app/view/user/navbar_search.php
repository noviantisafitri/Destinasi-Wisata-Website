<?php
require '../../config/database.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Pengguna') {
  header("Location: ../../view/login.php");
  exit();
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user_id = $_SESSION['user_id'];

    $query = "SELECT d.* FROM destinasi d
    WHERE d.title LIKE ?";
    $stmt = mysqli_prepare($koneksi, $query);
    $searchParam = "%$search%";
    mysqli_stmt_bind_param($stmt, "s", $searchParam);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
?>
        <script>
            // Fungsi untuk menyembunyikan elemen
            function hideContent() {
                document.getElementById("destination").style.display = "none";
            }
            window.onload = hideContent;
        </script>
        <?php
        $modal_count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $modal_count++;
            $destination_id = $row['id'];
            $title = $row['title'];
            $location = $row['location'];
            $description = $row['description'];
            $upload_path = $row['upload_path'];
        ?>
            <div class="more-destination-container m-5 p-2">
                <!-- <a href="/destinasi/app/view/user/more_destinasi.php" class="btn btn-primary m-5">Kembali</a> -->
            </div>
            <ul id="content" class="popular-list">
                <li>
                <div class="popular-card">
              <figure class="card-img">
                <img src="../../../uploads/<?= $upload_path ?>" alt="<?= $title ?>" loading="lazy">
              </figure>
              <div class="card-content">
                <!-- Button favorite -->
                <div class="card-rating">
                  <button type="button" class="btn-favorite <?= $favorite_class ?>" data-destination-id="<?= $destination_id ?>">
                    <i style="font-size: 24px; color: white;" class="<?= $is_favorite ? 'bx bxs-bookmark' : 'bx bx-bookmark' ?>"></i>
                  </button>
                </div>
                <p class="card-subtitle"><a href="#"><?= $location ?></a></p>
                <h3 class="h3 card-title"><a href="#"><?= $title ?></a></h3>
                <p class="card-text" style="font-size: 12px;"><?= substr($description, 0, 150) ?> <?= strlen($description) > 150 ? '...' : '' ?></p>
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
                        <div class="modal-footer"></div>
                      </div>
                    </div>
                  </div>
                </div>
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

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="more-destination-container">
                <a href="#" onclick="history.back();" class="btn btn-primary">Kembali</a>

                    <!-- <a href="/destinasi/app/view/user/more_destinasi.php" class="btn btn-primary">Kembali</a> -->
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- <div class="navbar-nav ms-auto" style="font-size: 16px;">
                    <a class="nav-link" aria-current="page" href="/destinasi/app/view/user/#home">Home</a>
                    <a class="nav-link" href="/destinasi/app/view/user/#destination">Destinasi</a>
                    <a class="nav-link" href="/destinasi/app/view/user/#gallery">Galeri</a>
                    <a class="nav-link" href="/destinasi/app/view/user/favorite.php">Favorite</a> -->
                <div class="navbar-nav ms-auto" style="font-size: 18px;">
                    <form class="d-flex" role="search" method="GET" action="">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" style="width: 18rem;">
                        <button class="btn btn-outline-primary text-dark" type="submit">Search</button>
                    </form>
                    <!-- <a class="nav-link btn text-primary" href="/destinasi/app/view/login.php"><?php echo "Halo, " . $_SESSION['first_name'] ?> <i style="font-size: 26px; float: inline-end; margin-left: 5px;" class='bx bx-log-out'></i></a> -->
                </div>
            </div>
        </div>
        </div>
    </nav>
</header>