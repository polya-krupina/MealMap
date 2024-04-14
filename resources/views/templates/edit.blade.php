<x-layout :kids="$kids" class="page-content new-template" active="templates">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
        <link rel="stylesheet" href="{{ asset('css/templates.css') }}">
        <link rel="stylesheet" href="{{ asset('css/parent-day-menu.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    <div id="week-choice">
        <a href="/templates" class="change-week"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src={{ asset('img/leftHover.svg') }};" onmouseout="this.src={{ asset('img/left.svg') }};" width="26px"></a>
        <span class="week-info">Все шаблоны</span>
    </div>
    <div id="edit-buttons">
        <div id="tamplate-name">
            <input type="text" id="tamplate-name-input" placeholder=" " value="{{ $preset->name }}">
            <label id="tamplate-name-label">Название шаблона ...</label>
        </div>
        <button type="submit" id="save-template" onclick="alert('Сохранено'); save();">
            Сохранить
        </button>
    </div>
    <input type="hidden" name="preset_id" value="{{ $preset->id }}">
    <div id="template-menu">
        <x-meal-info :meal="$preset->meals[0]" :dishes="$dishes[1]">Завтрак</x-meal-info>
        <x-meal-info :meal="$preset->meals[1]" :dishes="$dishes[2]">Второй завтрак</x-meal-info>
        <x-meal-info :meal="$preset->meals[2]" :dishes="$dishes[3]">Обед</x-meal-info>
        <x-meal-info :meal="$preset->meals[3]" :dishes="$dishes[4]">Полдник</x-meal-info>
    </div>
    <div id="dark-overlay"></div>
    
    @if(request('id'))
        <x-opened-dish-card :dish="$found"/>
    @endif

@push('scripts')
    <script>
        let saved = false;
        let reload_by_adding = false;
        document.addEventListener('DOMContentLoaded', function() {
            var openDishCards = document.querySelectorAll('.open-info');
            var closeButton = document.getElementById('close-card');
            var changeNumberForm = document.getElementById('dish-info-card');
            var darkOverlay = document.getElementById('dark-overlay');

            openDishCards.forEach(function(openDishCard) {
                openDishCard.addEventListener('click', function() {
                    document.body.style.overflow = 'hidden';
                    changeNumberForm.style.display = 'block';
                    darkOverlay.style.display = 'block';
                });
            });

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
    <script>
        function save(){
            saved = true;
            var id = document.getElementsByName('preset_id')[0].value;
            var name = document.getElementById('tamplate-name-input').value;
            axios.post('/templates/save', {
                    id: id,
                    name: name
                })
                .then(function(response) {
                    console.log(response);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        document.querySelectorAll('.open-info').forEach(function(a){
            a.addEventListener('click', (e) => {
                e.preventDefault();
                window.open(a.href);
            })
        })

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchLines = document.querySelectorAll('.search-line');

            searchLines.forEach(function(searchLine) {
                searchLine.addEventListener('input', function() {
                    const searchText = this.value.toLowerCase().trim();
                    const dishCards = this.closest('.add-dish').querySelectorAll('.dish-card');

                    dishCards.forEach(function(dishCard) {
                        const composition = dishCard.querySelector('.main-dish-info h2').textContent.toLowerCase();
                        if (composition.includes(searchText)) {
                            dishCard.style.display = 'block';
                        } else {
                            dishCard.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
    <script src="{{ asset('js/dishes-search.js') }}"></script>
    <script>
        document.querySelectorAll('.add-dish').forEach(function(menu){
            menu.querySelectorAll('.dish-card').forEach(function(dish_card) {
            dish_card.addEventListener('click', function() {
                var dish_id = this.dataset.id;
                var meal_id = this.dataset.meal;
                reload_by_adding = true;
                axios.post('/meals/add', {
                    meal_id: meal_id,
                    dish_id: dish_id
                })
                .then(function(response) {
                    console.log(response);
                    location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
            });
        });
    });
    </script>
@endpush
</x-layout>