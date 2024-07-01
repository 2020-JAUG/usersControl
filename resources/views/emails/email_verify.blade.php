@extends("layouts.appMails")

@section("title", "Verify Email")

@section("content")

<p>Hi, {{ $user }}</p>
<p>Please click the link below to verify your email address:</p>

<a href="{{ $url }}">Verify Email</a>

@endsection