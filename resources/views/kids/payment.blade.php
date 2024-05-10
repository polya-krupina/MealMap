<x-layout :kids="$kids" id="page-content" active="payment">
    
    @push('styles')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    @endpush

    <h1>Оплата</h1>
    <span id="payment-month">{{ $month }}</span>
    <ul id="children-container">
        @foreach ($payments as $kid)
        <li class="child-payment">
            <div class="checkboxContainer">
                <div class="checkboxImage"></div>
                <input type="checkbox" class="checkboxInput" data-id="{{ $kid->id }}" onclick="add_kid(this.dataset.id)">
            </div>                
            <div class="child-payment-info">
                <div class="child-closed-info">
                    <p class="child-name">{{ $kid->name }}</p>
                    <p class="monthly-amount">{{ $orderSums[$kid->id] }} ₽</p>
                    <button class="open-info"></button>
                </div>
                <div class="child-opened-info">
                    <p class="child-name">{{ $kid->name }}</p>
                    <ul class="payment-dishes-list">
                        @if(isset($dishes[$kid->id]))
                        @foreach ($dishes[$kid->id] as $dish)
                            <li class="dish-month">
                                <p>{{ $dish['dish']->name }}</p>
                                <p>{{ $dish['count']}} {{$dish['count'] % 10 == 2 || $dish['count'] % 10 == 3 || $dish['count'] % 10 == 4 ? ' раза' : ' раз'}} </p>
                                <p>{{ $dish['count'] * $dish['dish']->price }} ₽</p>
                            </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="month-total">
                        <span>Итого</span>
                        <p class="total-amount">{{ $orderSums[$kid->id] }} ₽</p>
                    </div>
                    <button class="close-info"></button>
                </div>
            </div>
        </li>
        @endforeach
        <div class="error-notification" style="display: none;">:message</div>
        @if (count($payments) == 0 )
        <div id="payment-button-container">
            <button class="pay-for-month inactive-button"  onclick="pay()" disabled>
                Оплатить
            </button>
        </div>
        @else
        <div id="payment-button-container">
            <button class="pay-for-month"  onclick="pay()">
                Оплатить
            </button>
        </div>
        @endif
</section>

    
    @push('scripts')
    <script src="{{ asset('js/show-error.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openInfoButtons = document.querySelectorAll('.open-info');
            const closeInfoButtons = document.querySelectorAll('.close-info');
    
            openInfoButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const parentPaymentInfo = event.target.closest('.child-payment-info');
                    parentPaymentInfo.querySelector('.child-closed-info').style.display = 'none';
                    parentPaymentInfo.querySelector('.child-opened-info').style.display = 'flex';
                });
            });
    
            closeInfoButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const parentPaymentInfo = event.target.closest('.child-payment-info');
                    parentPaymentInfo.querySelector('.child-closed-info').style.display = 'flex';
                    parentPaymentInfo.querySelector('.child-opened-info').style.display = 'none';
                });
            });
        });
    </script>
    <script>
        const checkboxContainers = document.querySelectorAll('.checkboxContainer');
        checkboxContainers.forEach(function(container) {
            const checkboxInput = container.querySelector('.checkboxInput');
            const checkboxImage = container.querySelector('.checkboxImage');
            checkboxInput.addEventListener('change', function() {
                if (checkboxInput.checked) {
                    checkboxImage.style.backgroundImage = "url('img/selectedHover.svg')";
                } else {
                    checkboxImage.style.backgroundImage = "url('img/emptyHover.svg')";
                }
            });
    
            checkboxInput.addEventListener('mouseover', function() {
                if (checkboxInput.checked) {
                    checkboxImage.style.backgroundImage = "url('img/selectedHover.svg')";
                } else {
                    checkboxImage.style.backgroundImage = "url('img/emptyHover.svg')";
                }
            });
    
            checkboxInput.addEventListener('mouseout', function() {
                if (checkboxInput.checked) {
                    checkboxImage.style.backgroundImage = "url('img/selectedDefault.svg')";
                } else {
                    checkboxImage.style.backgroundImage = "url('img/emptyDefault.svg')";
                }
            });
        });
    </script>
    <script>
        let kids = [];

        function add_kid(kid_id){
            if (kids.includes(kid_id)){
                kids.splice(kids.indexOf(kid_id), 1);
            } else {
                kids.push(kid_id);
            }
        }

        function pay(){
            if (kids.length == 0){
                return alert('Должен быть выбран хотя-бы один ребенок!');
            }
            if (confirm('Оплата прошла успешно?')){
                let data = {
                    kids: kids
                };
                axios.post('/pay', data)
                .then((response) => {
                    console.log(response);
                    alert('Успешно!');
                    location.reload();
                })
                .catch((response) => {
                    console.log(response);
                    alert('Что-то пошло не так!');
                })
            } else {
                showError('Во время оплаты возникла ошибка');
            }
        }
    </script>
    @endpush
</x-layout>