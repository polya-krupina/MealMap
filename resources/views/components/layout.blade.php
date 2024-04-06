<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/parent-left-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/parent-child-info.css') }}">
    <title>MealMap</title>
</head>
<body>
    <nav id="menu">
        <a href="/" class="logo"><img src="{{ asset('img/whiteLogo.svg') }}" width="148px" height="25px"></a>
        <p class="kindergarten-name">Маленький Гений</p>
        <span id="my-children">Мои дети</span>
        <ul class="children">
            <hr></hr>
            @foreach($kids as $kid)
            <li class="child-button">
                <a href="/kids/{{ $kid->id }}" class="child"><img src="{{ asset('img/empty.jpg') }}" width="28px" height="28px">{{ $kid->name }}</a>
                <a href="/kids/{{ $kid->id }}/allergies" class="edit-child"><img src="{{ asset('img/edit.svg') }}"></a>
            </li>
            <hr></hr>
            @endforeach
        </ul>
        <ul class="buttons">
            <hr></hr><li><a href="/dishes" class="button" width="22" height="21"><img src="{{ asset('img/monthly menu.svg') }}"><span>Меню на месяц</span></a></li>
            <hr></hr><li><a href="#" class="button"><img src="{{ asset('img/my templates.svg') }}"><span>Мои шаблоны</span></a></li>
            <hr></hr><li><a href="#" class="button"><img src="{{ asset('img/payment.svg') }}"><span>Оплата</span></a></li>
            <hr></hr><li><a href="/logout" class="button"><img src="{{ asset('img/exit.svg') }}"><span>Выход</span></a></li>
        </ul>
    </nav>

    <section {{ $attributes(['class' => '']) }}>
        {{ $slot }}
    </section>
</body>
</html>