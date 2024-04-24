@props(['kid', 'week', 'weekOrders'])

<div id="day-choice">
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[0]->format('Y-m-d') }}" class="day {{ $weekOrders[0] ? 'menu-selected' : '' }} {{ $week[0]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ПН</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[1]->format('Y-m-d') }}" class="day {{ $weekOrders[1] ? 'menu-selected' : '' }} {{ $week[1]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ВТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[2]->format('Y-m-d') }}" class="day {{ $weekOrders[2] ? 'menu-selected' : '' }} {{ $week[2]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">СР</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[3]->format('Y-m-d') }}" class="day {{ $weekOrders[3] ? 'menu-selected' : '' }} {{ $week[3]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ЧТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[4]->format('Y-m-d') }}" class="day {{ $weekOrders[4] ? 'menu-selected' : '' }} {{ $week[4]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ПТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[5]->format('Y-m-d') }}" class="day {{ $weekOrders[5] ? 'menu-selected' : '' }} {{ $week[5]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">СБ</a>
</div>