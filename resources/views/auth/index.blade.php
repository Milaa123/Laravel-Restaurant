<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- Menggunakan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS Kustom */
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .card {
            width: 350px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-body">
        <h3 class="card-title text-center">{{ $title }}</h3>
        @if(session()->has("errorMessage"))
            <div class="alert alert-danger">
                {{ session("errorMessage") }}
            </div>
        @endif
        <form method="POST" action="{{ URL::to('/login') }}" autocomplete="off"> 
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control {{ @error-> has ('username')is-invalid @enderror}}" placeholder="Enter username">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control {{ @error->has ('password')is-invalid @enderror }}" placeholder="Enter password" >
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
</div>

<!-- Menggunakan Bootstrap JS (Popper.js and Bootstrap JS) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>