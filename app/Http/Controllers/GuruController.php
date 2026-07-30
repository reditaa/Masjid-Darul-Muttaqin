<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $guru = Guru::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('guru.index', compact('guru'));
    }


    public function create()
    {
        return view('guru.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nip'      => 'required|unique:gurus,nip',
            'nama'     => 'required',
            'email'    => 'nullable|email|unique:gurus,email',
            'password' => 'required|min:6',
            'no_hp'    => 'nullable',
            'alamat'   => 'nullable',
            'status'   => 'required',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }


        $data['password'] = bcrypt($request->password);


        // Simpan guru
        $guru = Guru::create($data);


        // Otomatis buat anggota
       Anggota::create([
    'guru_id' => $guru->id,
    'jenis' => 'Guru',
    'status' => 'Aktif',
]);

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }


    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }


    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nip'      => 'required|unique:gurus,nip,' . $guru->id,
            'nama'     => 'required',
            'email'    => 'nullable|email|unique:gurus,email,' . $guru->id,
            'no_hp'    => 'nullable',
            'alamat'   => 'nullable',
            'status'   => 'required',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }


        if ($request->hasFile('foto')) {

            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }


        $guru->update($data);


        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil diubah.');
    }


    public function destroy(Guru $guru)
    {
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }


        // hapus anggota yang terhubung
        Anggota::where('guru_id', $guru->id)->delete();


        $guru->delete();


        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}