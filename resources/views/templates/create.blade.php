<x-layout :kids="$kids" class="page-content new-template" active="templates">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
        <link rel="stylesheet" href="{{ asset('css/templates.css') }}">
        <link rel="stylesheet" href="{{ asset('css/parent-day-menu.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @endpush
    <div id="week-choice">
        <a href="/templates" class="change-week"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src={{ asset('img/leftHover.svg') }};" onmouseout="this.src={{ asset('img/left.svg') }};" width="26px"></a>
        <span class="week-info">Все шаблоны</span>
    </div>
    <div id="edit-buttons">
        <form action="/templates/save" method="post">
            @csrf
            <input type="hidden" name="breakfast">
            <input type="hidden" name="second_breakfast">
            <input type="hidden" name="dinner">
            <input type="hidden" name="half_day">
            <div id="tamplate-name">
                <input type="text" name="name" id="tamplate-name-input" placeholder=" " required>
                <label id="tamplate-name-label">Название шаблона ...</label>
            </div>
            <button type="submit" id="save-template" onclick="save();">
                Сохранить
            </button>
        </form>
    </div>
    <div id="template-menu">
        <x-meal-info :dishes="$dishes[1]">Завтрак</x-meal-info>
        <x-meal-info :dishes="$dishes[2]">Второй завтрак</x-meal-info>
        <x-meal-info :dishes="$dishes[3]">Обед</x-meal-info>
        <x-meal-info :dishes="$dishes[4]">Полдник</x-meal-info>
    </div>
    <div class="error-notification" style="display: none;">:message</div>
    <x-dish-info-card/>
    <div id="dark-overlay"></div>
    @if($errors->any())
    <script src="{{ asset('js/show-error.js') }}"></script>
    <script>
        showError('Все поля должны быть заполнены!');
    </script>
    @endif
@push('scripts')
    <script src="{{ asset('js/open-dish-info-card.js') }}"></script>
    <script src="{{ asset('js/save-before-leave.js') }}"></script>
    <script src="{{ asset('js/dishes-search.js') }}"></script>
    <script src="{{ asset('js/dishes-search-display.js') }}"></script>
    <script src="{{ asset('js/dish-card-pop-logic.js') }}"></script>
    
@endpush
</x-layout>