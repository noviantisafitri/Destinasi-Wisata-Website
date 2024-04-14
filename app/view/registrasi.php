<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../../public/assets/css/login.css" />
  <title>Destinasi Wisata</title>
</head>

<body>
  <section>
    <div class="wrapper">
      <form action="../model/registrasi.php" method="POST">
        <h1>Register</h1>
        <div class="input-box">
          <label class="form-label" for="form3Example1">First name</label>
          <input type="text" id="first_name" name="first_name" class="form-control" />
        </div>
        <!-- <div style="margin-left: 10px;"> -->
        <div class="input-box">
          <label class="form-label" for="form3Example2">Last name</label>
          <input type="text" id="last_name" name="last_name" class="form-control" />
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="input-box">
          <label class="form-label" for="form3Example3">Email address</label>
          <input type="email" id="email" name="email" class="form-control" />
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="input-box">
          <label class="form-label" for="form3Example4">Password</label>
          <input type="password" id="password" name="password" class="form-control" />
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="input-box">
          <label class="form-label" for="form3Example4">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
          <i class='bx bxs-lock-alt'></i>
        </div>
        <button type="submit" name="signup" class="btn mt-3">
          Register
        </button>
        <div class="register-link">
          <p>Sudah memiliki akun? <a href="login.php">Login</a></p>
        </div>
      </form>
    </div>

    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>