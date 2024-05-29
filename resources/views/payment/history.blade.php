
<x-layout :kids="$kids" id="page-content" active="payment" :groups="$groups">
    
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    @endpush

    <div id="back-payment">
        <a href="/payment" class="change-week"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src='{{ asset('img/leftHover.svg') }}';" onmouseout="this.src='{{ asset('img/left.svg') }}';" width="26px"></a>
        <span class="week-info">Вернуться к оплате</span>
    </div>
    <h1>История платежей</h1>
    <div id="month-choice">
        <a href="/payment/history?date={{ $date->copy()->subMonth()->format("Y-m-d") }}" class="change-month"><img src="{{ asset('img/left.svg') }}" onmouseover="this.src='{{ asset('img/leftHover.svg') }}';" onmouseout="this.src='{{ asset('img/left.svg') }}';" width="26px"></a>
        <span id="payment-month">{{ $date->isoformat("MMMM Y") }}</span>
        <a href="/payment/history?date={{ $date->copy()->addMonth()->format("Y-m-d") }}" class="change-month"><img src="{{ asset('img/right.svg') }}" onmouseover="this.src='{{ asset('img/rightHover.svg') }}';" onmouseout="this.src='{{ asset('img/right.svg') }}';" width="26px"></a>
    </div>
    
    <ul id="children-container">
        @foreach ($payments as $kid)
            <li class="child-payment">
                <div class="child-payment-info">
                    <div class="child-closed-info">
                        <p class="child-name">{{ $kid->name }}</p>
                        <p class="monthly-amount">{{ $orderSums[$kid->id] }} ₽  </p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    
    @push('scripts')
    <script src="{{ 'js/show-error.js' }}"></script>
    @endpush
</x-layout>