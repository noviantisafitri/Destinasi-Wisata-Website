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
			<li>
				<a href="settings.php">
					<i class='bx bxs-user'></i>
					
					<span class="text">Profile</span>
				</a>
			</li>
			<li class="active">
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