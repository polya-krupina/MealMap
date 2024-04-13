<x-layout :kids="$kids" class="content" :active="$kid->id">
    @push('styles')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/parent-child-info.css') }}">
    @endpush

    @push('active')
        {{ $kid->id }}
    @endpush
    <div class="child-info">
        <div class="avatar-container">
            <img class="profile-img" src="{{ $kid->avatar ? asset('storage/' . $kid->avatar) : asset('img/empty.jpg')}}" width="125px" height="125px">
            <input type="file" id="avatar-input" accept="image/*" style="display: none;">
            <button id="change-avatar"></button>
        </div>
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
                            <li class="allergy" data-id="{{ $product->id }}">
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
                        <form action="/allergy" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="kid" value="{{ $kid->id }}">
                            <input type="hidden" name="product" value={{ $allergy->id }}>
                            <button class="remove-allergy"></button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="dark-overlay"></div>
    <div id="change-number-form">
        <button id="close-change-number"></button>
        <form action="POST" action="/change-phone">
            <label class="form-label">Изменение номера телефона</label>
            <div class="input-line">
                <input type="text" class="form-input" placeholder=" ">
                <p class="number-input-text">Введите номер телефона</p>
            </div>
            <button type="submit" class="send-code">Отправить код</button>
        </form>
    </div>
</section>
@push('scripts')
    <script>
        document.querySelectorAll('.allergy').forEach(function(allergy) {
            allergy.addEventListener('click', function() {
                var productId = this.dataset.id;
                var kidId = getKidIdFromUri();
                axios.post('/allergy', {
                    kid_id: kidId,
                    product_id: productId
                })
                .then(function(response) {
                    console.log(response);
                    location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
            });
        });

        function getKidIdFromUri() {
            var uri = window.location.pathname;
            var segments = uri.split('/');
            var kidId = segments[segments.length - 2];

            return kidId;
        }
    </script>
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

            darkOverlay.addEventListener('click', function() {
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

            function handleFocus() {
                searchList.style.display = 'flex';
                searchList.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
                searchContainer.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
            };

            function handleBlur() {
                searchList.style.display = 'none';
                searchList.style.boxShadow = 'none';
                searchContainer.style.boxShadow = 'none';
            };
            searchLine.addEventListener('focus', handleFocus);

                document.addEventListener('click', function(event) {
                    if (event.target !== searchList && !searchList.contains(event.target) && event.target !== searchLine) {
                        handleBlur();
                    }
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var avatarChangeButton = document.getElementById('change-avatar');
            var avatarInput = document.getElementById('avatar-input');

            avatarChangeButton.addEventListener('click', function() {
                avatarInput.click();
            });

            avatarInput.addEventListener('change', function(){
                let formData = new FormData();
                formData.append('file', avatarInput.files[0]);
                formData.append('kid_id', getKidIdFromUri());
                axios.post('/upload-avatar', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
                })
                .then(response => {
                    console.log(response);
                    location.reload();
                })
                .catch(error => {
                    console.error(error);
                });
            });
        });

    </script>
@endpush
</x-layout>