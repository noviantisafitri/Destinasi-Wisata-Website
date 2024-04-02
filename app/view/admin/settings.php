<?php
session_start();
require '/xampp/htdocs/destinasi/app/model/users.php';

// Ambil data profil pengguna dari database
$profil = get_user_profile($_SESSION['user_id']);

// Update
if (isset($_POST['save_profil'])) {
    $user_id = $_SESSION['user_id'];
    $first_name = mysqli_real_escape_string($koneksi, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($koneksi, $_POST['last_name']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    $result_update = update_user_profile($user_id, $first_name, $last_name, $email, $password, $_FILES["foto"]);

    if ($result_update) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
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
        <div class="head-title">
				<div class="left">
					<h1>Profile</h1>
				</div>
			</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/destinasi/app/view/admin/settings.php" method="POST" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label>Nama depan</label>
                                        <input type="text" name="first_name" class="form-control" value="<?= $profil['first_name']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama belakang</label>
                                        <input type="text" name="last_name" class="form-control" value="<?= $profil['last_name']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="<?= $profil['email']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" value="<?= $profil['password']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <div>
                                            <img src="/destinasi/uploads/<?= $profil['foto']; ?>" alt="Gambar Profil" style="width: 25%; margin-top: 3px;">
                                            <div class="mb-3">
                                                <label>Upload Foto Profil</label>
                                                <input type="file" name="foto" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" name="save_profil" class="btn btn-primary">Save</button>
                                            </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="/destinasi/public/assets/js/sidebar.js"></script>
</body>

</html>