<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="background-img-container">
            <img src="images/imageAuth2.jpg" alt="Image on Authentication">
        </div>
        <div class="card">
            <h4 class="card-title">Create New Account</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="post">
                @csrf
                <div class="form-group input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                    </div>
                    <input id="username" class="form-control" type="text" name="name" placeholder="Username" required>
                </div>
                <div class="form-group input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-house"></i></span>
                    </div>
                    <input id="address" class="form-control" type="text" name="address" placeholder="Address" required>
                </div>
                <div class="form-group input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    </div>
                    <input id="phoneNo" class="form-control" type="number" name="phoneNo" placeholder="No. Telp" required>
                </div>
                <div class="form-group input-group mb-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    </div>
                    <input id="password" class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="register" class="btn btn-custom">Sign up</button>
            </form>
            <div class="register-link mt-3">
                <p class="text-black text-decoration-none">Already have an account? 
                    <a href="/" class="text-light text-decoration-none sign-in-link">Sign in</a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
