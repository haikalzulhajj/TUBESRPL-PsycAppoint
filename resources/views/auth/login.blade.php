<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .min-height-container {
        min-height: 100vh;
    }
</style>


<body>
<div class="">
  <div class="row align-items-center">
    <div class="col-md-6 text-center">
      <img src="images/imageAuth.png" alt="Image on Authentication">
      <h1 class="text-center">Tingkatkan Kebersihan <br> Lingkunganmu di WhizCycle</h1>
    </div>
    <div class="col-md-6 bg-success min-height-container d-flex align-items-center justify-content-center">
      <div class="col-md-8">
        <div class="card-text">
          <h4 class="card-title fs-1 mb-2">Masuk</h4>
          <p class="card-text fs-5 text-muted mb-5">Belum Punya Akun? <a href="register" class="text-decoration-none">Daftar</a></p>
        </div>
        <form action="" method="POST">
        @csrf
          <div class="form-group">
            <label for="my-input">Nama</label>
            <input id="my-input" class="form-control" type="text" name="name" required>
          </div>
          <div class="form-group">
            <label for="my-input">Password</label>
            <input id="my-input" class="form-control" type="password" name="password" required>
          </div>
          <div class="d-grid gap-2 text-end">
            <button type="submit" name="login" id="" class="btn btn-success">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>