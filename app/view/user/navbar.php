<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mr-auto" style="font-size: 20px;">
          <a class="nav-link" aria-current="page" href="/destinasi/app/view/user/#home">Home</a>
          <a class="nav-link" href="/destinasi/app/view/user/#destination">Destinasi</a>
          <a class="nav-link" href="/destinasi/app/view/user/#blog">Blog</a>
          <a class="nav-link" href="/destinasi/app/view/user/#gallery">Galeri</a>
          
          <a class="nav-link" href="/destinasi/app/view/user/favorite.php">Favorite</a>
        </div>
        <div class="navbar-nav ms-auto" style="font-size: 20px;">
          <a class="nav-link btn text-primary"  href="/destinasi/app/view/login.php"><?php echo "Halo, " . $_SESSION['first_name'] ?> <i style="font-size: 26px; float: inline-end; margin-left: 5px;" class='bx bx-log-out'></i></a>
        </div>
      </div>
    </div>
  </nav>
</header>
