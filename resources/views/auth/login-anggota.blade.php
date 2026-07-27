<x-guest-layout>

    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold">
            Login Anggota
        </h2>

        <p class="text-gray-500">
            Login menggunakan NIP atau NIS
        </p>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('anggota.login.store') }}">
        @csrf

        <div>
            <x-input-label for="username" value="NIP / NIS" />

            <x-text-input
                id="username"
                class="block mt-1 w-full"
                type="text"
                name="username"
                required
                autofocus
            />

            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                Login Anggota
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>