<?php

namespace App\Http\Controllers;

use App\Models\ProfilMasjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilMasjidController extends Controller
{
    public function edit()
    {
        $profil = ProfilMasjid::firstOrCreate(
            [],
            ['nama_masjid' => 'Masjid Darul Muttaqin']
        );

        return view('profil-masjid.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilMasjid::firstOrCreate(
            [],
            ['nama_masjid' => 'Masjid Darul Muttaqin']
        );

        $validated = $request->validate([
            'nama_masjid'     => 'required|string|max:255',
            'slogan'          => 'nullable|string|max:255',
            'deskripsi'       => 'nullable|string',
            'sejarah'         => 'nullable|string',
            'visi'            => 'nullable|string',
            'misi'            => 'nullable|string',
            'foto_hero'       => 'nullable|image|max:4096',
            'foto_utama'      => 'nullable|image|max:4096',
            'tahun_berdiri'   => 'nullable|integer|min:1900|max:' . date('Y'),
            'kapasitas_jamaah'=> 'nullable|integer|min:0',
            'alamat'          => 'nullable|string',

            'teks_statistik'          => 'nullable|string|max:255',
            'teks_pengumuman'         => 'nullable|string|max:255',
            'teks_kegiatan'           => 'nullable|string|max:255',
            'teks_jadwal_imam_muazin' => 'nullable|string|max:255',
            'teks_jadwal_jumat'       => 'nullable|string|max:255',
            'teks_jadwal_bilal'       => 'nullable|string|max:255',
            'teks_jadwal_piket'       => 'nullable|string|max:255',
            'teks_galeri'             => 'nullable|string|max:255',
            'teks_inventaris'         => 'nullable|string|max:255',

            'judul_statistik'          => 'nullable|string|max:255',
            'judul_pengumuman'         => 'nullable|string|max:255',
            'judul_kegiatan'           => 'nullable|string|max:255',
            'judul_jadwal_imam_muazin' => 'nullable|string|max:255',
            'judul_jadwal_jumat'       => 'nullable|string|max:255',
            'judul_jadwal_bilal'       => 'nullable|string|max:255',
            'judul_jadwal_piket'       => 'nullable|string|max:255',
            'judul_galeri'             => 'nullable|string|max:255',
            'judul_inventaris'         => 'nullable|string|max:255',
        ]);

        // Handle foto hero upload
        if ($request->hasFile('foto_hero')) {
            if ($profil->foto_hero) {
                Storage::disk('public')->delete($profil->foto_hero);
            }
            $validated['foto_hero'] = $request->file('foto_hero')->store('profil', 'public');
        }

        // Handle foto utama upload
        if ($request->hasFile('foto_utama')) {
            if ($profil->foto_utama) {
                Storage::disk('public')->delete($profil->foto_utama);
            }
            $validated['foto_utama'] = $request->file('foto_utama')->store('profil', 'public');
        }

        $profil->update($validated);

        return redirect()->route('profil-masjid.edit')
            ->with('success', 'Profil masjid berhasil diperbarui.');
    }
}