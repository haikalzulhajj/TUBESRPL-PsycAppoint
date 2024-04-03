<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid px-5 justify-content-end">
                <div class="d-flex">
                    <img src="images/image 3.png" alt="">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <div class="container py-5">
        <div class="row rows-cols-2 justify-content-between">
            <div class="col-6">
                <img src="images/amico.png" alt="">
            </div>
            <div class="col-4">
                <h3>Daftar</h3>
                <form action="" method="post">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="my-input my-2">Nama Lengkap</label>
                        <input id="my-input" class="form-control" type="text" name="name" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="my-input my-2">Alamat</label>
                        <input id="my-input" class="form-control" type="text" name="address" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="my-input my-2">No. Hp</label>
                        <input id="my-input" class="form-control" type="number" name="phoneNo" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="my-input my-2">Password</label>
                        <input id="my-input" class="form-control" type="password" name="password" required>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" name="register" id="" class="btn btn-success py-2">
                            Continue
                        </button>
                    </div>

                </form>
                <div class="text-center mt-4">
                    Already have account ? <a href="/" class="text-success text-decoration-none">Login Here</a>
                </div>

            </div>


        </div>
    </div>
</body>

</html>