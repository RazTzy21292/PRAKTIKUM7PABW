@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')
<h2>Daftar Laporan Banjir</h2>

@forelse ($daftarLaporan as $item)
    @if ($item->tinggi_genangan < 30)
        @php($status = 'Waspada')
        @php($kelas = 'waspada')
    @elseif ($item->tinggi_genangan <= 70)
        @php($status = 'Siaga')
        @php($kelas = 'siaga')
    @else
        @php($status = 'Awas')
        @php($kelas = 'awas')
    @endif

    @include('partials.laporan-card', ['laporan' => $item, 'status' => $status, 'kelas' => $kelas])
@empty
    <x-alert type="info">Belum ada laporan banjir.</x-alert>
@endforelse
@endsection