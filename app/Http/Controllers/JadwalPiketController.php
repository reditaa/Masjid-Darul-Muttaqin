<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalPiketController extends Controller
{
    protected function rules(): array
    {
        return [
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis',
            'koordinator_id' => 'required|exists:pengurus,id',
            'anggota1_id' => 'required|exists:pengurus,id',
            'anggota2_id' => 'required|exists:pengurus,id',
            'anggota3_id' => 'required|exists:pengurus,id',
            'anggota4_id' => 'required|exists:pengurus,id',
            'keterangan' => 'nullable',
        ];
    }

    public function index()
    {
        $jadwalPiket = JadwalPiket::with([
            'koordinator.anggota.guru',
            'koordinator.anggota.siswa',
            'anggota1.anggota.guru',
            'anggota1.anggota.siswa',
            'anggota2.anggota.guru',
            'anggota2.anggota.siswa',
            'anggota3.anggota.guru',
            'anggota3.anggota.siswa',
            'anggota4.anggota.guru',
            'anggota4.anggota.siswa',
        ])->latest()->paginate(10);

        return view('jadwal-piket.index', compact('jadwalPiket'));
    }

    public function create()
    {
        $pengurus = Pengurus::with([
            'anggota.guru',
            'anggota.siswa'
        ])->get();

        return view('jadwal-piket.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        JadwalPiket::create($data);

        return redirect()
            ->route('jadwal-piket.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalPiket $jadwalPiket)
    {
        $pengurus = Pengurus::with([
            'anggota.guru',
            'anggota.siswa'
        ])->get();

        return view('jadwal-piket.edit', compact(
            'jadwalPiket',
            'pengurus'
        ));
    }

    public function update(Request $request, JadwalPiket $jadwalPiket)
    {
        $data = $request->validate($this->rules());

        $jadwalPiket->update($data);

        return redirect()
            ->route('jadwal-piket.index')
            ->with('success', 'Jadwal berhasil diubah.');
    }

    public function destroy(JadwalPiket $jadwalPiket)
    {
        $jadwalPiket->delete();

        return redirect()
            ->route('jadwal-piket.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}