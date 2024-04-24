@props(['dish'])
<div class="dish-card" data-id="{{ $dish->id }}">
    <div class="dish-img"><img src="{{ asset('img/fried-eggs.png') }}"></div>
    <button class="remove-dish" style="display: none;"></button>
    <div class="dish-info"> 
        <div class="main-dish-info">
            <div class="open-info"><h3>{{ ucwords($dish->name) }}</h3></div>
            <p class="price">{{ $dish->price }} ₽</p>
        </div>
        <x-products-list :dish="$dish" class="composition"/>
    </div>
</div>