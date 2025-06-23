@extends('blocks/header')

@section('content')
    <div class="hero">
        <h1>Создай и поделись своим вишлистом</h1>
        <p>Получай подарки, которые действительно хочешь.
            <a href="{{-- route('create_wishlist') --}}" class="btn">Создать вишлист</a>
        </p>
    </div>

    <div class="features">
        <div class="feature">
            <h2>Для создателей</h2>
            <p>Создавать вишлист легко и весело.</p>
            <ul>
                <li><strong>Создай</strong> свой персональный вишлист.</li>
                <li><strong>Поделись</strong> им с друзьями и семьей.</li>
                <li><strong>Получи</strong> подарки, которые ты всегда хотел.</li>
            </ul>
        </div>
        <div class="feature">
            <h2>Для дарителей</h2>
            <p>Найди идеальный подарок без лишних усилий.</p>
            <ul>
                <li><strong>Выбери</strong> подарок из вишлиста и забронируй его.</li>
                <li><strong>Задай вопрос</strong>, если нужно уточнить детали.</li>
                <li><strong>Купи</strong> подарок и сделай кого-то счастливым.</li>
            </ul>
        </div>
    </div>
@endsection
