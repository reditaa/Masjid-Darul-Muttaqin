<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengurus
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex items-center gap-4 mb-6">
                    @if ($pengurus->foto)
                        <img src="{{ Storage::url($pengurus->foto) }}" class="w-20 h-20 rounded-full object-cover">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-200"></div>
                    @endif
                    <div>
                        <h3 class="text-lg font-semibold">{{ $pengurus->nama }}</h3>
                        <p class="text-gray-500">{{ $pengurus->jabatan->nama_jabatan ?? '-' }}</p>
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $pengurus->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($pengurus->status) }}
                        </span>
                    </div>
                </div>

                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-gray-500">NIK</dt>
                        <dd>{{ $pengurus->nik ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Jenis Kelamin</dt>
                        <dd>{{ $pengurus->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Tempat, Tanggal Lahir</dt>
                        <dd>{{ $pengurus->tempat_lahir ?? '-' }}, {{ $pengurus->tanggal_lahir?->translatedFormat('d F Y') ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">No. HP</dt>
                        <dd>{{ $pengurus->no_hp ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Email</dt>
                        <dd>{{ $pengurus->email ?? '-' }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="text-gray-500">Alamat</dt>
                        <dd>{{ $pengurus->alamat ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Periode Jabatan</dt>
                        <dd>
                            {{ $pengurus->periode_mulai?->translatedFormat('d F Y') ?? '-' }}
                            s/d
                            {{ $pengurus->periode_selesai?->translatedFormat('d F Y') ?? 'sekarang' }}
                        </dd>
                    </div>
                </dl>

                @if ($pengurus->bio)
                    <div class="mt-6">
                        <dt class="text-gray-500 text-sm mb-1">Bio</dt>
                        <dd class="text-sm">{{ $pengurus->bio }}</dd>
                    </div>
                @endif

                <div class="flex justify-end gap-2 pt-6 mt-6 border-t">
                    <a href="{{ route('pengurus.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
                    <a href="{{ route('pengurus.edit', $pengurus) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>