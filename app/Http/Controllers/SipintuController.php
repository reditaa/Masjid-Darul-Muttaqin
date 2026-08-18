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
            $siswaList = $siswa['data']['data']['data'] ?? $siswa['data']['data'] ?? $siswa['data'] ?? [];
            if (is_array($siswaList)) {
                foreach ($siswaList as $item) {
                    $nama = $item['nama'] ?? $item['name'] ?? '-';
                    $nik = $item['nis'] ?? $item['nisn'] ?? '-';
                    $hasil[] = [
                        'nama'  => $nama,
                        'nik'   => $nik,
                        'asal'  => 'siswa',
                        'label' => $nama . ' — Siswa (NIS: ' . $nik . ')',
                    ];
                }
            }
        }

        if ($guru['success']) {
            $guruList = $guru['data']['data']['data'] ?? $guru['data']['data'] ?? $guru['data'] ?? [];
            if (is_array($guruList)) {
                foreach ($guruList as $item) {
                    $nama = $item['nama'] ?? $item['name'] ?? '-';
                    $nik = $item['nip'] ?? '-';
                    $hasil[] = [
                        'nama'  => $nama,
                        'nik'   => $nik,
                        'asal'  => 'guru',
                        'label' => $nama . ' — Guru (NIP: ' . $nik . ')',
                    ];
                }
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

    public function dataIndex(Request $request)
    {
        $query = Pengurus::whereIn('asal', ['guru', 'siswa']);

        if ($request->filled('asal') && in_array($request->asal, ['guru', 'siswa'])) {
            $query->where('asal', $request->asal);
        }

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        $dataSipintu = $query->orderBy('asal')
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        $totalGuru = Pengurus::where('asal', 'guru')->count();
        $totalSiswa = Pengurus::where('asal', 'siswa')->count();

        return view('sipintu.index', compact('dataSipintu', 'totalGuru', 'totalSiswa'));
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