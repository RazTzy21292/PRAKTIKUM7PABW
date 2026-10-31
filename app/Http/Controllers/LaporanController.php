<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class LaporanController extends Controller
{
    public function index(): View
    {
        $daftarLaporan = Laporan::latest()->paginate(10);

        return view('laporan.index', compact('daftarLaporan'));
    }

    public function create(): View
    {
        return view('laporan.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_pelapor' => ['required', 'string', 'max:100'],
            'no_hp' => ['required', 'string', 'max:20'],
            'lokasi' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'tinggi_air' => ['required', 'integer', 'min:1'],
            'keterangan' => ['required', 'string', 'max:5000'],
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
        $data['foto'] = $this->storeFoto($request->file('foto'));

        $laporan = Laporan::create($data);

        return redirect()
            ->route('laporan.konfirmasi')
            ->with('laporan_id', $laporan->id)
            ->with('success', 'Laporan banjir berhasil dikirim.');
    }

    public function show(Laporan $laporan): View
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan): View
    {
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan): RedirectResponse
    {
        $data = $request->validate([
            'nama_pelapor' => ['required', 'string', 'max:100'],
            'no_hp' => ['required', 'string', 'max:20'],
            'lokasi' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'tinggi_air' => ['required', 'integer', 'min:1'],
            'keterangan' => ['required', 'string', 'max:5000'],
            'status' => ['required', 'in:Menunggu,Diproses,Selesai'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $fotoLama = $laporan->foto;
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->storeFoto($request->file('foto'));
        }

        $laporan->update($data);

        if (isset($data['foto'])) {
            $this->deleteFoto($fotoLama);
        }

        return redirect()
            ->route('laporan.show', $laporan)
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan): RedirectResponse
    {
        $this->deleteFoto($laporan->foto);
        $laporan->delete();

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function konfirmasi(): View|RedirectResponse
    {
        $id = session('laporan_id');
        if (!$id) {
            return redirect()->route('laporan.create');
        }

        return view('laporan.konfirmasi', ['laporan' => Laporan::findOrFail($id)]);
    }

    private function deleteFoto(?string $path): void
    {
        $disk = Storage::disk('public');
        if ($path !== null && $disk->exists($path) && !$disk->delete($path)) {
            throw new RuntimeException("Foto laporan tidak dapat dihapus: {$path}");
        }
    }

    private function storeFoto(UploadedFile $foto): string
    {
        $path = $foto->store('laporan', 'public');
        if ($path === false) {
            throw new RuntimeException('Foto laporan gagal disimpan.');
        }

        return $path;
    }
}