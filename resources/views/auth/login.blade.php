@extends("layouts.appGuest")

@section("title", "Login Page")

@section("content")
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 mt-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if($errors->has('verify_email_err'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
            {{ $errors->first('verify_email_err') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if($errors->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
            {{ $errors->first('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form class="form" action="{{ route("login") }}" method="post">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old("email") }}" required>
                @error("email")
                <div class="alert alert-danger mt-3" id="alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                @error("password")
                <div class="alert alert-danger mt-3" id="alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="profile-form text-center mb-3">
                <button type="submit" class="btn custom-btn">Login</button>
            </div>

            <div class="form-group text-center">
                <p class="title">Don't have an account?
                    <a href="{{ route("register") }}" class="profile-form button">
                        Register
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(".alert").fadeTo(4000, 400).slideUp(400, function() {
            $(this).slideUp(400);
        });
    });
</script>