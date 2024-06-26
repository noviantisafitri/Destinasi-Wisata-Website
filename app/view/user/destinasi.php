<?php
// session_start();
require '../../config/database.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Pengguna') {
  header("Location: ../../view/login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT d.*, f.destination_id AS favorite_destination_id
          FROM destinasi d
          LEFT JOIN favorites f ON d.id = f.destination_id AND f.user_id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result) {
?>
  <section class="popular" id="destination">
    <div class="container">
      <p class="section-subtitle">Telusuri Tempat</p>
      <h2 class="h2 section-title">Destinasi Populer di kaltim</h2>
      <p class="section-text">Temukan destinasi populer dan menarik yang tak boleh Anda lewatkan! Jelajahi tempat-tempat yang penuh pesona dan keunikan untuk menciptakan pengalaman tak terlupakan.</p>
      <ul class="popular-list">
        <?php
        $modal_count = 0;
        $loop_count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          if ($loop_count >= 3) {
            break;
          }
          $loop_count++;
          $modal_count++;

          $destination_id = $row['id'];
          $title = $row['title'];
          $location = $row['location'];
          $description = $row['description'];
          $upload_path = $row['upload_path'];
          $is_favorite = !empty($row['favorite_destination_id']);

          // Menyusun kelas CSS berdasarkan status favorit
          $favorite_class = $is_favorite ? 'favorite' : 'not-favorite';
        ?>
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
                <p class="card-text"><?= substr($description, 0, 150) ?> <?= strlen($description) > 150 ? '...' : '' ?></p>
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
                          <img src="../../../uploads/<?= $upload_path ?>" alt="<?= $title ?>" loading="lazy" style="width: 100%;">
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
        <?php
        }
        ?>
      </ul>
      <div class="more-destination-container" style="display: flex; justify-content: center; align-items: center;">
        <a href="more_destinasi.php" class="btn btn-primary">Lihat semua destinasi</a>
      </div>
    </div>
  </section>
<?php
} else {
  echo "<li>No destination available.</li>";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const favoriteButtons = document.querySelectorAll('.btn-favorite');
    favoriteButtons.forEach(button => {
      button.addEventListener('click', function() {
        const destinationId = this.getAttribute('data-destination-id');
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../../model/favorite.php');
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