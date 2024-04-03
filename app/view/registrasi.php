<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/destinasi/public/assets/css/login.css" />
  <title>Destinasi Wisata</title>
</head>

<body>
  <!-- Section: Design Block -->
  <section class="text-center">
    <!-- Background image -->
    <div class="size-layar p-2 bg-image" style="background-image: url('/destinasi/uploads/rumah ulin.jpg'); min-height: 100vh; background-size: cover;">

    <div style="display: flex; justify-content: center; align-items: center;">
      <div class="card mx-1 mx-md-5 shadow-5-strong mt-4" style="
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        width: 60%;
        ">
        <div class="card-body px-md-5">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <h2 class="fw-bold mb-5">Registrasi</h2>
              <form action="/destinasi/app/model/registrasi.php" method="POST">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline text-start">
                      <label class="form-label" for="form3Example1">First name</label>
                      <input type="text" id="first_name" name="first_name" class="form-control" />
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 ">
                    <div class="form-outline text-start">
                      <label class="form-label" for="form3Example2">Last name</label>
                      <input type="text" id="last_name" name="last_name" class="form-control" />
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" id="email" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="password" name="password" class="form-control" />
                </div>

                <div class="form-outline mb-4 text-start">
                  <label class="form-label" for="form3Example4">Confirm Password</label>
                  <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                </div>

                <!-- Submit button -->
                <div class="col">
                  <!-- <button type="submit" class="btn btn-primary btn-block mb-4">
                Login
              </button> -->
                  <button type="submit" name="signup" class="btn btn-primary mb-4">
                    Sign up
                  </button>
                  <!-- <a href="/tour-website/app/controller/registration_c.php" class="btn btn-primary btn-block mb-4">
                Registrasi
              </a> -->
                </div>

              </form>
              <p class="mb-0">Already have an account? <a href="/destinasi/app/view/login.php">Login</a></p>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- Section: Design Block -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>