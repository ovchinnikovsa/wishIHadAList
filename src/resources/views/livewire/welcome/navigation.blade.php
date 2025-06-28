<nav class="menu">
    @auth
        <a href="{{ url('/dashboard') }}">
            {{ __('Мой вишлист') }}
        </a>
        <a href="{{ url('/dashboard') }}">
            {{ __('Мой вишлист') }}
        </a>
        <a href="{{ url('/dashboard') }}">
            {{ __('Мой вишлист') }}
        </a>
    @else
        <a href="{{ route('login') }}">
            {{ __('Войти') }}
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}">
                {{ __('Зарегистироваться') }}
            </a>
        @endif
    @endauth
</nav>
