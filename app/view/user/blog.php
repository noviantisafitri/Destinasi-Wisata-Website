<?php
require '../../config/database.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Pengguna') {
    header("Location: ../../view/login.php");
    exit();
}

// Query untuk mendapatkan data paket dari database
$query = "SELECT * FROM blogs";
$result = $koneksi->query($query);

?>

<section class="blog" id="blog" style="min-height: 100vh; padding: 10%;" >
    <div class="container">
    <p class="section-subtitle">Rekomendasi dan Tips Wisata</p>
<h2 class="h2 section-title">Blog</h2>
<p class="section-text">
    Jelajahi dunia wisata dengan lebih berkesan dengan tips-tips kami yang disesuaikan dan rekomendasi paket perjalanan yang menarik!
</p>

        <ul class="package-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <li>
                        <div class="package-card">
                            <figure class="card-banner">
                                <img src="../../../uploads/<?= $row['path_gambar'] ?>" alt="<?= $title ?>" loading="lazy" style="width: 100%; height: 100%">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title"><?php echo $row['title']; ?></h3>
                                <p class="card-text" style="font-size: 14px; width: 100%;"><?php
                                        $deskripsi = $row['dekripsi'];;
                                        echo strlen($deskripsi) > 250 ? substr($deskripsi, 0, 250) . '...' : $deskripsi;
                                        ?></p>
                                
                                <a href="isi_blog.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Baca</a>
                            <!-- <a href="/destinasi/app/view/user/isi_blog.php" class="btn btn-secondary">Baca</a> -->
                            </div>
                        </div>
                    </li>
                <?php
                }
            } else {
                echo "Tidak ada paket yang ditemukan.";
            }
            ?>
        </ul>
        <!-- <a href="#" class="btn btn-primary">Lihat Semua</a> -->
    </div>
</section>