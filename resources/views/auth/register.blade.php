@extends("layouts.appGuest")

@section("title", "Register Page")

@section("content")

@if($errors->has('error_register'))
<div class="alert alert-danger alert-dismissible fade show alert-danger" role="alert" id="alert-danger">
    {{ $errors->first('error_register') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 mt-4">
        <form class="form" action="{{ route("register") }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old("name") }}" required>
                @error("name")
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ old("last_name") }}" required>
                @error("last_name")
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old("email") }}" required>
                @error("email")
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                @error("password")
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                @error("password_confirmation")
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="profile-form text-center">
                <button type="submit" class="btn custom-btn">Register</button>
            </div>
            <div class="form-group text-center mt-3">
                <p class="title">Already have an account? <a href="{{ route("login") }}">Login</a></p>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(".alert-danger").fadeTo(4000, 400).slideUp(400, function() {
            $(this).slideUp(400);
        });
    });
</script>