@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="box">
    <h2>Detail Laporan #{{ $laporan->id }}</h2>
    <table class="detail">
        <tr><td>Nama Pelapor</td><td>{{ $laporan->nama_pelapor }}</td></tr>
        <tr><td>Nomor HP</td><td>{{ $laporan->no_hp }}</td></tr>
        <tr><td>Lokasi</td><td>{{ $laporan->lokasi }}</td></tr>
        <tr><td>Kecamatan</td><td>{{ $laporan->kecamatan }}</td></tr>
        <tr><td>Tinggi Air</td><td>{{ $laporan->tinggi_air }} cm</td></tr>
        <tr><td>Keterangan</td><td>{{ $laporan->keterangan }}</td></tr>
        <tr><td>Status</td><td><span class="badge {{ strtolower($laporan->status) }}">{{ $laporan->status }}</span></td></tr>
        <tr><td>Dilaporkan</td><td>{{ $laporan->created_at->format('d-m-Y H:i') }}</td></tr>
    </table>
    @if ($laporan->foto)
        <p><img src="{{ asset('storage/'.$laporan->foto) }}" alt="Foto banjir di {{ $laporan->lokasi }}" style="max-width: 100%; height: auto;"></p>
    @endif
    <a href="{{ route('laporan.edit', $laporan) }}" class="btn">Edit Laporan</a>
    <a href="{{ route('laporan.index') }}" class="btn">Kembali ke Daftar</a>
</div>
@endsection
