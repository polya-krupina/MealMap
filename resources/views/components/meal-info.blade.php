@props(['dishes', 'meal'])
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
            @foreach ($dishes->whereNotIn('id', $meal->dishes->pluck('id')) as $dish)
                <x-dish-card :dish="$dish" meal="{{ $meal->id }}">
                    <x-slot name="url">dishes</x-slot>
                </x-dish-card>
            @endforeach
        </div> 
    </div>
    <div class="chosen-dishes"> 
        @foreach ($meal->dishes as $dish)
            <x-dish-card :dish="$dish" onclick="reload_by_adding = true;">
                <x-slot name="url">templates/create</x-slot>
                <button class="remove-dish"></button>
            </x-dish-card>
        @endforeach
        {{-- <x-dish-card>
            <button class="remove-dish"></button>
        </x-dish-card>
        <x-dish-card>
            <button class="remove-dish"></button>
        </x-dish-card> --}}
    </div>
</div>