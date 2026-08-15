<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengurus::with('jabatan');

        if ($request->filled('asal')) {
            $query->where('asal', $request->asal);
        }

        $pengurus = $query->orderBy('jabatan_id')
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        return view('pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        $jabatans = Jabatan::orderBy('urutan')->get();

        return view('pengurus.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        Pengurus::create($validated);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        $pengurus->load('jabatan');

        return view('pengurus.show', compact('pengurus'));
    }

    public function edit(Pengurus $pengurus)
    {
        $jabatans = Jabatan::orderBy('urutan')->get();

        return view('pengurus.edit', compact('pengurus', 'jabatans'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $this->validateData($request, $pengurus->id);

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update($validated);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus.');
    }

    public function buatAkun(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = \App\Models\User::create([
            'name'     => $pengurus->nama,
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role'     => 'anggota',
        ]);

        $pengurus->update(['user_id' => $user->id]);

        return redirect()
            ->route('pengurus.edit', $pengurus)
            ->with('success', 'Akun login berhasil dibuat untuk ' . $pengurus->nama . '.');
    }

    public function hapusAkun(Pengurus $pengurus)
    {
        if ($pengurus->user_id) {
            \App\Models\User::destroy($pengurus->user_id);
            $pengurus->update(['user_id' => null]);
        }

        return redirect()
            ->route('pengurus.edit', $pengurus)
            ->with('success', 'Akun login berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'jabatan_id'       => 'nullable|exists:jabatans,id',
            'asal'             => 'nullable|in:guru,siswa,umum',
            'nama'             => 'required|string|max:255',
            'nik'              => 'nullable|string|max:20',
            'jenis_kelamin'    => 'required|in:L,P',
            'tempat_lahir'     => 'nullable|string|max:255',
            'tanggal_lahir'    => 'nullable|date',
            'no_hp'            => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:255',
            'alamat'           => 'nullable|string',
            'foto'             => 'nullable|image|max:2048',
            'bio'              => 'nullable|string',
            'periode_mulai'    => 'nullable|date',
            'periode_selesai'  => 'nullable|date|after_or_equal:periode_mulai',
            'status'           => 'required|in:aktif,nonaktif',
        ]);
    }
}