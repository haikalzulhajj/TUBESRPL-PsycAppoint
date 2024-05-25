<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .custom-bg-purple {
            background-color: purple;
        }
    </style>
</head>

<body>
<div class="">
  <div class="row align-items-center">
    <div class="col-md-6 text-center">
      <img src="images/imageAuth2.jpg" alt="Image on Authentication" style="width: 60%;">
      <h1 class="text-center">Your Journey <br> to Brighter Tomorrows</h1>
    </div>
    <div class="col-md-6 custom-bg-purple min-height-container d-flex align-items-center justify-content-center">
      <div class="col-md-11">
        <div class="card-text">
          <h4 class="card-title fs-1 mb-2 text-white">Create Your Account</h4>
          <p class="card-text fs-5 mb-5">Already have an account? 
            <a href="/" class="text-white text-decoration-none"> Sign in </a>
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
                    <input id="my-input" class="form-control input-lg mb-4" type="text" name="name" placeholder="Username" required>
                </div>
                <div class="form-group ">
                    <input id="my-input" class="form-control input-lg mb-4" type="text" name="address" placeholder="Address" required>
                </div>
                <div class="form-group ">
                    <input id="my-input" class="form-control input-lg mb-4" type="number" name="phoneNo" placeholder="No. Telp" required>
                </div>
                <div class="form-group ">
                    <input id="my-input" class="form-control input-lg mb-4" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="text-end">
                    <button type="submit" name="register" id=""class="btn btn-white input-lg">
                        Sign up
                    </button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
</body>

</html>
