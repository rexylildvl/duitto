<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background-color: #2D3250;
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }
        .bg-image {
            background: url('/images/register-bg.png') center/cover no-repeat;
        }
        .highlight {
            background: linear-gradient(to right, #fdb88d, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }
        .form-box {
            background-color: #3e446a;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .form-control {
            background-color: #5b628c;
            border: none;
            border-radius: 1rem;
            color: white;
        }
        .form-control::placeholder {
            color: #d0d3ec;
        }
        .btn-peach {
            background-color: #fdb88d;
            color: #2D3250;
            font-weight: bold;
            border-radius: 1rem;
        }
        .btn-peach:hover {
            background-color: #fab07f;
        }
        .nav-link.active {
            border-bottom: 2px solid #fdb88d;
        }
        .logo-text {
            position: absolute;
            top: 1rem;
            right: 2rem;
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #fdb88d, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>
<div class="container-fluid h-100 position-relative">
    <div class="logo-text">Duitto</div>

    <div class="row h-100">
        <div class="col-md-6 d-flex justify-content-center align-items-center px-5">
            <div class="w-100" style="max-width: 400px;">
                <div class="mb-4 d-flex gap-4">
                    <a class="nav-link active text-white fw-bold" href="{{ route('register') }}">Daftar</a>
                    <a class="nav-link text-white fw-bold" href="{{ route('login') }}">Masuk</a>
                </div>
                <br>
                <h1 class="mb-4 fw-bold" style="font-family: 'Playfair Display', serif;">
                    Daftarkan Akun <br><span class="highlight">Duitto</span> mu!
                </h1>

                <form method="POST" action="{{ route('register') }}" class="form-box w-100">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-peach py-2">Daftar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6 bg-image d-none d-md-block"></div>
    </div>
</div>
</body>
</html>
