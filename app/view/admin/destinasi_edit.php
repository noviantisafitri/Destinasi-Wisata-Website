<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';
require '/xampp/htdocs/destinasi/app/model/users.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /destinasi/app/view/login.php");
    exit();
}

// Ambil data profil pengguna dari database
$profil = get_user_profile($_SESSION['user_id']);
?>

<?php include '/xampp/htdocs/destinasi/app/view/admin/inc/head.php'; ?>

<body>
    <!-- SIDEBAR -->
    <?php include '/xampp/htdocs/destinasi/app/view/admin/inc/sidebar.php'; ?>

    <!-- CONTENT -->
    <section id="content">
        <?php include '/xampp/htdocs/destinasi/app/view/admin/inc/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <div class="container">

                <?php include('/xampp/htdocs/destinasi/app/view/admin/message.php'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Destinasi Wisata
                                    <a href="/destinasi/app/view/admin/destinasi.php" class="btn btn-danger float-end">Kembali</a>
                                </h4>
                            </div>
                            <div class="card-body">

                                <?php
                                if (isset($_GET['id'])) {
                                    $destinasi_id = mysqli_real_escape_string($koneksi, $_GET['id']);
                                    $query = "SELECT * FROM destinasi WHERE id='$destinasi_id' ";
                                    $query_run = mysqli_query($koneksi, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        $destinasi = mysqli_fetch_array($query_run);
                                ?>
                                        <form action="/destinasi/app/model/destinasi_crud.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="destinasi_id" value="<?= $destinasi['id']; ?>">

                                            <div class="mb-3">
                                                <label>Title</label>
                                                <input type="text" name="title" value="<?= $destinasi['title']; ?>" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Location</label>
                                                <input type="text" name="location" value="<?= $destinasi['location']; ?>" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Description</label>

                                                <textarea name="description" id="your_summernote" rows="4" class="form-control"><?= $destinasi['description']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label>Upload Gambar</label>
                                                <br>
                                                <img src="/destinasi/uploads/<?= $destinasi['upload_path']; ?>" alt="Gambar Destinasi" style="width: 25%; margin-top: 5px; margin-bottom: 5px;">
                                                <input type="file" name="upload_path" class="form-control">

                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" name="update_destinasi" class="btn btn-primary">
                                                    Ubah
                                                </button>
                                            </div>

                                        </form>
                                <?php
                                    } else {
                                        echo "<h4>No Such Id Found</h4>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Summernote JS - CDN Link -->
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

            <script>
                $(document).ready(function() {
                    $("#your_summernote").summernote();
                    $('.dropdown-toggle').dropdown();
                });
            </script>
            <!-- //Summernote JS - CDN Link -->
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="/destinasi/public/assets/js/sidebar.js"></script>
</body>

</html>