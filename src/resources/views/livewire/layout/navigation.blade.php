<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav class="menu" x-data="{ open: false }">

    @guest
        <a href="{{ route('login') }}">{{ __('Вход') }}</a>
        <a href="{{ route('register') }}">{{ __('Регистрация') }}</a>
    {{--            @auth--}}
    @else
    <x-nav-link :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
                wire:navigate>
        Мой вишлист
    </x-nav-link>

    <a href="">Избранное</a>

    <x-nav-link :href="route('profile')"
                :active="request()->routeIs('profile')"
                wire:navigate>
        Настройки
    </x-nav-link>
    <a wire:click="logout">Выход</a>
    @endguest
</nav>
