<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $siswas = Siswa::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%")
                      ->orWhere('kelas', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('siswa.index', compact('siswas', 'search'));
    }


    public function create()
    {
        return view('siswa.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nis'      => 'required|unique:siswas,nis',
            'nama'     => 'required',
            'kelas'    => 'required',
            'email'    => 'required|email|unique:siswas,email',
            'password' => 'required|min:6',
            'no_hp'    => 'required',
            'alamat'   => 'nullable',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'   => 'required',
        ]);


        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('siswa', 'public');
        }


        $data['password'] = Hash::make($data['password']);


        // Simpan siswa
        $siswa = Siswa::create($data);


        // Otomatis buat anggota
        Anggota::create([
            'siswa_id' => $siswa->id,
            'jenis' => 'Siswa',
            'status' => 'Aktif',
        ]);


        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }


    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }


    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nis'      => 'required|unique:siswas,nis,' . $siswa->id,
            'nama'     => 'required',
            'kelas'    => 'required',
            'email'    => 'required|email|unique:siswas,email,' . $siswa->id,
            'no_hp'    => 'required',
            'alamat'   => 'nullable',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'   => 'required',
        ]);


        if ($request->filled('password')) {

            $request->validate([
                'password' => 'min:6'
            ]);

            $data['password'] = Hash::make($request->password);
        }


        if ($request->hasFile('foto')) {

            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }

            $data['foto'] = $request->file('foto')->store('siswa', 'public');
        }


        $siswa->update($data);


        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diubah.');
    }


    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }


        // hapus anggota terkait
        Anggota::where('siswa_id', $siswa->id)->delete();


        $siswa->delete();


        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}