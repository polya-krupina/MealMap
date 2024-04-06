<x-layout class="content" :kids="$kids">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/parent-month-menu.css') }}">
    @endpush

    <div class="header">
        <h1>Меню</h1>
        <div class="meals-list">
            <a href="#breakfast" class="meal-link">Завтрак</a>
            <a href="#second-breakfast" class="meal-link">Второй завтрак</a>
            <a href="#lunch" class="meal-link">Обед</a>
            <a href="#afternoon-snack" class="meal-link">Полдник</a>
        </div>
    </div>
    <section class="menu">
        <div class="meal-section" id="breakfast">
            <h2>Завтрак</h2>
            <hr></hr>
            <div class="dishes-list">
                <div class="dish-card">
                    <div class="dish-img"><img src="img/fried-eggs.png"></div>
                    <div class="dish-info"> 
                        <div class="main-dish-info">
                            <button class="open-info"><h3>Яичница</h3></button>
                            <p class="price">200 ₽</p>
                        </div>
                        <p class="composition">Яйцо куриное, огурец, хлеб белый, масло, соль,  перец </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="meal-section" id="second-breakfast">
            <h2>Второй завтрак</h2>
            <hr></hr>
            <div class="dishes-list">
                <div class="dish-card">
                    <div class="dish-img"><img src="img/fried-eggs.png"></div>
                    <div class="dish-info">
                        <div class="main-dish-info">
                            <button class="open-info"><h3>Яичница</h3></button>
                            <p class="price">200 ₽</p>
                        </div>
                        <p class="composition">Яйцо куриное, огурец, хлеб белый, масло, соль,  перец </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="meal-section" id="lunch">
            <h2>Обед</h2>
            <hr></hr>
            <div class="dishes-list">
                <div class="dish-card">
                    <div class="dish-img"><img src="img/fried-eggs.png"></div>
                    <div class="dish-info">
                        <div class="main-dish-info">
                            <button class="open-info"><h3>Яичница</h3></button>
                            <p class="price">200 ₽</p>
                        </div>
                        <p class="composition">Яйцо куриное, огурец, хлеб белый, масло, соль,  перец </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="meal-section" id="afternoon-snack">
            <h2>Полдник</h2>
            <hr></hr>
            <div class="dishes-list">
                <div class="dish-card">
                    <div class="dish-img"><img src="img/fried-eggs.png"></div>
                    <div class="dish-info">
                        <div class="main-dish-info">
                            <button class="open-info"><h3>Яичница</h3></button>
                            <p class="price">200 ₽</p>
                        </div>
                        <p class="composition">Яйцо куриное, огурец, хлеб белый, масло, соль,  перец </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<div id="dark-overlay"></div>
<div id="dish-info-card">
    <button id="close-card"></button>
    <div class="main-dish-info">            
        <h4>Яичница</h4>
        <p class="price">200 ₽</p>
    </div>
    <div class="dish-img-big"></div>
    <div class="composition-big">
        <h5>Состав:</h5>
        <hr></hr>
        <p class="composition-text">
            Яйцо куриное, огурец, хлеб белый, масло, соль,  перец 
        </p>
    </div>
    <div class="nutritional-value">
        <h5>Пищевая ценность (на 100 граммов яичницы):</h5>
        <hr></hr>
        <div class="values-list">
            <p>Калории: 150-200 ккал</p>
            <p>Белки: 10-15 г</p>
            <p>Жиры: 10-15 г</p>
            <p>Углеводы: 1-3 г</p>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var mealLinks = document.querySelectorAll('.meal-link');

        mealLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var targetId = this.getAttribute('href');
                var targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    var offsetTop = targetElement.offsetTop - 200;

                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var openDishCards = document.querySelectorAll('.open-info');
        var closeButton = document.getElementById('close-card');
        var changeNumberForm = document.getElementById('dish-info-card');
        var darkOverlay = document.getElementById('dark-overlay');

        openDishCards.forEach(function(openDishCard) {
            openDishCard.addEventListener('click', function() {
                document.body.style.overflow = 'hidden';
                changeNumberForm.style.display = 'block';
                darkOverlay.style.display = 'block';
            });
        });

        closeButton.addEventListener('click', function() {
            document.body.style.overflow = 'auto';
            changeNumberForm.style.display = 'none';
            darkOverlay.style.display = 'none';
        });
    });
</script>
</x-layout>