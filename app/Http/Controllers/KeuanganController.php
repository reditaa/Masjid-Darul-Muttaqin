<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KategoriTransaksi;
use App\Models\TransaksiKeuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiKeuangan::with('kategori')
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        $totalPemasukan = TransaksiKeuangan::pemasukan()->sum('jumlah');
        $totalPengeluaran = TransaksiKeuangan::pengeluaran()->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pemasukanBulanIni = TransaksiKeuangan::pemasukan()->bulanIni()->sum('jumlah');
        $pengeluaranBulanIni = TransaksiKeuangan::pengeluaran()->bulanIni()->sum('jumlah');

        return view('keuangan.index', compact(
            'transaksi',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'pemasukanBulanIni',
            'pengeluaranBulanIni'
        ));
    }

    public function create()
    {
        $kategoris = KategoriTransaksi::orderBy('nama_kategori')->get();
        $kegiatans = Kegiatan::orderBy('tanggal_mulai', 'desc')->get();

        return view('keuangan.create', compact('kategoris', 'kegiatans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('keuangan', 'public');
        }

        $validated['dicatat_oleh'] = auth()->id();

        TransaksiKeuangan::create($validated);

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(TransaksiKeuangan $keuangan)
    {
        $keuangan->load(['kategori', 'pencatat', 'kegiatan']);

        return view('keuangan.show', ['transaksi' => $keuangan]);
    }

    public function edit(TransaksiKeuangan $keuangan)
    {
        $kategoris = KategoriTransaksi::orderBy('nama_kategori')->get();
        $kegiatans = Kegiatan::orderBy('tanggal_mulai', 'desc')->get();

        return view('keuangan.edit', ['transaksi' => $keuangan, 'kategoris' => $kategoris, 'kegiatans' => $kegiatans]);
    }

    public function update(Request $request, TransaksiKeuangan $keuangan)
    {
        $validated = $this->validateData($request, $keuangan->id);

        if ($request->hasFile('bukti')) {
            if ($keuangan->bukti) {
                \Storage::disk('public')->delete($keuangan->bukti);
            }
            $validated['bukti'] = $request->file('bukti')->store('keuangan', 'public');
        }

        $keuangan->update($validated);

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(TransaksiKeuangan $keuangan)
    {
        if ($keuangan->bukti) {
            \Storage::disk('public')->delete($keuangan->bukti);
        }

        $keuangan->delete();

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'kategori_transaksi_id' => 'required|exists:kategori_transaksis,id',
            'jenis'                 => 'required|in:pemasukan,pengeluaran',
            'tanggal'               => 'required|date',
            'jumlah'                => 'required|numeric|min:0|max:9999999999999.99',
            'sumber_tujuan'         => 'nullable|string|max:255',
            'keterangan'            => 'nullable|string',
            'bukti'                 => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'kegiatan_id'           => 'nullable|exists:kegiatans,id',
        ]);
    }
}