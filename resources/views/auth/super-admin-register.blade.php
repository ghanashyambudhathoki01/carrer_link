<x-guest-layout>
    <x-slot name="title">Super Admin Registration</x-slot>

    <div class="text-center mb-8">
        <h1 class="text-2xl font-black text-gray-900">Super Admin <span class="text-purple-600">Access</span></h1>
        <p class="text-sm text-gray-500 font-medium mt-2">Create your master administrative account</p>
    </div>

    <form method="POST" action="{{ route('super-admin.register.post') }}">
        @csrf

        <div class="space-y-4">
            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Email --}}
            <div class="mt-4">
                <x-input-label for="email" :value="__('Work Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Confirm Password --}}
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 bg-purple-600 hover:bg-purple-700">
                    {{ __('Initialize') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
