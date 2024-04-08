<x-layout class="content" :kids="$kids" active="dishes">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/parent-month-menu.css') }}">
    @endpush

    <div class="header">
        <h1>Меню</h1>
        <div class="meals-list">
            <a href="#breakfast" class="meal-link">Завтрак</a>
            <a href="#second-breakfast" class="meal-link">Второй завтрак</a>
            <a href="#lunch" class="meal-link">Обед</a>
            <a href="#afternoon-snack" class="meal-link">Полдник</a>
        </div>
    </div>
    <section class="menu">
        <x-meal-section :dishes="$dishes[1]" id="breakfast">
            Завтрак
        </x-meal-section>
        <x-meal-section :dishes="$dishes[2]" id="second-breakfast">
            Второй завтрак
        </x-meal-section>
        <x-meal-section :dishes="$dishes[3]" id="lunch">
            Обед
        </x-meal-section>
        <x-meal-section :dishes="$dishes[4]" id="afternoon-snack">
            Полдник
        </x-meal-section>
    </section>
</section>

@if(request('id'))
    <x-opened-dish-card :dish="$found"/>
@endif

<script>
    window.addEventListener('beforeunload', function () {
        localStorage.setItem('scrollPosition', window.scrollY);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo(0, scrollPosition);
        }

        var mealLinks = document.querySelectorAll('.meal-link');

        mealLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var targetId = this.getAttribute('href');
                var targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    var offsetTop = targetElement.offsetTop - 200;

                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
</x-layout>