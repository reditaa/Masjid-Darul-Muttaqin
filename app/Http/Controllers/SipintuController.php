<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Services\SipintuApiService;
use Illuminate\Http\Request;

class SipintuController extends Controller
{
    public function cari(Request $request, SipintuApiService $sipintu)
    {
        $keyword = $request->query('q', '');

        if (strlen($keyword) < 3) {
            return response()->json(['results' => []]);
        }

       $siswa = $sipintu->getStudents(null, $keyword);
        $guru = $sipintu->getTeachers(null, $keyword);

        $hasil = [];

        if ($siswa['success']) {
            foreach (($siswa['data']['data'] ?? []) as $item) {
                $hasil[] = [
                    'nama'  => $item['name'] ?? $item['nama'] ?? '-',
                    'nik'   => $item['nis'] ?? '-',
                    'asal'  => 'siswa',
                    'label' => ($item['name'] ?? $item['nama'] ?? '-') . ' — Siswa (NIS: ' . ($item['nis'] ?? '-') . ')',
                ];
            }
        }

        if ($guru['success']) {
            foreach (($guru['data']['data'] ?? []) as $item) {
                $hasil[] = [
                    'nama'  => $item['name'] ?? $item['nama'] ?? '-',
                    'nik'   => $item['nip'] ?? '-',
                    'asal'  => 'guru',
                    'label' => ($item['name'] ?? $item['nama'] ?? '-') . ' — Guru (NIP: ' . ($item['nip'] ?? '-') . ')',
                ];
            }
        }
        $keywordLower = strtolower($keyword);
        $hasil = array_values(array_filter($hasil, function ($item) use ($keywordLower) {
            return str_contains(strtolower($item['nama']), $keywordLower);
        }));

        $grouped = [
            'guru'  => array_values(array_filter($hasil, fn($item) => $item['asal'] === 'guru')),
            'siswa' => array_values(array_filter($hasil, fn($item) => $item['asal'] === 'siswa')),
        ];

        return response()->json([
            'results' => $hasil,
            'grouped' => $grouped,
        ]);
    }

    public function simpanAtauAmbil(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik'  => 'nullable|string|max:20',
            'asal' => 'required|in:guru,siswa',
        ]);

        $pengurus = Pengurus::firstOrCreate(
            ['nama' => $validated['nama'], 'nik' => $validated['nik']],
            [
                'asal' => $validated['asal'],
                'jenis_kelamin' => 'L',
                'status' => 'aktif',
            ]
        );

        return response()->json(['pengurus_id' => $pengurus->id, 'nama' => $pengurus->nama]);
    }
}