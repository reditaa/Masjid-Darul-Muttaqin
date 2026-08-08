<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ringkasan Keuangan
            </h2>
            <a href="{{ route('keuangan.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Transaksi
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-600">
                    <p class="text-gray-500 text-sm">Saldo Saat Ini</p>
                    <h3 class="text-2xl font-bold mt-1 {{ $saldo >= 0 ? 'text-green-700' : 'text-red-600' }}">
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-blue-600">
                    <p class="text-gray-500 text-sm">Pemasukan Bulan Ini</p>
                    <h3 class="text-2xl font-bold mt-1 text-blue-700">
                        Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-red-500">
                    <p class="text-gray-500 text-sm">Pengeluaran Bulan Ini</p>
                    <h3 class="text-2xl font-bold mt-1 text-red-600">
                        Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                    </h3>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($transaksi as $item)
                            <tr>
                                <td class="px-6 py-4">{{ $item->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-4">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $item->jenis === 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($item->jenis) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-medium {{ $item->jenis === 'pemasukan' ? 'text-green-700' : 'text-red-600' }}">
                                    {{ $item->jenis === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('keuangan.show', $item) }}"
                                           title="Lihat"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('keuangan.edit', $item) }}"
                                           title="Edit"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('keuangan.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus"
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    Belum ada transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $transaksi->links() }}
            </div>

        </div>
    </div>
</x-app-layout>