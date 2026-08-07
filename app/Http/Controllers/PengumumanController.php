<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest('tanggal_publish')->paginate(10);

        return view('pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        Pengumuman::create($validated);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Pengumuman $pengumuman)
    {
        $pengumuman->tambahDilihat();

        return view('pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $this->validateData($request, $pengumuman->id);

        if ($request->hasFile('gambar')) {
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        $pengumuman->update($validated);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function toggleStatus(Pengumuman $pengumuman)
    {
        $pengumuman->update([
            'status' => $pengumuman->status === 'published' ? 'arsip' : 'published',
        ]);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Status pengumuman berhasil diubah.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'judul'             => 'required|string|max:255',
            'isi'               => 'required|string',
            'kategori'          => 'required|in:umum,kegiatan,keuangan,sosial,lainnya',
            'gambar'            => 'nullable|image|max:2048',
            'tanggal_publish'   => 'required|date',
            'tanggal_berakhir'  => 'nullable|date|after_or_equal:tanggal_publish',
            'status'            => 'required|in:draft,published,arsip',
        ]);
    }
}