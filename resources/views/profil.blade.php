@extends('layouts.app')

@section('title', 'Profil Petugas')

@section('content')
<div class="box">
    <h2>Profil Petugas</h2>
    <table class="detail">
        <tr><td>Nama</td><td>: {{ $petugas->name }}</td></tr>
        <tr><td>Email</td><td>: {{ $petugas->email }}</td></tr>
        <tr><td>Akun dibuat</td><td>: {{ $petugas->created_at->format('d M Y, H:i') }}</td></tr>
    </table>
</div>
@endsection