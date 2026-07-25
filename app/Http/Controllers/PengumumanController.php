<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $pengumuman = Pengumuman::when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                      ->orWhere('isi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'   => 'required',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        // Status otomatis aktif
        $data['status'] = true;

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
            'judul'   => 'required',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {

            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diubah');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
    public function toggleStatus(Pengumuman $pengumuman)
{
    $pengumuman->status = !$pengumuman->status;
    $pengumuman->save();

    return redirect()->route('pengumuman.index')
        ->with('success', 'Status pengumuman berhasil diperbarui.');
}
}