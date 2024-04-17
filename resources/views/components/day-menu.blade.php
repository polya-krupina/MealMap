@props(['order'])

<tr class="day-menu">
    <td class="day-name">{{ $slot }}</td>
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
    @else
        <td class="dishes-list"><div>
            Заказ еще не сделан <br>
            Заказ еще не сделан <br>
            Заказ еще не сделан
        </div></td>
        <td class="dishes-list"><div>
            Заказ еще не сделан <br>
            Заказ еще не сделан <br>
            Заказ еще не сделан
        </div></td>
        <td class="dishes-list"><div>
            Заказ еще не сделан <br>
            Заказ еще не сделан <br>
            Заказ еще не сделан
        </div></td>
        <td class="dishes-list"><div>
            Заказ еще не сделан <br>
            Заказ еще не сделан <br>
            Заказ еще не сделан
        </div></td>
    @endif
</tr>