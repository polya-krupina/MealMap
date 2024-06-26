<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/authorization.css">
    <link rel="stylesheet" href="css/style.css">
    <title>MealMap</title>
</head>
<body>
    <div id="container">
    <div id="greeting">
        <div class="logo-container"><img src="img/black-logo.svg"></div>
        <h1>Добро пожаловать в MealMap</h1>
    </div>
    <div id="login-text">
        <hr></hr>
        <h2>Войти</h2>
        <hr></hr>
    </div>
    <form class="login-form" action="/sessions" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-input" placeholder=" " name="phone_number" required>
            <span class="label-hover">Номер телефона</span>
            <label class="form-label"><img src="img/profile.svg">Введите номер телефона...</label>
        </div>
        <div class="form-group">
            <div id="toggle-button">
                <img src='img/closed.svg' onmouseover="this.src='img/closedHover.svg';" onmouseout="this.src='img/closed.svg';">
            </div>
            <input type="password" class="form-input" id="password-input" placeholder=" " name="password">
            <span class="label-hover">Пароль</span>
            <label class="form-label"><img src="img/password.svg">Введите пароль ...</label>
        </div>
        <div class="button_cantainer">
            <button type="submit">Войти</button>
            @error('phone_number')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<script>
    const passwordInput = document.getElementById("password-input");
    const toggleButton = document.getElementById("toggle-button");
    const icon = toggleButton.querySelector("img");
    toggleButton.addEventListener("click", function() {
        event.preventDefault();
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.src = "img/openedHover.svg";
            icon.onmouseover = function() { this.src = "img/openedHover.svg"; };
            icon.onmouseout = function() { this.src = "img/opened.svg"; };
        } else {
            passwordInput.type = "password";
            icon.src = "img/closedHover.svg";
            icon.onmouseover = function() { this.src = "img/closedHover.svg"; };
            icon.onmouseout = function() { this.src = "img/closed.svg"; };
        }
    });
</script>
</body>
</html>