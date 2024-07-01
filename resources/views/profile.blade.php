<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield("title")</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .body-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
            margin-top: 60px;
        }

        .title {
            color: rgba(0, 0, 0, 0.5);
        }

        .profile-form .form-group {
            margin-bottom: 20px;
        }

        .profile-form label {
            display: block;
            margin-bottom: 5px;
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #09293d;
            color: #f8f9fa;
        }

        .disabled-cursor {
            cursor: not-allowed;
        }

        div.error {
            color: red;
            font-weight: 600;
            margin-top: 6px;
        }

        .alert {
            padding: 15px;
            margin-top: 20px;
            background-color: #d4edda;
            border: 1px solid #0dc337;
            color: #155724;
            border-radius: 5px;
            position: relative;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">My Data</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="body-content">
        <div class="card">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <h2 class="text-center title">Profile</h2>
            <form class="profile-form" method="post" action="{{ route('profile') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="title">Name:</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" autocomplete="name" required>
                    @error('name')
                    <div class='error'>{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name" class="title">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="{{ auth()->user()->last_name }}" autocomplete="family-name" required>
                    @error('last_name')
                    <div class='error'>{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="title">Email:</label>
                    <input type="email" id="email" class=" disabled-cursor" name="email" value="{{ auth()->user()->email }}" disabled autocomplete="email">
                </div>
                <div class="form-group">
                    <label for="date" class="title">Since</label>
                    <input type="text" id="date" class=" disabled-cursor" name="date" value="{{ auth()->user()->created_at->format('Y-m-d') }}" disabled autocomplete="off">
                </div>
                <div class="form-group text-center">
                    <button type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $("#success-alert").fadeTo(2000, 200).slideUp(200, function() {
                $(this).slideUp(200);
            });
        });
    </script>
</body>

</html>