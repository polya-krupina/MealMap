<x-layout :kids="$kids" class="page-content">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
        <link rel="stylesheet" href="{{ asset('css/parent-day-menu.css') }}">
        <script src="{{ asset('js/dishes-search.js') }}"></script>
        @if (!request('template'))
            <script src="{{ asset('js/dishes-search-display.js') }}"></script>
        @endif
        <script src="{{ asset('js/open-dish-info-card.js') }}"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    @endpush

    <div id="week-choice">
        <a href="/kids/{{ $kid->id }}?date={{ $date->format('Y-m-d') }}" class="change-week"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src={{ asset('img/leftHover.svg') }};" onmouseout="this.src={{ asset('img/left.svg') }};" width="26px"></a>
        <span class="week-info">К полной неделе</span>
    </div>
    <x-week-layout :kid="$kid" :week="$week" :weekOrders="$weekOrders"/>
    <div id="buttons-container">
        <div id="dropdown-list">
            <div id="choose-template">
                <div id="text-container">
                    Применить шаблон
                    <img src="{{ asset('img/dropdown.svg') }}">
                </div>
            </div>
            <div id="list-container">
                <ul id="templates-list">
                    @foreach (auth()->user()->presets as $template)
                        <li><a href="{{ $_SERVER['REQUEST_URI'] . '&template=' . $template->id}}">{{ $template->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <form action="/orders" method="post">
            @csrf
            <input type="hidden" name="template_id" value="{{ request('template') ?? -1 }}">
            <input type="hidden" name="order_id" value={{ $order->id ?? -1 }}>
            <input type="hidden" name="kid_id" value={{ $kid->id }}>
            <input type="hidden" name="date" value="{{ $date->format('Y-m-d') }}">
            <button type="submit" id="save-menu">
                Сохранить
            </button>
        </form>
    </div>
    <div id="day-menu-container">
        @if (request('template') || $order)    
        <x-meal-info :meal="$preset->meals[0]" :dishes="$dishes[1]"> Завтрак </x-meal-info>
        <x-meal-info :meal="$preset->meals[1]" :dishes="$dishes[2]"> Второй завтрак </x-meal-info>
        <x-meal-info :meal="$preset->meals[2]" :dishes="$dishes[3]"> Обед </x-meal-info>
        <x-meal-info :meal="$preset->meals[3]" :dishes="$dishes[4]"> Полдник </x-meal-info>
            @else
        <x-meal-info :dishes="$dishes[1]"> Завтрак </x-meal-info>
        <x-meal-info :dishes="$dishes[2]"> Второй завтрак </x-meal-info>
        <x-meal-info :dishes="$dishes[3]"> Обед </x-meal-info>
        <x-meal-info :dishes="$dishes[4]"> Полдник </x-meal-info>
        @endif
    </div> 
<script>
    document.getElementById('list-container').addEventListener('mouseover', function() {
    document.getElementById('choose-template').classList.add('hovered');
    });

    document.getElementById('list-container').addEventListener('mouseout', function() {
    document.getElementById('choose-template').classList.remove('hovered');
    });

</script>
<script src="{{ asset('js/dish-card-link.js') }}"></script>
</x-layout>