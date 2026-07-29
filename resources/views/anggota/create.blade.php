<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Anggota
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('anggota.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="block font-semibold mb-2">
                            Jenis Anggota
                        </label>

                        <select
                            id="jenis"
                            name="jenis"
                            class="w-full border rounded p-2"
                            required>

                            <option value="">-- Pilih --</option>
                            <option value="Guru">Guru</option>
                            <option value="Siswa">Siswa</option>

                        </select>

                    </div>

                    <div
                        id="guruBox"
                        class="mb-4"
                        style="display:none;">

                        <label class="block font-semibold mb-2">
                            Pilih Guru
                        </label>

                        <select
                            name="guru_id"
                            class="w-full border rounded p-2">

                            <option value="">-- Pilih Guru --</option>

                            @foreach($gurus as $guru)

                                <option value="{{ $guru->id }}">
                                    {{ $guru->nip }} - {{ $guru->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div
                        id="siswaBox"
                        class="mb-4"
                        style="display:none;">

                        <label class="block font-semibold mb-2">
                            Pilih Siswa
                        </label>

                        <select
                            name="siswa_id"
                            class="w-full border rounded p-2">

                            <option value="">-- Pilih Siswa --</option>

                            @foreach($siswas as $siswa)

                                <option value="{{ $siswa->id }}">
                                    {{ $siswa->nis }} - {{ $siswa->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                        Simpan

                    </button>

                    <a
                        href="{{ route('anggota.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                        Kembali

                    </a>

                </form>

            </div>

        </div>
    </div>

    <script>

        const jenis = document.getElementById('jenis');
        const guruBox = document.getElementById('guruBox');
        const siswaBox = document.getElementById('siswaBox');

        jenis.addEventListener('change', function(){

            guruBox.style.display='none';
            siswaBox.style.display='none';

            if(this.value=='Guru'){
                guruBox.style.display='block';
            }

            if(this.value=='Siswa'){
                siswaBox.style.display='block';
            }

        });

    </script>

</x-app-layout>