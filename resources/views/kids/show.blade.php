<x-layout :kids="$kids" class="page-content">
    <div id="week-choice">
        <a href="#" class="change-week"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src={{ asset('img/leftHover.svg') }};" onmouseout="this.src={{ asset('img/left.svg') }};" width="26px"></a>
        <span class="week-info">04 - 10 марта 2024</span>
        <a href="#" class="change-week"><img src="{{ asset('img/right.svg') }}" onmouseover="this.src={{ asset('img/rightHover.svg') }};" onmouseout="this.src={{ asset('img/right.svg') }};" width="26px"></a>
    </div>
    <div id="day-choice">
        <a href="#" class="day menu-selected">ПН</a>
        <a href="#" class="day">ВТ</a>
        <a href="#" class="day menu-selected">СР</a>
        <a href="#" class="day menu-selected">ЧТ</a>
        <a href="#" class="day">ПТ</a>
        <a href="#" class="day">СБ</a>
    </div>
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
                <tr class="day-menu">
                    <td class="day-name">ПН</td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                </tr>
                <tr class="day-menu">
                    <td class="day-name">ВТ</td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                </tr>
                <tr class="day-menu">
                    <td class="day-name">СР</td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                </tr>
                <tr class="day-menu">
                    <td class="day-name">ЧТ</td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                </tr>
                <tr class="day-menu">
                    <td class="day-name">ПТ</td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                </tr>
                <tr class="day-menu">
                    <td class="day-name">СБ</td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                    <td class="dishes-list"><div>Яичница<br>Булка<br>Компот</div></td>
                </tr>
            </table>
        </div>
    </div>
</x-layout>