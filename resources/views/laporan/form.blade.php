@extends('layouts.app')

@section('title', 'Form Pelaporan')

@section('content')
<div class="box">
    <h2>Form Pelaporan Banjir</h2>
    <p>Lengkapi informasi dan unggah foto kondisi banjir sebagai bukti laporan.</p>

    @php($laporan = null)
    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('laporan._fields')
        <button type="submit" class="btn">Kirim Laporan</button>
    </form>
</div>
@endsection