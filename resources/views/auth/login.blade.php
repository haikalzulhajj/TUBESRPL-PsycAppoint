<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .custom-bg-purple {
            background-color: purple;
        }
        .bold-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
  <div class="">
    <div class="row align-items-center">
      <div class="col-md-6 text-center">
      <img src="images/imageAuth.jpg" alt="Image on Authentication" style="width: 50%;">
        <h1 class="text-center">Your Journey <br> to Brighter Tomorrows</h1>
      </div>
      <div class="col-md-6 custom-bg-purple min-height-container d-flex align-items-center justify-content-center">
        <div class="col-md-11">
          <div class="card-text">
            @if(Session::has('message'))
                    <div class="alert alert-danger"> {{ Session::get('message') }}</div>
                @endif
                @if(Session::has('status'))
                    <div class="alert alert-success"> {{ Session::get('status') }}</div>
                @endif
            <h4 class="card-title fs-1 mb-2 text-white">Sign in</h4>
            <p class="card-text fs-5 mb-5">Don't have an account? 
              <a href="register" class="text-white text-decoration-none"> Sign up </a>
            </p>
          </div>
          <form method="POST">
            @csrf
              <div class="form-group">
                <label for="username" class="text-white bold-label">USERNAME</label>
                <input id="username" class="form-control input-lg mb-4" type="text" name="name" placeholder="Username" required>
              </div>
              <div class="form-group">
                <label for="password" class="text-white bold-label">PASSWORD</label>
                <input id="password" class="form-control input-lg mb-5" type="password" name="password" placeholder="Password" required>
              </div>
              <div class="text-end">
                <button type="submit" name="login" class="btn btn-white input-lg">Sign in</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
