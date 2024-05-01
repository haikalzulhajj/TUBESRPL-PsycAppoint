<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="">
  <div class="row align-items-center">
    <div class="col-md-6 text-center">
      <img src="images/imageAuth.png" alt="Image on Authentication">
      <h1 class="text-center">Tingkatkan Kebersihan <br> Lingkunganmu di WhizCycle</h1>
    </div>
    <div class="col-md-6 bg-custom min-height-container d-flex align-items-center justify-content-center">
      <div class="col-md-11">
        <div class="card-text">
          <h4 class="card-title fs-1 mb-2 text-white">Kirim Sampahmu Sekarang!</h4>
          <p class="card-text fs-5 mb-5">Sudah Punya Akun? 
            <a href="/" class="text-white text-decoration-none"> Masuk </a>
          </p>
        </div>
          @if ($errors->any())
              <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      <p>{{ $error }}</p>
                  @endforeach
              </div>
          @endif
          <form method="post">
                @csrf
                <div class="form-group">
                    <input id="my-input" class="form-control input-lg mb-4" type="text" name="name" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group ">
                    <input id="my-input" class="form-control input-lg mb-4" type="text" name="address" placeholder="Alamat" required>
                </div>
                <div class="form-group ">
                    <input id="my-input" class="form-control input-lg mb-4" type="number" name="phoneNo" placeholder="No. Telp" required>
                </div>
                <div class="form-group ">
                    <input id="my-input" class="form-control input-lg mb-4" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="text-end">
                    <button type="submit" name="register" id=""class="btn btn-white input-lg">
                        Daftar
                    </button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
</body>

</html>