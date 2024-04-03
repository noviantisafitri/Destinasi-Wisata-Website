<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';
require '/xampp/htdocs/destinasi/app/model/users.php';

// Ambil data profil pengguna dari database
$profil = get_user_profile($_SESSION['user_id']);

// Ambil jumlah data dari tabel destinasi
$destinasi_count = get_destinasi_count();

// Ambil jumlah data dari tabel users
$users_count = get_users_count();

// Ambil jumlah data dari tabel favorites
$favorites_count = get_favorites_count();
?>

<?php include '/xampp/htdocs/destinasi/app/view/admin/inc/head.php'; ?>

<body>
		<!-- SIDEBAR -->
		<section id="sidebar">
		<a href="#" class="brand">
			<P class="m-2">DW</P>
			<span class="text"></span>
		</a>
		<ul class="side-menu top" style="padding: 0px;">
			<li class="active">
				<a href="/destinasi/app/view/admin/dashboard.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="/destinasi/app/view/admin/settings.php">
					<i class='bx bxs-user'></i>
					
					<span class="text">Profile</span>
				</a>
			</li>
			<li>
				<a href="/destinasi/app/view/admin/destinasi.php">
					<i class='bx bxs-folder'></i>
					<span class="text">Destinasi</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu bottom" style="padding: 0px;">
			<li class="">
				<a href="/destinasi/app/view/login.php" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<?php include '/xampp/htdocs/destinasi/app/view/admin/inc/navbar.php'; ?>
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<h6><?php echo 'Selamat datang, ' . $_SESSION['first_name'] . ' '. $_SESSION['last_name']?></h6>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<h3><?php echo $destinasi_count; ?></h3>
						<p>Destinasi Wisata</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
						<h3><?php echo $users_count; ?></h3>
						<p>Users</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3><?php echo $favorites_count; ?></h3>
						<p>Favorite</p>
					</span>
				</li>
			</ul>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="/destinasi/public/assets/js/sidebar.js"></script>
</body>

</html>