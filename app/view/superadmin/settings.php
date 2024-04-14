<?php
session_start();
require '../../config/database.php';
require '../../model/users.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Superadmin') {
    header("Location: ../../view/login.php");
    exit();
}

$profil = get_user_profile($_SESSION['user_id'], $koneksi);

// Update
if (isset($_POST['save_profil'])) {
    $user_id = $_SESSION['user_id'];
    $first_name = mysqli_real_escape_string($koneksi, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($koneksi, $_POST['last_name']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $foto = '';

    // Jika pengguna mengunggah gambar baru
    if ($_FILES["foto"]["name"]) {
        // File upload
        $target_dir = "../../../uploads/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file gambar
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['message'] = "File tersebut bukan gambar";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        if (file_exists($target_file)) {
            $_SESSION['message'] = "Gambar sudah ada";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        // Ukuran gambar
        if ($_FILES["foto"]["size"] > 5000000) {
            $_SESSION['message'] = "Ukuran gambar terlalu besar";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        // Format gambar
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            $_SESSION['message'] = "Hanya untuk format JPG, JPEG, PNG & GIF yang diizinkan";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        if ($uploadOk == 0) {
            $_SESSION['message'] = "File tidak terupload";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(0);
        }

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $_SESSION['message'] = "File " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " berhasil diupload";
            $foto = basename($_FILES["foto"]["name"]);
        } else {
            $_SESSION['message'] = "Error dalam mengupload gambar: " . $_FILES["foto"]["error"];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(0);
        }
    } else {
        // Jika tidak ada file yang diunggah, tetapkan nilai foto dari data sebelumnya
        $query_get_foto = "SELECT foto FROM users WHERE id='$user_id'";
        $query_run_get_foto = mysqli_query($koneksi, $query_get_foto);
        $row_foto = mysqli_fetch_assoc($query_run_get_foto);
        $foto = $row_foto['foto'];
    }

    $query = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', password='$password', foto='$foto' WHERE id='$user_id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        $_SESSION['message'] = "Profil berhasil diubah";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    } else {
        $_SESSION['message'] = "Profil gagal diubah";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}

?>

<?php include '../../view/superadmin/inc/head.php'; ?>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <P class="m-2"><?= $_SESSION['role']; ?></P>
            <span class="text"></span>
        </a>
        <ul class="side-menu top" style="padding: 0px;">
            <li>
                <a href="dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="settings.php">
                    <i class='bx bxs-user'></i>

                    <span class="text">Profile</span>
                </a>
            </li>
            <li>
                <a href="user.php">
                    <i class='bx bxs-folder'></i>
                    <span class="text">Users</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu bottom" style="padding: 0px;">
            <li class="">
                <a href="../../model/logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <?php include '../../view/superadmin/inc/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Profile</h1>
                </div>
            </div>
            <div class="container">
                <?php include('message.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="settings.php" method="POST" enctype="multipart/form-data">

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
                                            <img src="../../../uploads/<?= $profil['foto']; ?>" alt="Gambar Profil" style="width: 25%; margin-top: 3px;">
                                            <div class="mb-3">
                                                <label>Upload Foto Profil</label>
                                                <input type="file" name="foto" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" name="save_profil" class="btn btn-primary">Simpan</button>
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
    <script src="../../../public/assets/js/sidebar.js"></script>
</body>

</html>