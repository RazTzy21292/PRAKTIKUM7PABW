@extends('layouts.app')

@section('title', 'Konfirmasi Laporan')

@section('content')
<x-alert type="success">
    Laporan banjir berhasil disimpan ke database. Terima kasih, <strong>{{ $laporan->nama_pelapor }}</strong>!
</x-alert>

<div class="box">
    <h2>Data yang Dikirim</h2>
    <table class="detail">
        <tr><td>Nama Pelapor</td><td>: {{ $laporan->nama_pelapor }}</td></tr>
        <tr><td>Lokasi Kejadian</td><td>: {{ $laporan->lokasi }}</td></tr>
        <tr><td>Tinggi Genangan</td><td>: {{ $laporan->tinggi_genangan }} cm</td></tr>
        <tr><td>Tanggal Kejadian</td><td>: {{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d M Y') }}</td></tr>
    </table>
    <a href="{{ route('laporan.create') }}" class="btn">Buat Laporan Baru</a>
    <a href="{{ route('laporan.index') }}" class="btn">Lihat Daftar Laporan</a>
</div>
@endsection