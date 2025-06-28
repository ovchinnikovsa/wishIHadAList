<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
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
    <x-auth-session-status class="success form-group" :status="session('status')"/>

    <form wire:submit="login">
        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input wire:model="form.email" id="email" type="email" name="email" required autofocus
                          autocomplete="username"/>
            <x-input-error :messages="$errors->get('form.email')" class="error"/>
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input wire:model="form.password" id="password"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('form.password')" class="error"/>
        </div>

        <div class="form-group">
            <a href="{{ route('google.login') }}" class="social-button google">
                Войти через Google
            </a>
            <a href="{{ route('yandex.login') }}" class="social-button yandex">
                Войти через Яндекс
            </a>
            <a href="{{ route('vk.login') }}" class="social-button vk">
                Войти через VK
            </a>
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <label for="remember">
                <input wire:model="form.remember" id="remember" type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
            <!-- Actions -->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="link">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="form-group">
            <x-primary-button class="btn-primary">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
