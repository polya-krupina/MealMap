<x-layout :kids="$kids" class="page-content new-template" active="templates">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
        <link rel="stylesheet" href="{{ asset('css/templates.css') }}">
        <link rel="stylesheet" href="{{ asset('css/parent-day-menu.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    <div id="week-choice">
        <a href="/templates" class="change-week"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src={{ asset('img/leftHover.svg') }};" onmouseout="this.src={{ asset('img/left.svg') }};" width="26px"></a>
        <span class="week-info">Все шаблоны</span>
    </div>
    <div id="edit-buttons">
        <form action="/templates/save" method="post">
            @csrf
            <input type="hidden" name="id" value={{ $preset->id }}>
            <input type="hidden" name="breakfast">
            <input type="hidden" name="second_breakfast">
            <input type="hidden" name="dinner">
            <input type="hidden" name="half_day">
            <div id="tamplate-name">
                <input type="text" name="name" id="tamplate-name-input" placeholder=" " value={{ $preset->name }}>
                <label id="tamplate-name-label">Название шаблона ...</label>
            </div>
            <button type="submit" id="save-template" onclick="alert('Сохранено'); save();">
                Сохранить
            </button>
        </form>
    </div>
    <div id="template-menu">
        <x-meal-info :meal="$preset->meals[0]" :dishes="$dishes[1]">Завтрак</x-meal-info>
        <x-meal-info :meal="$preset->meals[1]" :dishes="$dishes[2]">Второй завтрак</x-meal-info>
        <x-meal-info :meal="$preset->meals[2]" :dishes="$dishes[3]">Обед</x-meal-info>
        <x-meal-info :meal="$preset->meals[3]" :dishes="$dishes[4]">Полдник</x-meal-info>
    </div>
    <div id="dark-overlay"></div>

@push('scripts')
    <script>
        let saved = false;
        let meals  = [
            [],
            [],
            [],
            []
        ];
    </script>
    <script>
        function save(){
            saved = true;
            let breakfast = document.getElementsByName('breakfast')[0];
            let second_breakfast = document.getElementsByName('second_breakfast')[0];
            let dinner = document.getElementsByName('dinner')[0];
            let half_day = document.getElementsByName('half_day')[0];

            breakfast.value = meals[0];
            second_breakfast.value = meals[1];
            dinner.value = meals[2];
            half_day.value = meals[3];
            
        }
       window.addEventListener('beforeunload', function (e) {
            var confirmationMessage = 'Are you sure you want to leave?';  // Set a custom confirmation message
            if (saved){
                return false;
            }

            e.returnValue = confirmationMessage;     // Gecko, Trident, Chrome 34+
            return confirmationMessage;              // Gecko, WebKit, Chrome <34
        });

        document.querySelectorAll('.open-info').forEach(function(a){
            a.addEventListener('click', (e) => {
                e.preventDefault();
                window.open(a.href);
            })
        })

    </script>
    <script src="{{ asset('js/dishes-search.js') }}"></script>
    <script src="{{ asset('js/dishes-search-display.js') }}"></script>
    <script src="{{ asset('js/dish-card-pop-logic.js') }}"></script>    
@endpush
</x-layout>