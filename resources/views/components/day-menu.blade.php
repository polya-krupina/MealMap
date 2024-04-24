@props(['order', 'day', 'kid'])

<tr class="day-menu">
    <td class="day-name"> <a href="{{ $kid->id }}/order?date={{ $day->format('Y-m-d') }}" style="text-decoration: 'none';">{{ $slot }}</a></td>
    @if ($order)
        <td class="dishes-list"><div>
            @foreach ($order->preset->meals[0]->dishes as $dish)
                {{ ucwords($dish->name) }} <br>
            @endforeach    
        </div></td>
        <td class="dishes-list"><div>
            @foreach ($order->preset->meals[1]->dishes as $dish)
                {{ ucwords($dish->name) }} <br>
            @endforeach    
        </div></td>
        <td class="dishes-list"><div>
            @foreach ($order->preset->meals[2]->dishes as $dish)
                {{ ucwords($dish->name) }} <br>
            @endforeach    
        </div></td>
        <td class="dishes-list"><div>
            @foreach ($order->preset->meals[3]->dishes as $dish)
                {{ ucwords($dish->name) }} <br>
            @endforeach    
        </div></td>
        <td class="day-price">{{ $order->get_price() }} ₽ </td>
    @else
        <td class="dishes-list"><div>
            Заказ еще не сделан
        </div></td>
        <td class="dishes-list"><div>
            Заказ еще не сделан
        </div></td>
        <td class="dishes-list"><div>
            Заказ еще не сделан
        </div></td>
        <td class="dishes-list"><div>
            Заказ еще не сделан
        </div></td>
        <td class="day-price">0 ₽ </td>
    @endif
</tr>