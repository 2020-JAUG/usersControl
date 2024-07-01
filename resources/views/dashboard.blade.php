@extends("layouts.app")

@section("title", "Dashboard Page")

@section("content")

<h2 class='title'> Hi {{ auth()->user()->name }}, Welcome to the Dashboard</h2>
<p class='title'>This view is under maintenance.</p>

@endsection