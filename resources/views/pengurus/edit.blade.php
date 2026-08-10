<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pengurus — {{ $pengurus->nama }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pengurus.update', $pengurus) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                  <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jabatan (opsional)</label>
                            <select name="jabatan_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">-- Bukan Pengurus Struktural --</option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" {{ old('jabatan_id', $pengurus->jabatan_id) == $jabatan->id ? 'selected' : '' }}>
                                        {{ $jabatan->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Asal</label>
                            <select name="asal" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">-- Pilih Asal --</option>
                                <option value="guru" {{ old('asal', $pengurus->asal) == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="siswa" {{ old('asal', $pengurus->asal) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="umum" {{ old('asal', $pengurus->asal) == 'umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $pengurus->nama) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik', $pengurus->nik) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="L" {{ old('jenis_kelamin', $pengurus->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $pengurus->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pengurus->tempat_lahir) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', $pengurus->tanggal_lahir?->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $pengurus->no_hp) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $pengurus->email) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="2" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('alamat', $pengurus->alamat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto</label>
                        @if ($pengurus->foto)
                            <img src="{{ Storage::url($pengurus->foto) }}" class="w-16 h-16 rounded-full object-cover mb-2">
                        @endif
                        <input type="file" name="foto" accept="image/*" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan kalau tidak ingin mengganti foto.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bio Singkat</label>
                        <textarea name="bio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('bio', $pengurus->bio) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Periode Mulai</label>
                            <input type="date" name="periode_mulai"
                                   value="{{ old('periode_mulai', $pengurus->periode_mulai?->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Periode Selesai</label>
                            <input type="date" name="periode_selesai"
                                   value="{{ old('periode_selesai', $pengurus->periode_selesai?->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="aktif" {{ old('status', $pengurus->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $pengurus->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                   <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pengurus.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>

                </form>

                <div class="mt-8 pt-6 border-t">
                    <h3 class="font-semibold text-gray-800 mb-3">Akun Login</h3>

                    @if ($pengurus->user_id)
                        <div class="flex items-center justify-between bg-green-50 p-4 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Sudah punya akun login
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $pengurus->user->email ?? '-' }}</p>
                            </div>
                            <form action="{{ route('pengurus.hapusAkun', $pengurus) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus akun login ini? Pengurus tidak akan bisa login lagi.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg text-sm hover:bg-red-200">
                                    Hapus Akun
                                </button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('pengurus.buatAkun', $pengurus) }}" method="POST" class="space-y-3">
                            @csrf
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700">Email Login</label>
                                    <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md text-sm" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700">Password</label>
                                    <input type="text" name="password" class="mt-1 block w-full border-gray-300 rounded-md text-sm"
                                           minlength="8" required>
                                </div>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">
                                <i class="fas fa-user-plus mr-1"></i> Buatkan Akun Login
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>