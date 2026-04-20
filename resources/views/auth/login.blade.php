<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center text-green-700 font-medium" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />

            <x-text-input id="email"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600 shadow-sm"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />

            <x-text-input id="password"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600 shadow-sm"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-green-600 focus:ring-green-500 shadow-sm" name="remember">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-green-700 hover:text-green-900 underline" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Button -->
        <div>
            <x-primary-button
                class="w-full justify-center bg-green-700 hover:bg-green-800 focus:bg-green-800 active:bg-green-900 rounded-lg py-2 text-sm font-semibold">
                Log in
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>