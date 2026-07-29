<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Menampilkan semua data guru
     */
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

    /**
     * Form tambah guru
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Simpan data guru
     */
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

        Guru::create($data);

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Form edit guru
     */
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update data guru
     */
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

    /**
     * Hapus guru
     */
    public function destroy(Guru $guru)
    {
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}