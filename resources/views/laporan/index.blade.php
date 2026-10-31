@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')
<h2>Daftar Laporan Banjir</h2>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Pelapor</th>
                <th>Lokasi</th>
                <th>Tinggi Air</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarLaporan as $item)
                <tr>
                    <td>
                        @if ($item->foto)
                            <img class="thumbnail" src="{{ asset('storage/'.$item->foto) }}" alt="Foto banjir di {{ $item->lokasi }}">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->nama_pelapor }}<br><small>{{ $item->no_hp }}</small></td>
                    <td>{{ $item->lokasi }}<br><small>{{ $item->kecamatan }}</small></td>
                    <td>{{ $item->tinggi_air }} cm</td>
                    <td><span class="badge {{ strtolower($item->status) }}">{{ $item->status }}</span></td>
                    <td class="actions">
                        <a href="{{ route('laporan.show', $item) }}">Detail</a>
                        <a href="{{ route('laporan.edit', $item) }}">Edit</a>
                        <form action="{{ route('laporan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada laporan banjir.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $daftarLaporan->links() }}
@endsection