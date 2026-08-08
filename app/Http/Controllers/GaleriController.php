<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\GaleriKategori;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with(['kategori', 'kegiatan'])
            ->orderBy('tanggal', 'desc')
            ->paginate(12);

        return view('galeri.index', compact('galeri'));
    }

    public function create()
    {
        $kategoris = GaleriKategori::orderBy('nama_kategori')->get();
        $kegiatans = Kegiatan::orderBy('tanggal_mulai', 'desc')->get();

        return view('galeri.create', compact('kategoris', 'kegiatans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['file'] = $request->file('file')->store('galeri', 'public');
        $validated['diunggah_oleh'] = auth()->id();

        Galeri::create($validated);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Galeri $galeri)
    {
        $galeri->load(['kategori', 'kegiatan', 'pengunggah']);

        return view('galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        $kategoris = GaleriKategori::orderBy('nama_kategori')->get();
        $kegiatans = Kegiatan::orderBy('tanggal_mulai', 'desc')->get();

        return view('galeri.edit', compact('galeri', 'kategoris', 'kegiatans'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $this->validateData($request, $galeri->id, false);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($galeri->file);
            $validated['file'] = $request->file('file')->store('galeri', 'public');
        }

        $galeri->update($validated);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->file);
        $galeri->delete();

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null, bool $fileRequired = true): array
    {
        return $request->validate([
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'nullable|string',
            'file'                => ($fileRequired ? 'required' : 'nullable') . '|file|mimes:jpg,jpeg,png,webp,mp4,mov|max:20480',
            'tipe'                => 'required|in:foto,video',
            'galeri_kategori_id'  => 'nullable|exists:galeri_kategoris,id',
            'kegiatan_id'         => 'nullable|exists:kegiatans,id',
            'tanggal'             => 'required|date',
        ]);
    }
}