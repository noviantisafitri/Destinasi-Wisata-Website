<?php
// session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css" />
  <title>Destinasi Wisata</title>
</head>

<body>
  <!-- Section: Design Block -->
  <section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->
    <div style="        
          display: flex;
          justify-content: center;
          align-items: center;">
      <div class="card mx-1 mx-md-5 shadow-5-strong" style="
        margin-top: -200px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        width: 50%;
        ">
        <div class="card-body px-md-5">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
            <?php include('/xampp/htdocs/destinasi/app/view/admin/message.php'); ?>

              <h2 class="fw-bold mb-5">Login</h2>
              <form action="/destinasi/app/model/login.php" method="POST">

                <!-- Email input -->
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="form3Example3">Email</label>
                  <input type="email" id="email" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="password" name="password" class="form-control" />
                </div>

                <!-- Submit button -->
                <div class="col">
                  <button type="submit" class="btn btn-primary btn-block mb-4">
                    Login
                  </button>
                </div>

              </form>
              <p class="mb-0">Belum memiliki akun? <a href="/destinasi/app/view/registrasi.php">Sign Up</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- Section: Design Block -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>