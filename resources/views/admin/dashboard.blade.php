@extends('layouts.app')

@section('content')
    <div class="container">
    <h1 class="text-center">Welcome to Admin Dashboard</h1>
    <p class="text-center">You're logged in as <strong>{{ Auth::user()->name }}</strong></p>
</div>>
@endsection
