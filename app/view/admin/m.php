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
</body>

</html>