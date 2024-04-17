@props(['dishes', 'meal' => null])
<div class="meal-info">
    <h1>{{ $slot }}</h1>
    <div class="add-dish">
        <div class="search-container">
            <input type="search" class="search-line" placeholder=" ">
            <label class="search-label">
                <img src="{{ asset('img/add.svg') }}">
                <p>Добавить блюдо ...</p>
            </label>
        </div>
        <div class="dishes-choice">
            @foreach ($meal ? $dishes->whereNotIn('id', $meal->dishes->pluck('id')) : $dishes as $dish)
                <x-dish-card :dish="$dish">
                    <x-slot name="url">dishes</x-slot>
                </x-dish-card>
            @endforeach
        </div> 
    </div>  
    <div class="chosen-dishes"> 
        @if($meal)
            @foreach ($meal->dishes as $dish)
                <x-dish-card :dish="$dish" onclick="reload_by_adding = true;">
                    <x-slot name="url">dishes</x-slot>
                    <button class="remove-dish"></button>
                </x-dish-card>
            @endforeach
        @endif
    </div>
</div>