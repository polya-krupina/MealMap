<x-layout :kids="$kids" class="page-content" :active="$kid->id"  :groups="$groups">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
        <link rel="stylesheet" href="{{ asset('css/parent-day-menu.css') }}">
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
                        <li><a href="/kids/{{ $kid->id }}   /order?date={{ $date->format('Y-m-d') }}&template={{ $template->id }}">{{ $template->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if($order && $diff > 0)
        <form action="/order/{{ $order->id }}/delete" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" id="deselect">
                Отменить заказ
            </button>
        </form>
        @endif
        @if ($diff > 1)
        <button type="submit" class="save-menu" onclick="send()">
            Сохранить
        </button>
        @else
            <button type="submit" class="save-menu inactive-button" disabled>
                Сохранить
            </button>
        @endif
    </div>
    {{-- {{ ddd($dishes) }} --}}
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
    <div class="error-notification" style="display: none;">:message</div>
    {{-- @if($errors->any())
        {!! implode('', $errors->all('')) !!}
    @endif --}}
    <x-dish-info-card/>
    <div id="dark-overlay"></div>

    @push('scripts')
    <script src="{{ asset('js/show-error.js') }}"/>
        <script src="{{ asset('js/dishes-search.js') }}"></script>
        <script src="{{ asset('js/dishes-search-display.js') }}"></script>
        <script src="{{ asset('js/dish-card-pop-logic.js') }}"></script>
        <script src="{{ asset('js/open-dish-info-card.js') }}"></script>
        <script>
            document.getElementById('list-container').addEventListener('mouseover', function() {
            document.getElementById('choose-template').classList.add('hovered');
            });
        
            document.getElementById('list-container').addEventListener('mouseout', function() {
            document.getElementById('choose-template').classList.remove('hovered');
            });
        
        </script>
        <script>
            function send(){
                let data = {
                    'meals' : meals,
                    'kid_id' : {!! $kid->id !!},
                    'day': '{!! $date->format('Y-m-d')!!}'
                };

                @if ($order)
                    data['order_id'] = {!! $order->id !!}; // Если заказ уже есть
                @endif

                axios.post('/save', data)
                .then( (response) => {
                    if (response.data.error == null){
                        alert(response.data.success);
                        hideError();
                    } else {
                        showError(response.data.error);
                    }
                })
            }
        </script>
    @endpush
</x-layout>