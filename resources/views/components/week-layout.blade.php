@props(['kid', 'week', 'weekOrders' => null, 'day' => request('date')])

@if ($weekOrders != null)
<div id="day-choice">
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[0]->format('Y-m-d') }}" class="day {{ $weekOrders[0] ? 'menu-selected' : '' }} {{ $week[0]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ПН</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[1]->format('Y-m-d') }}" class="day {{ $weekOrders[1] ? 'menu-selected' : '' }} {{ $week[1]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ВТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[2]->format('Y-m-d') }}" class="day {{ $weekOrders[2] ? 'menu-selected' : '' }} {{ $week[2]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">СР</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[3]->format('Y-m-d') }}" class="day {{ $weekOrders[3] ? 'menu-selected' : '' }} {{ $week[3]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ЧТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[4]->format('Y-m-d') }}" class="day {{ $weekOrders[4] ? 'menu-selected' : '' }} {{ $week[4]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">ПТ</a>
    <a href="/kids/{{ $kid->id }}/order?date={{ $week[5]->format('Y-m-d') }}" class="day {{ $weekOrders[5] ? 'menu-selected' : '' }} {{ $week[5]->format('Y-m-d') == request('date') && str_contains($_SERVER['REQUEST_URI'], 'order')? 'active-day' : '' }}">СБ</a>
</div>
@else
<div id="day-choice">
    <a href="/schedule?date={{ $week[0]->format('Y-m-d') }}" class="day {{ $week[0]->format('Y-m-d') == $day ? 'active-day' : '' }}">ПН</a>
    <a href="/schedule?date={{ $week[1]->format('Y-m-d') }}" class="day {{ $week[1]->format('Y-m-d') == $day ? 'active-day' : '' }}">ВТ</a>
    <a href="/schedule?date={{ $week[2]->format('Y-m-d') }}" class="day {{ $week[2]->format('Y-m-d') == $day ? 'active-day' : '' }}">СР</a>
    <a href="/schedule?date={{ $week[3]->format('Y-m-d') }}" class="day {{ $week[3]->format('Y-m-d') == $day ? 'active-day' : '' }}">ЧТ</a>
    <a href="/schedule?date={{ $week[4]->format('Y-m-d') }}" class="day {{ $week[4]->format('Y-m-d') == $day ? 'active-day' : '' }}">ПТ</a>
    <a href="/schedule?date={{ $week[5]->format('Y-m-d') }}" class="day {{ $week[5]->format('Y-m-d') == $day ? 'active-day' : '' }}">СБ</a>
</div>
@endif