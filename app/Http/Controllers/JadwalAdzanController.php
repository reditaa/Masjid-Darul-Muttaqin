<?php

namespace App\Http\Controllers;

use App\Models\JadwalAdzan;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalAdzanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $jadwalAdzan = JadwalAdzan::with([
            'dzuhurImam',
            'dzuhurMuadzin',
            'asharImam',
            'asharMuadzin'
        ])
        ->when($search, function ($query) use ($search) {
            $query->whereHas('dzuhurImam', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })
            ->orWhereHas('dzuhurMuadzin', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })
            ->orWhereHas('asharImam', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })
            ->orWhereHas('asharMuadzin', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(5)
        ->withQueryString();

        return view('jadwal-adzan.index', compact('jadwalAdzan'));
    }

    public function create()
    {
        $pengurus = Pengurus::where('status', 'Aktif')->get();

        return view('jadwal-adzan.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'dzuhur_imam_id' => 'required|exists:pengurus,id',
            'dzuhur_muadzin_id' => 'required|exists:pengurus,id',
            'ashar_imam_id' => 'required|exists:pengurus,id',
            'ashar_muadzin_id' => 'required|exists:pengurus,id',
            'keterangan' => 'nullable',
        ]);

        JadwalAdzan::create($data);

        return redirect()->route('jadwal-adzan.index')
            ->with('success', 'Jadwal adzan berhasil ditambahkan.');
    }

    public function show(JadwalAdzan $jadwalAdzan)
    {
        return redirect()->route('jadwal-adzan.index');
    }

    public function edit(JadwalAdzan $jadwalAdzan)
    {
        $pengurus = Pengurus::where('status', 'Aktif')->get();

        return view('jadwal-adzan.edit', compact('jadwalAdzan', 'pengurus'));
    }

    public function update(Request $request, JadwalAdzan $jadwalAdzan)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'dzuhur_imam_id' => 'required|exists:pengurus,id',
            'dzuhur_muadzin_id' => 'required|exists:pengurus,id',
            'ashar_imam_id' => 'required|exists:pengurus,id',
            'ashar_muadzin_id' => 'required|exists:pengurus,id',
            'keterangan' => 'nullable',
        ]);

        $jadwalAdzan->update($data);

        return redirect()->route('jadwal-adzan.index')
            ->with('success', 'Jadwal adzan berhasil diperbarui.');
    }

    public function destroy(JadwalAdzan $jadwalAdzan)
    {
        $jadwalAdzan->delete();

        return redirect()->route('jadwal-adzan.index')
            ->with('success', 'Jadwal adzan berhasil dihapus.');
    }
}