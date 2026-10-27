<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function create()
    {
        return view('laporan.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelapor'     => 'required|string|max:100',
            'lokasi'           => 'required|string|max:150',
            'tinggi_genangan'  => 'required|integer|min:1',
            'tanggal_kejadian' => 'required|date|before_or_equal:today',
        ]);

        $laporan = Laporan::create($data);

        return redirect()
            ->route('laporan.konfirmasi')
            ->with('laporan_id', $laporan->id);
    }

    public function konfirmasi()
    {
        $id = session('laporan_id');

     
        if (!$id) {
            return redirect()->route('laporan.create');
        }

        return view('laporan.konfirmasi', ['laporan' => Laporan::findOrFail($id)]);
    }

    public function index()
    {
        $daftarLaporan = Laporan::all()->sortByDesc('tanggal_kejadian');

        return view('laporan.index', ['daftarLaporan' => $daftarLaporan]);
    }
}