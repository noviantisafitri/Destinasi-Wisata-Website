<?php
session_start();
require '../../config/database.php';
require '../../model/users.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../../view/login.php");
    exit();
}

// Ambil data profil pengguna dari database
$profil = get_user_profile($_SESSION['user_id']);
?>

<?php include '../admin/inc/head.php'; ?>

<body>
    <!-- SIDEBAR -->
    <?php include '../admin/inc/sidebar.php'; ?>

    <!-- CONTENT -->
    <section id="content">
        <?php include '../admin/inc/navbar.php'; ?>
        <!-- MAIN -->
		<main>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4>Lihat Destinasi Wisata
									<a href="destinasi.php" class="btn btn-danger float-end">Kembali</a>
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

										<div class="mb-3">
											<label>Title</label>
											<p class="form-control">
												<?= $destinasi['title']; ?>
											</p>
										</div>
										<div class="mb-3">
											<label>Location</label>
											<p class="form-control">
												<?= $destinasi['location']; ?>
											</p>
										</div>
										<div class="mb-3">
											<label>Description</label>
											<textarea name="description" id="your_summernote" rows="4" class="form-control"><?= $destinasi['description']; ?></textarea>

										</div>
										<div class="mb-3">
											<label>Gambar Destinasi</label>
											<br>
											<img src="../../../uploads/<?= $destinasi['upload_path']; ?>" alt="Gambar Destinasi" style="width: 25%; margin-top: 3px;">
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
			<script>
				function disableSummernote() {
					$('#your_summernote').summernote('disable');
				}
				$(document).ready(function() {
					disableSummernote();
				});

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
	<script src="../../../public/assets/js/sidebar.js"></script>
</body>

</html>