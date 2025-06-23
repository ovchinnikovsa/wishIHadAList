<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">
    <link rel="icon" href="icons/light.ico" type="image/x-icon">
    <link rel="icon" href="icons/dark.ico" media="(prefers-color-scheme: dark)" type="image/x-icon">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #F8E0E6;
            color: #1A3C34;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            background-color: #F8E0E6;
            padding: 1rem 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
        }

        .container-center {
            justify-content: center;
        }

        .logo {
            font-weight: 800;
            font-size: 2rem;
            text-transform: uppercase;
        }

        .logo .main {
            color: #1A3C34;
            text-shadow: 1px 0 0 #FFFFFF, 0 1px 0 #FFFFFF, -1px 0 0 #FFFFFF, 0 -1px 0 #FFFFFF;
        }

        .logo .special {
            font-style: italic;
            font-weight: normal;
            color: transparent;
            -webkit-text-stroke: 1px #1A3C34;
            text-transform: lowercase;
        }

        .menu {
            display: flex;
            gap: 1rem;
            padding: .5rem 0;
        }

        .menu a {
            font-weight: 400;
            font-size: 1rem;
            color: #1A3C34;
            text-decoration: none;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        .content {
            flex: 1;
            padding: 2rem;
        }

        .footer {
            background-color: #F8E0E6;
            padding: 1rem;
            text-align: center;
        }

        .footer a {
            color: #1A3C34;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        body.dark-theme {
            background-color: #242D3C;
            color: #e3cdcd;
        }

        body.dark-theme .header {
            background-color: #242D3C;
        }

        body.dark-theme .footer {
            background-color: #242D3C;
        }

        body.dark-theme .logo .main {
            color: #e3cdcd;
            text-shadow: none;
        }

        body.dark-theme .logo .special {
            color: #e3cdcd;
            -webkit-text-stroke: 0;
        }

        body.dark-theme a {
            color: #e3cdcd;
        }

        body.dark-theme .logo .special {
            font-style: italic;
            font-weight: normal;
            color: transparent;
            -webkit-text-stroke: 1px #e3cdcd;
            text-transform: lowercase;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .menu {
                margin-top: 1rem;
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body class="{{ false ? 'light-theme' : 'dark-theme' }}">
<header class="header">
    <div class="container container-center">
        <div class="logo">
            <span class="main">WISH</span> <span class="special">i had a</span> <span class="main">LIST</span>
        </div>
    </div>
    <div class="container container-center">
        <nav class="menu">
            @guest
                <a href="">Вход</a>
            @endguest
            {{--            @auth--}}
            <a href="">Мой вишлист</a>
            <a href="">Избранное</a>
            <a href="">Настройки</a>
            <a href="">Выход</a>
            {{--            @endauth--}}
        </nav>
        <nav class="menu">
            {{--            @guest--}}
            {{--                <a href="{{ route('index') }}">Вход</a>--}}
            {{--            @endguest--}}
            {{--            @auth--}}
            {{--                <a href="{{ route('wishlist') }}">Мой вишлист</a>--}}
            {{--                <a href="{{ route('favorites') }}">Избранное</a>--}}
            {{--                <a href="{{ route('settings') }}">Настройки</a>--}}
            {{--                <a href="{{ route('logout') }}">Выход</a>--}}
            {{--            @endauth--}}
        </nav>
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
