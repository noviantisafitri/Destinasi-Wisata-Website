<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';
require '/xampp/htdocs/destinasi/app/model/users.php';

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
                                <h4>Tambah Destinasi Wisata
                                    <a href="/destinasi/app/view/admin/destinasi.php" class="btn btn-danger float-end">Kembali</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="/destinasi/app/model/destinasi_crud.php" method="POST" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Location</label>
                                        <input type="text" name="location" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <div class="mb-3">
                                            <textarea name="description" id="your_summernote" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Upload Gambar</label>
                                            <input type="file" name="upload_path" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" name="save_destinasi" class="btn btn-primary">Simpan</button>
                                        </div>

                                </form>
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
```````
</html>