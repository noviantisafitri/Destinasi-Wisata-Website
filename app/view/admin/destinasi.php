<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';
require '/xampp/htdocs/destinasi/app/model/users.php';

// Ambil data profil pengguna dari database
$profil = get_user_profile($_SESSION['user_id']);

$entries = isset($_GET['entries']) ? $_GET['entries'] : 5;
$query = "SELECT * FROM destinasi";
$query_run = mysqli_query($koneksi, $query);
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
                    <h1>Destinasi Wisata</h1>
                </div>
            </div>

            <div class="table-">
                <div class="order">
                    <div class="head">
                        <!-- <h3>Destinasi Wisata</h3> -->
                        <h3></h3>
                        <a href="/destinasi/app/view/admin/destinasi_create.php" class="add_destinasi btn btn-primary float-end mb-5">Add Destinasi</a>
                    </div>
                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Destinasi</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Waktu</th>
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
                                        $title = $row['title'];
                                        echo strlen($title) > 15 ? substr($title, 0, 15) . '...' : $title;
                                        ?>
                                    </td>
                                    <td><?php
                                        $location = $row['location'];
                                        echo strlen($location) > 15 ? substr($location, 0, 15) . '...' : $location;
                                        ?>
                                    </td>
                                    <td><?php
                                        $description = $row['description'];
                                        echo strlen($description) > 20 ? substr($description, 20, 20) . '...' : $description;
                                        ?>
                                    </td>
                                    <td><?php echo $row['date_created']; ?></td>
                                    <td class="tabel-button">
                                        <a href="/destinasi/app/view/admin/destinasi_view.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <!-- <a href="#view?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">View</a> -->

                                        <a href="/destinasi/app/view/admin/destinasi_edit.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <form action="/destinasi/app/model/destinasi_crud.php" method="POST" class="d-inline">
                                            <button type="submit" onclick="confirmDelete()" name="delete_destinasi" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
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
    <script src="/destinasi/public/assets/js/sidebar.js"></script>
    <script>
        function confirmDelete() {
            if (confirm("Apakah Anda yakin ingin menghapus destinasi ini?")) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</body>

</html>