<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-white p-6">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-10">

        <div class="text-center mb-6">
            <div class="mx-auto w-20 h-20 rounded-full bg-green-700 flex items-center justify-center text-white text-3xl">
                <i class="fas fa-mosque"></i>
            </div>
            <h2 class="text-3xl font-bold mt-5">Daftar Akun</h2>
            <p class="text-gray-500 mt-2">Khusus Pengurus DKM yang sudah terdaftar</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label class="font-medium">Pilih Nama Anda</label>
                <select name="pengurus_id" class="mt-2 w-full rounded-xl border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                    <option value="">-- Pilih Nama --</option>
                    @foreach ($pengurus as $p)
                        <option value="{{ $p->id }}" {{ old('pengurus_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('pengurus_id')" class="mt-2" />
                @if ($pengurus->isEmpty())
                    <p class="text-xs text-red-500 mt-2">
                        Semua data Pengurus sudah punya akun, atau belum ada data Pengurus. Hubungi admin.
                    </p>
                @endif
            </div>

            <div>
                <label class="font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-2 w-full rounded-xl border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label class="font-medium">Password</label>
                <input type="password" name="password"
                    class="mt-2 w-full rounded-xl border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label class="font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="mt-2 w-full rounded-xl border-gray-300 focus:ring-green-600 focus:border-green-600" required>
            </div>

            <button class="w-full bg-green-700 hover:bg-green-800 transition rounded-xl py-3 text-white font-bold">
                <i class="fas fa-user-plus mr-2"></i> DAFTAR
            </button>

            <p class="text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline">Login di sini</a>
            </p>

        </form>
    </div>

</div>

</x-guest-layout>