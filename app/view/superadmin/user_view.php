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
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4>Lihat User
									<a href="user.php" class="btn btn-danger float-end">Kembali</a>
								</h4>
							</div>
							<div class="card-body">

								<?php
								if (isset($_GET['id'])) {
									$user_id = mysqli_real_escape_string($koneksi, $_GET['id']);
									$query = "SELECT * FROM users WHERE id='$user_id' ";
									$query_run = mysqli_query($koneksi, $query);

									if (mysqli_num_rows($query_run) > 0) {
										$user = mysqli_fetch_array($query_run);
								?>

										<div class="mb-3">
											<label>Fisrt Name</label>
											<p class="form-control">
												<?= $user['first_name']; ?>
											</p>
										</div>
										<div class="mb-3">
											<label>Last Name</label>
											<p class="form-control">
												<?= $user['last_name']; ?>
											</p>
										</div>
										<div class="mb-3">
											<label>Email</label>
											<p class="form-control">
												<?= $user['email']; ?>
											</p>
										</div>
										<div class="mb-3">
											<label>Password</label>
											<p class="form-control">
												<?= $user['password']; ?>
											</p>
										</div>

										<div class="mb-3">
											<label>Foto Profile</label>
											<br>
											<img src="../../../uploads/<?= $user['foto']; ?>" alt="Foto Profile" style="width: 25%; margin-top: 3px;">
										</div>

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
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="../../../public/assets/js/sidebar.js"></script>
</body>

</html>