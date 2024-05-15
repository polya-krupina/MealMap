<x-layout active="schedule" class="page-content">
    @push('styles')
        <link rel="stylesheet" href="css/parent.css">
        <link rel="stylesheet" href="css/parent-day-menu.css">
        <link rel="stylesheet" href="css/worker-schedule.css">
    @endpush

    <div id="week-choice">
        <a href="/schedule?date={{ $selected->copy()->subWeek()->format('Y-m-d') }}" class="change-week"><img src="img/left.svg" onmouseover="this.src='img/leftHover.svg';" onmouseout="this.src='img/left.svg';" width="26px"></a>
        <span class="week-info">{{ $weekStart }} - {{ $weekEnd }}</span>
        <a href="/schedule?date={{ $selected->copy()->addWeek()->format('Y-m-d') }}" class="change-week"><img src="img/right.svg" onmouseover="this.src='img/rightHover.svg';" onmouseout="this.src='img/right.svg';" width="26px"></a>
    </div>
    <x-week-layout :week="$week" :day="$selected->format('Y-m-d')"/>
    <div id="lists-container">
        <div class="dropdown-list">
            <div class="list-header">
                <div class="text-container">
                    Прием пищи
                    <img src="img/dropdown.svg">
                </div>
            </div>
            <div class="list-container">
                <ul class="options-list">
                    <li class="meal-option" data-id="1"><a>Завтрак</a></li>     
                    <li class="meal-option" data-id="2"><a>Второй завтрак</a></li>
                    <li class="meal-option" data-id="3"><a>Обед</a></li>
                    <li class="meal-option" data-id="4"><a>Полдник</a></li>
                </ul>
            </div>
        </div>
        <div class="dropdown-list">
            <div class="list-header">
                <div class="text-container">
                    Группа
                    <img src="img/dropdown.svg">
                </div>
            </div>
            <div class="list-container">
                <ul class="options-list">
                    @foreach ($groups as $group)
                        @if (!request('group'))
                            <li><a href="{{ $_SERVER['REQUEST_URI'] }}&group={{ $group->id }}">{{ $group->name }}</a></li>
                            @else
                            <li><a href="{{  substr($_SERVER['REQUEST_URI'],0,-1) . $group->id }}">{{ $group->name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <section id="main-container">
        <p>Блюда</p>
        <ul class="worker-dishes-list">
            @foreach ($dishes as $dish)
            <li class="worker-dish-container">
                <p>{{ $dish['name'] }}</p>
                <p>{{ $dish['count'] }} шт</p>
            </li>
            @endforeach
        </ul>
        @foreach ($meals as $meal)
            <ul class="worker-dishes-list" style="display: none;">
                @foreach ($meal as $dish)
                <li class="worker-dish-container">
                    <p>{{ $dish['name'] }}</p>
                    <p>{{ $dish['count'] }} шт</p>
                </li>
                @endforeach
            </ul>
        @endforeach
    </section>
    @error('group')
        <h1>Hi</h1>
    @enderror

    @push('scripts')
        <script>
            document.querySelectorAll('.dropdown-list').forEach(function(dropdownList) {
                const chooseTemplate = dropdownList.querySelector('.list-header');
                const listContainer = dropdownList.querySelector('.list-container');
                listContainer.addEventListener('mouseover', function() {
                    chooseTemplate.classList.add('hovered');
                });
                listContainer.addEventListener('mouseout', function() {
                    chooseTemplate.classList.remove('hovered');
                });
            });
        </script>
        <script>
            let options = document.querySelectorAll('.meal-option');
            let dishesLists = document.querySelectorAll('.worker-dishes-list');
            function close(){
                dishesLists.forEach( (o) => {
                    o.style.display = 'none';
                })
            }
            options.forEach((o) => {
                o.addEventListener('click', (event) => {
                    close();
                    dishesLists[o.dataset.id].style.display = 'block';
                });
            });
        </script>
        <script src="{{ asset('js/show-error.js') }}"></script>
    @endpush
</x-layout>