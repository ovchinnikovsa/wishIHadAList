<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="error"/>
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input wire:model="email" id="email" type="email" name="email" required autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="error"/>
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input wire:model="password" id="password" type="password" name="password" required
                          autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password')" class="error"/>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
            <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password"
                          name="password_confirmation" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="error"/>
        </div>

        <div class="form-group">

            <x-primary-button class="btn-primary">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
