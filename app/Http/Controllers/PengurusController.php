<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::latest()->get();
        return view('pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('pengurus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable',
            'mulai_jabatan' => 'required',
            'selesai_jabatan' => 'required',
            'status' => 'required',
        ]);

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
            'nama' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable',
            'mulai_jabatan' => 'required',
            'selesai_jabatan' => 'required',
            'status' => 'required',
        ]);

        $penguru->update($data);

        return redirect()->route('pengurus.index')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy(Pengurus $penguru)
    {
        $penguru->delete();

        return redirect()->route('pengurus.index')
            ->with('success', 'Data berhasil dihapus');
    }
}