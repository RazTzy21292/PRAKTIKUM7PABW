<label for="nama_pelapor">Nama Pelapor</label>
<input type="text" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor', $laporan?->nama_pelapor) }}" required>
@error('nama_pelapor') <div class="error">{{ $message }}</div> @enderror

<label for="no_hp">Nomor HP</label>
<input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp', $laporan?->no_hp) }}" required>
@error('no_hp') <div class="error">{{ $message }}</div> @enderror

<label for="lokasi">Lokasi Kejadian</label>
<input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $laporan?->lokasi) }}" required>
@error('lokasi') <div class="error">{{ $message }}</div> @enderror

<label for="kecamatan">Kecamatan</label>
<input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $laporan?->kecamatan) }}" required>
@error('kecamatan') <div class="error">{{ $message }}</div> @enderror

<label for="tinggi_air">Tinggi Air (cm)</label>
<input type="number" id="tinggi_air" name="tinggi_air" min="1" value="{{ old('tinggi_air', $laporan?->tinggi_air) }}" required>
@error('tinggi_air') <div class="error">{{ $message }}</div> @enderror

<label for="keterangan">Keterangan</label>
<textarea id="keterangan" name="keterangan" required>{{ old('keterangan', $laporan?->keterangan) }}</textarea>
@error('keterangan') <div class="error">{{ $message }}</div> @enderror

@if ($laporan)
    <label for="status">Status Penanganan</label>
    <select id="status" name="status" required>
        @foreach (['Menunggu', 'Diproses', 'Selesai'] as $status)
            <option value="{{ $status }}" @selected(old('status', $laporan->status) === $status)>{{ $status }}</option>
        @endforeach
    </select>
    @error('status') <div class="error">{{ $message }}</div> @enderror
@endif

<label for="foto">Foto Bukti (JPG, JPEG, atau PNG; maksimal 2 MB)</label>
<input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,image/jpeg,image/png" @required(!$laporan)>
@error('foto') <div class="error">{{ $message }}</div> @enderror
