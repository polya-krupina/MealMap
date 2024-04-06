<x-layout :kids="$kids" class="content">
    <div class="child-info">
        <img class="profile-img" src="{{ asset('img/empty.jpg') }}" width="125px" height="125px">
        <div class="main-info">
            <p class="child-name">{{ $kid->name }}</p>
            <p class="group">Группа: {{ $kid->group->name }}</p>
        </div>
        <div class="contacts">
            <p>Контакт родителя</p>
            <div class="number">
                <p>{{ auth()->user()->phone_number }}</p>
                <button id="change-number"><img src="{{ asset('img/edit-number.svg') }}" onmouseover="this.src={{ asset('img/edit-number-hover.svg') }};" onmouseout="this.src={{ asset('img/edit-number.svg') }};" width="13px"></button>
            </div>
        </div>
    </div>
    <div class="allergies">
        <h1>Аллергия</h1>
        <div class="allergies-info">
            <div id="search-section">
                <div id="search-container">
                    <input type="search" id="search-line" placeholder=" ">
                    <label class="search-label">
                        <img src="{{ asset('img/search.svg') }}">
                        <p>Название продукта ...</p>
                    </label>
                </div>
                <div id="search-list">
                    <ul class="choose-allergy">
                        @foreach($products as $product)
                            <li class="allergy">
                                {{ $product->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="allergies-list">
                @foreach($kid->allergies as $allergy)
                    <div class="allergy-card">
                        <p class="allergy-name">{{ $allergy->name }}</p>
                        <button class="remove-allergy"></button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="dark-overlay"></div>
    <div id="change-number-form">
        <button id="close-change-number"></button>
        <label class="form-label">Изменение номера телефона</label>
        <div class="input-line">
            <input type="text" class="form-input" placeholder=" ">
            <p class="number-input-text">Введите номер телефона</p>
        </div>
        <button type="submit" class="send-code">Отправить код</button>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var changeNumberButton = document.getElementById('change-number');
        var closeChangeNumberButton = document.getElementById('close-change-number');
        var changeNumberForm = document.getElementById('change-number-form');
        var darkOverlay = document.getElementById('dark-overlay');

        changeNumberButton.addEventListener('click', function() {
            changeNumberForm.style.display = 'flex';
            darkOverlay.style.display = 'block';
        });

        closeChangeNumberButton.addEventListener('click', function() {
            changeNumberForm.style.display = 'none';
            darkOverlay.style.display = 'none';
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchLine = document.getElementById('search-line');
        var searchList = document.getElementById('search-list');
        var searchContainer = document.getElementById('search-container');

        searchLine.addEventListener('focus', function() {
            searchList.style.display = 'flex';
            searchList.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
            searchContainer.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
        });

        searchLine.addEventListener('blur', function() {
            searchList.style.display = 'none';
            searchList.style.boxShadow = 'none';
            searchContainer.style.boxShadow = 'none';
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchLine = document.getElementById('search-line');
        var searchListItems = document.querySelectorAll('#search-list .allergy');

        searchLine.addEventListener('input', function() {
            var searchTerm = searchLine.value.toLowerCase();
            searchListItems.forEach(function(item) {
                var textContent = item.textContent.toLowerCase();
                if (textContent.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
</x-layout>