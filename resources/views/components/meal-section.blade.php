@props(['dishes'])

<div {{ $attributes(['class' => 'meal-section', 'id' => '']) }}>
    <h2>{{ $slot }}</h2>
    <hr></hr>
    <div class="dishes-list">
        @foreach ($dishes as $dish)
            <x-dish-card :dish="$dish">
                <x-slot name="url">dishes</x-slot>
            </x-dish-card>
        @endforeach
</div>