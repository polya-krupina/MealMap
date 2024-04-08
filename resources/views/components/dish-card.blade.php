@props(['dish'])

<div class="dish-card">
    <div class="dish-img"><img src="img/fried-eggs.png"></div>
    <div class="dish-info"> 
        <div class="main-dish-info">
            <a href="/dishes?id={{ $dish->id }}" class="open-info"><h3>{{ $dish->name }}</h3></a>
            <p class="price">{{ $dish->price }} ₽</p>
        </div>
        <x-products-list :dish="$dish" class="composition"/>
    </div>
</div>