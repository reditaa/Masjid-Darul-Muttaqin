<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $pengurus = Pengurus::with([
            'anggota.guru',
            'anggota.siswa'
        ])
        ->when($search, function ($query) use ($search) {
            $query->where('jabatan', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

        return view('pengurus.index', compact('pengurus', 'search'));
    }

public function create()
{
    $anggota = Anggota::with(['guru','siswa'])->get();

    return view('pengurus.create', [
        'anggota' => $anggota
    ]);
}
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jabatan' => 'required',
            'mulai_jabatan' => 'required|date',
            'selesai_jabatan' => 'nullable|date',
            'status' => 'required',
        ]);


        Pengurus::create([
            'anggota_id' => $request->anggota_id,
            'jabatan' => $request->jabatan,
            'mulai_jabatan' => $request->mulai_jabatan,
            'selesai_jabatan' => $request->selesai_jabatan,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('pengurus.index')
            ->with('success','Data pengurus berhasil ditambahkan.');
    }


    public function edit(Pengurus $penguru)
    {
        $anggota = Anggota::with(['guru','siswa'])->get();

        return view('pengurus.edit', compact(
            'penguru',
            'anggota'
        ));
    }


    public function update(Request $request, Pengurus $penguru)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jabatan' => 'required',
            'mulai_jabatan' => 'required|date',
            'selesai_jabatan' => 'nullable|date',
            'status' => 'required',
        ]);


        $penguru->update([
            'anggota_id' => $request->anggota_id,
            'jabatan' => $request->jabatan,
            'mulai_jabatan' => $request->mulai_jabatan,
            'selesai_jabatan' => $request->selesai_jabatan,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('pengurus.index')
            ->with('success','Data pengurus berhasil diubah.');
    }


    public function destroy(Pengurus $penguru)
    {
        $penguru->delete();

        return redirect()
            ->route('pengurus.index')
            ->with('success','Data pengurus berhasil dihapus.');
    }
}