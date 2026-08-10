<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaPresensiController extends Controller
{
    public function store(Request $request)
    {
        $pengurus = Auth::user()->pengurus;

        if (! $pengurus) {
            return redirect()
                ->route('anggota.dashboard')
                ->with('error', 'Akun Anda belum terhubung ke data pengurus.');
        }

        $validated = $request->validate([
            'presentable_type' => 'required|string',
            'presentable_id'   => 'required|integer',
            'status'           => 'required|in:hadir,izin,sakit',
            'foto'             => 'required|image|max:2048',
            'keterangan'       => 'nullable|string',
        ]);

        $allowedTypes = [
            \App\Models\JadwalImamMuazin::class,
            \App\Models\JadwalBilal::class,
            \App\Models\JadwalPiketKebersihan::class,
            \App\Models\Kegiatan::class,
        ];

        if (! in_array($validated['presentable_type'], $allowedTypes)) {
            abort(422, 'Jenis tugas tidak valid.');
        }

        $validated['foto'] = $request->file('foto')->store('presensi', 'public');
        $validated['pengurus_id'] = $pengurus->id;
        $validated['tanggal'] = now()->toDateString();
        $validated['waktu_presensi'] = now()->format('H:i');
        $validated['metode'] = 'self';

        Presensi::create($validated);

        return redirect()
            ->route('anggota.dashboard')
            ->with('success', 'Presensi berhasil dicatat.');
    }
}