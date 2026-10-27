<div class="card {{ $kelas }}">
    <h3>{{ $laporan->lokasi }}</h3>
    <p>Pelapor: <strong>{{ $laporan->nama_pelapor }}</strong></p>
    <p>Tinggi genangan: <strong>{{ $laporan->tinggi_genangan }} cm</strong></p>
    <p>Tanggal: {{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d M Y') }}</p>
    <span class="badge {{ $kelas }}">{{ $status }}</span>
</div>