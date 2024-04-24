<x-layout :kids="$kids" class="page-content" :active="$kid->id">
    
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
    @endpush

    <div id="week-choice">
        <a href="/kids/{{ $kid->id }}?date={{ $selected->copy()->subWeek()->format('Y-m-d') }}" class="change-week"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src={{ asset('img/leftHover.svg') }};" onmouseout="this.src={{ asset('img/left.svg') }};" width="26px"></a>
        <span class="week-info">{{ $weekStart . ' - ' . $weekEnd }} </span>
        <a href="/kids/{{ $kid->id }}?date={{ $selected->copy()->addWeek()->format('Y-m-d') }}" class="change-week"><img src="{{ asset('img/right.svg') }}" onmouseover="this.src={{ asset('img/rightHover.svg') }};" onmouseout="this.src={{ asset('img/right.svg') }};" width="26px"></a>
    </div>
    <x-week-layout :kid="$kid" :week="$week" :weekOrders="$weekOrders" />
    <span class="choice-info">Если расписание не будет выбрано, 
        то применится универсальный шаблон, предоставляемый детским садом </span>
    <div id="calendar-container">
        <div id="calendar">
            <table class="month-menu">
                <tr class="meals">
                    <td class="day-name"></td>
                    <td class="meal">Завтрак</td>
                    <td class="meal">Второй завтрак</td>
                    <td class="meal">Обед</td>
                    <td class="meal">Полдник</td>
                </tr>
                <x-day-menu :order="$weekOrders[0]" :day="$week[0]" :kid="$kid">ПН</x-day-menu>
                <x-day-menu :order="$weekOrders[1]" :day="$week[1]" :kid="$kid">ВТ</x-day-menu>
                <x-day-menu :order="$weekOrders[2]" :day="$week[2]" :kid="$kid">СР</x-day-menu>
                <x-day-menu :order="$weekOrders[3]" :day="$week[3]" :kid="$kid">ЧТ</x-day-menu>
                <x-day-menu :order="$weekOrders[4]" :day="$week[4]" :kid="$kid">ПТ</x-day-menu>
                <x-day-menu :order="$weekOrders[5]" :day="$week[5]" :kid="$kid">СБ</x-day-menu>
            </table>
        </div>
    </div>
</x-layout>