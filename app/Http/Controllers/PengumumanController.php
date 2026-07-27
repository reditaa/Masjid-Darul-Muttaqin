<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
        ]);

        Pengumuman::create($data);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
        ]);

        $pengumuman->update($data);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diubah');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}

