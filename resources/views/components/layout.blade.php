<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealMap</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <!-- Здесь можно добавить меню навигации -->
        </nav>
    </header>

    <main>
        <div>
            {{ $slot }}
        </div>
    </main>

    <footer>
        <!-- Здесь можно добавить футер -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
