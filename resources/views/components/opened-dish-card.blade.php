@props(['dish'])

{{-- <div id="dark-overlay"></div> --}}
<div id="dish-info-card">
    <button id="close-card"></button>
    <div class="main-dish-info">            
        <h4>{{ ucwords($dish->name) }}</h4>
        <p class="price">{{ $dish->price }} ₽</p>
    </div>
    <div class="dish-img-big"><img src="{{ $dish->avatar ? asset('storage/' . $dish->avatar) : asset('img/fried-eggs.png') }}"></div>
    <div class="composition-big">
        <h5>Состав:</h5>
        <hr></hr>
        <x-products-list :dish="$dish" class="composition-text"/>
    </div>
    <div class="nutritional-value">
        <h5>Пищевая ценность (на 100 граммов):</h5>
        <hr></hr>
        <div class="values-list">
            <p>Калории: {{ $dish-> callories }} ккал</p>
            <p>Белки: {{ $dish->proteins }} г</p>
            <p>Жиры: {{ $dish->fats }} г</p>
            <p>Углеводы: {{ $dish->carbohydrates }} г</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var closeButton = document.getElementById('close-card');
        var changeNumberForm = document.getElementById('dish-info-card');
        var darkOverlay = document.getElementById('dark-overlay');

        document.body.style.overflow = 'hidden';
        changeNumberForm.style.display = 'block';
        darkOverlay.style.display = 'block';

        closeButton.addEventListener('click', function() {
            document.body.style.overflow = 'auto';
            changeNumberForm.style.display = 'none';
            darkOverlay.style.display = 'none';
        });

        darkOverlay.addEventListener('click', function() {
                document.body.style.overflow = 'auto';
                changeNumberForm.style.display = 'none';
                darkOverlay.style.display = 'none';
            });
    });
</script>