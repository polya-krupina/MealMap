@props(['dish', 'meal' => null])
{{-- , 'data-id'=>"{{ $dish->id }}", 'data-meal' => "{{ $meal->id }}" --}}
<div class="dish-card" data-id="{{ $dish->id }}" data-meal={{ $meal }}>
    <div class="dish-img"><img src="{{ asset('img/fried-eggs.png') }}"></div>
    {{ $slot }}
    <div class="dish-info"> 
        <div class="main-dish-info">
            <a href="/{{ $url }}?id={{ $dish->id }}" class="open-info"><h3>{{ $dish->name }}</h3></a>
            <p class="price">{{ $dish->price }} ₽</p>
        </div>
        <x-products-list :dish="$dish" class="composition"/>
    </div>
</div>