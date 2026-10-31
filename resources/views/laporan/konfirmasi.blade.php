@extends('layouts.app')

@section('title', 'Konfirmasi Laporan')

@section('content')
<div class="box">
    <h2>Terima kasih, {{ $laporan->nama_pelapor }}. Laporan Anda telah diterima.</h2>
    <table class="detail">
        <tr><td>Nama Pelapor</td><td>: {{ $laporan->nama_pelapor }}</td></tr>
        <tr><td>Nomor HP</td><td>: {{ $laporan->no_hp }}</td></tr>
        <tr><td>Lokasi</td><td>: {{ $laporan->lokasi }}, {{ $laporan->kecamatan }}</td></tr>
        <tr><td>Tinggi Air</td><td>: {{ $laporan->tinggi_air }} cm</td></tr>
        <tr><td>Keterangan</td><td>: {{ $laporan->keterangan }}</td></tr>
        <tr><td>Status</td><td>: {{ $laporan->status }}</td></tr>
    </table>
    <a href="{{ route('laporan.create') }}" class="btn">Buat Laporan Baru</a>
    @auth
        <a href="{{ route('laporan.index') }}" class="btn">Lihat Daftar Laporan</a>
    @endauth
</div>
@endsection