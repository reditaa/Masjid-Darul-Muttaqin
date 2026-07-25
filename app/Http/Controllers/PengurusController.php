<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    $pengurus = Pengurus::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

    return view('pengurus.index', compact('pengurus', 'search'));
}

    public function create()
    {
        return view('pengurus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable',
            'mulai_jabatan' => 'required',
            'selesai_jabatan' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        Pengurus::create($data);

        return redirect()->route('pengurus.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Pengurus $penguru)
    {
        return view('pengurus.edit', compact('penguru'));
    }

    public function update(Request $request, Pengurus $penguru)
    {
        $data = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable',
            'mulai_jabatan' => 'required',
            'selesai_jabatan' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($penguru->foto && Storage::disk('public')->exists($penguru->foto)) {
                Storage::disk('public')->delete($penguru->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $penguru->update($data);

        return redirect()->route('pengurus.index')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy(Pengurus $penguru)
    {
        // Hapus foto
        if ($penguru->foto && Storage::disk('public')->exists($penguru->foto)) {
            Storage::disk('public')->delete($penguru->foto);
        }

        $penguru->delete();

        return redirect()->route('pengurus.index')
            ->with('success', 'Data berhasil dihapus');
    }
}