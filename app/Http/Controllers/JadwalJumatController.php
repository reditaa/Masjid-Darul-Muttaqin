<?php

namespace App\Http\Controllers;

use App\Models\JadwalJumat;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalJumatController extends Controller
{
    /**
     * Menampilkan daftar jadwal Jumat
     */
    public function index()
    {
        $jadwalJumat = JadwalJumat::with([
            'khotib',
            'imam'
        ])->get();

        return view('jadwal-jumat.index', compact('jadwalJumat'));
    }


    /**
     * Form tambah jadwal Jumat
     */
    public function create()
    {
        $pengurus = Pengurus::with('anggota')
            ->where('status', 'Aktif')
            ->get();

        return view('jadwal-jumat.create', compact('pengurus'));
    }


    /**
     * Simpan jadwal Jumat
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'pasaran' => [
                'required',
                'in:Pon,Kliwon,Pahing,Wage,Legi'
            ],

            'khotib_id' => [
                'required',
                'exists:pengurus,id'
            ],

            'imam_id' => [
                'required',
                'exists:pengurus,id'
            ],

        ]);


        JadwalJumat::create($data);


        return redirect()
            ->route('jadwal-jumat.index')
            ->with('success', 'Jadwal Jumat berhasil ditambahkan.');
    }


    /**
     * Form edit
     */
    public function edit(JadwalJumat $jadwalJumat)
    {
        $pengurus = Pengurus::with('anggota')
            ->where('status', 'Aktif')
            ->get();


        return view(
            'jadwal-jumat.edit',
            compact(
                'jadwalJumat',
                'pengurus'
            )
        );
    }


    /**
     * Update jadwal Jumat
     */
    public function update(Request $request, JadwalJumat $jadwalJumat)
    {

        $data = $request->validate([

            'pasaran' => [
                'required',
                'in:Pon,Kliwon,Pahing,Wage,Legi'
            ],

            'khotib_id' => [
                'required',
                'exists:pengurus,id'
            ],

            'imam_id' => [
                'required',
                'exists:pengurus,id'
            ],

        ]);


        $jadwalJumat->update($data);


        return redirect()
            ->route('jadwal-jumat.index')
            ->with('success', 'Jadwal Jumat berhasil diubah.');

    }


    /**
     * Hapus jadwal Jumat
     */
    public function destroy(JadwalJumat $jadwalJumat)
    {

        $jadwalJumat->delete();


        return redirect()
            ->route('jadwal-jumat.index')
            ->with('success', 'Jadwal Jumat berhasil dihapus.');

    }
}