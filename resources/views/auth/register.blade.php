@extends('layouts.app')

@section('title', 'Register Petugas')

@section('content')
<div class="box">
    <h2>Register Petugas BPBD</h2>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <button type="submit" class="btn">Register</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection