<?php
session_start();
require '../../config/database.php';
require '../../model/users.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Superadmin') {
    header("Location: ../../view/login.php");
    exit();
}

// Ambil data profil pengguna dari database
$profil = get_user_profile($_SESSION['user_id']);
?>

<?php include '../superadmin/inc/head.php'; ?>

<body>
    <!-- SIDEBAR -->
    <?php include '../superadmin/inc/sidebar.php'; ?>

    <!-- CONTENT -->
    <section id="content">
        <?php include '../superadmin/inc/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <div class="container">
                <?php include('message.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah User
                                    <a href="user.php" class="btn btn-danger float-end">Kembali</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="../../model/user_crud.php" method="POST" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                    
                                        <div class="mb-3">
                                            <label>Upload Foto</label>
                                            <input type="file" name="foto" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" name="save_user" class="btn btn-primary">Simpan</button>
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
            <!-- //Summernote JS - CDN Link -->
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="../../../public/assets/js/sidebar.js"></script>
</body>
```````
</html>