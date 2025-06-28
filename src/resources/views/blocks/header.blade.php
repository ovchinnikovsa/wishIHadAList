<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">
    <link rel="icon" href="icons/light.ico" type="image/x-icon">
    <link rel="icon" href="icons/dark.ico" media="(prefers-color-scheme: dark)" type="image/x-icon">
    @vite(['resources/css/app.css'])
{{--    @vite(['resources/js/app.js'])--}}
</head>
<body class="{{ false ? 'light-theme' : 'dark-theme' }}">
<header class="header">
    <div class="container container-center">
        <div class="logo">
            <span class="main">WISH</span> <span class="special">i had a</span> <span class="main">LIST</span>
        </div>
    </div>
    <div class="container container-center">
        @if (Route::has('login'))
            <livewire:welcome.navigation/>
        @endif
    </div>
</header>
<main class="content">
    @yield('content')
</main>
<footer class="footer">
    <p>Created by <strong>ovchie</strong> | Contact: <a href="mailto:example@example.com">example@example.com</a> | <a
            href="#">❤️Donate❤️</a></p>
</footer>
</body>
</html>
