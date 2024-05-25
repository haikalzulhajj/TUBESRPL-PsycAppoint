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
    <div class="container centered-container">
        <div class="text-center mb-4">
            <img src="images/imageAuth.jpg" alt="Image on Authentication" class="img-fluid custom-img-size">
            <h1 class="mt-3">Your Journey <br> to Brighter Tomorrows</h1>
        </div>
        <div class="card custom-bg-purple p-4">
            <div class="card-text">
                @if(Session::has('message'))
                    <div class="alert alert-danger"> {{ Session::get('message') }}</div>
                @endif
                @if(Session::has('status'))
                    <div class="alert alert-success"> {{ Session::get('status') }}</div>
                @endif
                <h4 class="card-title fs-2 mb-2 text-white">Sign in</h4>
                <p class="card-text fs-5 mb-4">Don't have an account? 
                    <a href="register" class="text-white text-decoration-none"> Sign up </a>
                </p>
            </div>
            <form method="POST">
                @csrf
                <div class="form-group">
                    <label for="username" class="text-white bold-label">USERNAME</label>
                    <input id="username" class="form-control input-lg mb-3" type="text" name="name" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password" class="text-white bold-label">PASSWORD</label>
                    <input id="password" class="form-control input-lg mb-4" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="login" class="btn btn-white input-lg">Sign in</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
