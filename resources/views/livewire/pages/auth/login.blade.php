<?php

use function Livewire\Volt\{state, rules, mount};
use App\Providers\RouteServiceProvider;

state([
    'email' => '',
    'password' => '',
    'remember' => false,
]);

rules([
    'email' => ['required', 'string', 'email'],
    'password' => ['required', 'string'],
]);

$authenticate = function () {
    $this->validate();

    if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    throw ValidationException::withMessages([
        'email' => __('auth.failed'),
    ]);
};

?>

<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="max-w-md w-full space-y-8 p-8 bg-gray-800 rounded-lg shadow-xl">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-white">
                Giriş Yap
            </h2>
        </div>

        <form wire:submit.prevent="authenticate" class="mt-8 space-y-6">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-200" />
                <x-text-input wire:model="email" id="email"
                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm text-white placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-200" />
                <x-text-input wire:model="password" id="password"
                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm text-white placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember" class="flex items-center">
                    <input wire:model="remember" id="remember" type="checkbox"
                        class="h-4 w-4 bg-gray-700 border-gray-600 text-blue-600 focus:ring-blue-500 rounded">
                    <span class="ml-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-400 hover:text-blue-300" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-blue-500">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</div>
