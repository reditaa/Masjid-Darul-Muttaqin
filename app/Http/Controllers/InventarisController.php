<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::orderBy('nama_barang')->paginate(15);

        return view('inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        return view('inventaris.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if (empty($validated['kode_inventaris'])) {
            $validated['kode_inventaris'] = 'INV-' . strtoupper(Str::random(8));
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('inventaris', 'public');
        }

        Inventaris::create($validated);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function show(Inventaris $inventaris)
    {
        return view('inventaris.show', compact('inventaris'));
    }

    public function edit(Inventaris $inventaris)
    {
        return view('inventaris.edit', compact('inventaris'));
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $validated = $this->validateData($request, $inventaris->id);

        if ($request->hasFile('foto')) {
            if ($inventaris->foto) {
                Storage::disk('public')->delete($inventaris->foto);
            }
            $validated['foto'] = $request->file('foto')->store('inventaris', 'public');
        }

        $inventaris->update($validated);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventaris)
    {
        if ($inventaris->foto) {
            Storage::disk('public')->delete($inventaris->foto);
        }

        $inventaris->delete();

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $kodeRule = 'nullable|string|max:50|unique:inventaris,kode_inventaris';
        if ($ignoreId) {
            $kodeRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'kode_inventaris'     => $kodeRule,
            'nama_barang'         => 'required|string|max:255',
            'kategori'            => 'required|in:elektronik,mebel,perlengkapan_ibadah,kebersihan,dokumen,lainnya',
            'jumlah'              => 'required|integer|min:1',
            'satuan'              => 'required|string|max:50',
            'kondisi'             => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'lokasi_penyimpanan'  => 'nullable|string|max:255',
            'tanggal_perolehan'   => 'nullable|date',
            'sumber_perolehan'    => 'required|in:pembelian,donasi,hibah,lainnya',
            'harga_perolehan'     => 'nullable|numeric|min:0|max:9999999999999.99',
            'foto'                => 'nullable|image|max:2048',
            'keterangan'          => 'nullable|string',
        ]);
    }
}