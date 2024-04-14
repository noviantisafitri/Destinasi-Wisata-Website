<!-- NAVBAR -->
<nav>
	<i class='bx bx-menu' style="font-size: 2.2rem;"></i>
	<!-- <a href="#" class="nav-link"></a> -->
	<form action="#">
	</form>
	<label class="title-profile"><?php echo $_SESSION['first_name'] . ' '. $_SESSION['last_name']?></label>
	<a href="#" class="profile">
	<img src="../../../uploads/<?php echo $profil['foto']; ?>" alt="Gambar Profil">
	</a>
</nav>
<!-- NAVBAR -->