<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Anggota
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('anggota.update',$anggota->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block font-semibold mb-2">
                            Jenis Anggota
                        </label>

                        <select
                            id="jenis"
                            name="jenis"
                            class="w-full border rounded p-2">

                            <option value="Guru"
                                {{ $anggota->jenis=='Guru' ? 'selected' : '' }}>
                                Guru
                            </option>

                            <option value="Siswa"
                                {{ $anggota->jenis=='Siswa' ? 'selected' : '' }}>
                                Siswa
                            </option>

                        </select>

                    </div>

                    <div
                        id="guruBox"
                        class="mb-4"
                        style="{{ $anggota->jenis=='Guru' ? '' : 'display:none' }}">

                        <label class="block font-semibold mb-2">
                            Pilih Guru
                        </label>

                        <select
                            name="guru_id"
                            class="w-full border rounded p-2">

                            @foreach($gurus as $guru)

                                <option
                                    value="{{ $guru->id }}"
                                    {{ $anggota->guru_id==$guru->id ? 'selected' : '' }}>

                                    {{ $guru->nip }} - {{ $guru->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div
                        id="siswaBox"
                        class="mb-4"
                        style="{{ $anggota->jenis=='Siswa' ? '' : 'display:none' }}">

                        <label class="block font-semibold mb-2">
                            Pilih Siswa
                        </label>

                        <select
                            name="siswa_id"
                            class="w-full border rounded p-2">

                            @foreach($siswas as $siswa)

                                <option
                                    value="{{ $siswa->id }}"
                                    {{ $anggota->siswa_id==$siswa->id ? 'selected' : '' }}>

                                    {{ $siswa->nis }} - {{ $siswa->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded p-2">

                            <option
                                value="Aktif"
                                {{ $anggota->status=='Aktif' ? 'selected' : '' }}>

                                Aktif

                            </option>

                            <option
                                value="Nonaktif"
                                {{ $anggota->status=='Nonaktif' ? 'selected' : '' }}>

                                Nonaktif

                            </option>

                        </select>

                    </div>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                        Update

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

        const jenis=document.getElementById('jenis');
        const guruBox=document.getElementById('guruBox');
        const siswaBox=document.getElementById('siswaBox');

        jenis.addEventListener('change',function(){

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