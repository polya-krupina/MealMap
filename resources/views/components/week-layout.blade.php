@props(['kid', 'week', 'weekOrders'])

<div id="day-choice">
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[0]->format('Y-m-d') }}" class="day {{ $weekOrders[0] ? 'menu-selected' : '' }}">ПН</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[1]->format('Y-m-d') }}" class="day {{ $weekOrders[1] ? 'menu-selected' : '' }}">ВТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[2]->format('Y-m-d') }}" class="day {{ $weekOrders[2] ? 'menu-selected' : '' }}">СР</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[3]->format('Y-m-d') }}" class="day {{ $weekOrders[3] ? 'menu-selected' : '' }}">ЧТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[4]->format('Y-m-d') }}" class="day {{ $weekOrders[4] ? 'menu-selected' : '' }}">ПТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[5]->format('Y-m-d') }}" class="day {{ $weekOrders[5] ? 'menu-selected' : '' }}">СБ</a>
</div>