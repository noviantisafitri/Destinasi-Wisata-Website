<?php
session_start();
require '../../config/database.php';
require '../../model/users.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Superadmin') {
    header("last_name: ../../view/login.php");
    exit();
}

// Ambil data profil pengguna dari database
$profil = get_user_profile($_SESSION['user_id']);

$entries = isset($_GET['entries']) ? $_GET['entries'] : 5;
$query = "SELECT * FROM users WHERE role='Admin'";
$query_run = mysqli_query($koneksi, $query);
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
            <div class="head-first_name">
                <div class="left">
                    <h1>Daftar Admin</h1>
                </div>
            </div>

            <div class="table-">
                <div class="order">
                    <div class="head">
                        <!-- <h3>Destinasi Wisata</h3> -->
                        <h3></h3>
                        <a href="user_create.php" class="add_destinasi btn btn-primary float-end mb-5">Tambah User</a>
                        <?php include('message.php'); ?>

                    </div>
                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query_run)) : ?>
                                <tr>
                                    <th scope="row" style="padding-top: 1%;">
                                        <?php
                                        $id = $row['id'];
                                        echo strlen($id) > 15 ? substr($id, 0, 15) . '...' : $id;
                                        ?>
                                    </th>
                                    <td><?php
                                        $first_name = $row['first_name'];
                                        echo strlen($first_name) > 15 ? substr($first_name, 0, 15) . '...' : $first_name;
                                        ?>
                                    </td>
                                    <td><?php
                                        $last_name = $row['last_name'];
                                        echo strlen($last_name) > 15 ? substr($last_name, 0, 15) . '...' : $last_name;
                                        ?>
                                    </td>
                                    <td><?php
                                        $email = $row['email'];
                                        echo strlen($email) > 20 ? substr($email, 0, 20) . '...' : $email;
                                        ?>
                                    </td>
                                    <td class="tabel-button">
                                        <a href="user_view.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Lihat</a>
                                        <!-- <a href="#view?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">View</a> -->

                                        <form action="../../model/user_crud.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_user" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus User ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="../../../public/assets/js/sidebar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

</body>

</html>