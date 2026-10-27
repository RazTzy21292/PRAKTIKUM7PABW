@extends('layouts.app')

@section('title', 'Login Petugas')

@section('content')
<div class="box">
    <h2>Login Petugas BPBD</h2>

    @if (session('status'))
        <x-alert type="success">{{ session('status') }}</x-alert>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <button type="submit" class="btn">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
</div>
@endsection