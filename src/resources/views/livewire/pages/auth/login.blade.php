<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 gap-4 mt-6">
            <a href="{{ route('google.login') }}"
               class="flex items-center justify-center px-4 py-2 text-white rounded-md">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                    <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                </svg>
                Войти через Google
            </a>
            <a href="{{ route('yandex.login') }}"
               class="flex items-center justify-center px-4 py-2 bg-black text-white rounded-md">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 0a12 12 0 100 24 12 12 0 000-24zm5.56 17.68c-1.34.54-2.9.8-4.56.8-1.67 0-3.22-.26-4.56-.8l-1.3-5.44c1.34.6 2.88.9 4.56.9 1.7 0 3.24-.3 4.56-.9l-1.3 5.44zm-1.3-9.9c-1.32.6-2.86.9-4.56.9-1.68 0-3.22-.3-4.56-.9l-1.3-5.46C5.78 3.26 7.44 3 9.1 3c1.66 0 3.22.26 4.56.8l-1.3 5.44zm-1.3-7.36c-1.34.54-2.9.8-4.56.8-1.67 0-3.22-.26-4.56-.8L4.1 4.22c1.34.6 2.88.9 4.56.9 1.7 0 3.24-.3 4.56-.9l1.3-5.44z"/>
                </svg>
                Войти через Яндекс
            </a>
            <a href="{{ route('vk.login') }}"
               class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 0a12 12 0 100 24 12 12 0 000-24zm6 16.7c-.2.5-.7.8-1.2.8h-2c-.4 0-.7-.2-1-.4-.3-.3-.4-.6-.5-1-.2-.5-.4-1.1-.6-1.6-.2-.5-.4-.7-.7-.7-.2 0-.4 0-.6.3l-.6.7c-.3.4-.7.7-1 .8-.4.2-.7.2-1.1 0-1.8-.7-3-2.2-3.5-4.3-.2-.7 0-1.3.4-1.7.3-.4.8-.6 1.3-.6h2c.4 0 .7.2.8.6.3.8.6 1.6 1 2.4.2.4.5.6.9.6.2 0 .4-.1.6-.3.4-.4.8-.8 1.1-1.1.4-.4.7-.7 1.1-.8.4-.2.8-.2 1.1 0 .3.2.5.4.6.7.2.3.2.7 0 1l-1.3 2.5c-.2.4-.1.8.1 1.1.2.3.5.4.9.4.4 0 .7-.1 1-.3.3-.2.6-.5.8-.8.3-.4.7-.8 1.1-1.2.2-.3.5-.5.8-.6.3-.1.6-.1.9 0 .3.1.5.3.6.6.1.3.1.6 0 .9l-.7 2.4z"/>
                </svg>
                Войти через VK
            </a>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
