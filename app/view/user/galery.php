<section class="gallery" id="gallery" style="background-color: black;">
    <div class="container">

        <p class="section-subtitle">Galeri Foto</p>

        <h2 class="h2 section-title text-light">Fotografi Memukau <br> Destinasi Wisata KALTIM</h2>

        <p class="section-text text-light">
            Jelajahi keindahan alam dan budaya dari destinasi kami melalui koleksi foto-foto menakjubkan. Setiap gambar memperlihatkan keajaiban alam yang luar biasa dan keunikan budaya yang akan membuat Anda terpesona. 
        </p>

        <ul class="gallery-list">
            <?php
            $query = "SELECT * FROM destinasi";
            $result = mysqli_query($koneksi, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $loop_count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($loop_count >= 5) {
                        break;
                      }
                      $loop_count++;
                    $image_path = $row['upload_path'];
            ?>
                    <li class="gallery-item">
                        <figure class="gallery-image">
                            <img class="galery-img" src="../../../uploads/<?= $image_path ?>" alt="Gallery image">
                        </figure>
                    </li>
            <?php
                }
            } else {
                echo "<li>No images available.</li>";
            }
            ?>
        </ul>

    </div>
</section>