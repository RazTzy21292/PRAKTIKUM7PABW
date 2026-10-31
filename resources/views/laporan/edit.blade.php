@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="box">
    <h2>Edit Laporan #{{ $laporan->id }}</h2>

    @if ($laporan->foto)
        <p>Foto saat ini:</p>
        <img src="{{ asset('storage/'.$laporan->foto) }}" alt="Foto banjir di {{ $laporan->lokasi }}" class="thumbnail">
    @endif

    <form action="{{ route('laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('laporan._fields')
        <button type="submit" class="btn">Simpan Perubahan</button>
        <a href="{{ route('laporan.show', $laporan) }}" class="btn">Batal</a>
    </form>
</div>
@endsection
