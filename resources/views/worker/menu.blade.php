<x-layout class="content" active="menu">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/worker-create-dish.css') }}">
        <link rel="stylesheet" href="{{ asset('css/parent-month-menu.css') }}">
    @endpush
    <div class="header worker-header">
        <h1>Создайте блюдо</h1>
        <form id="create-dish-menu" action="/menu/save" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="create-dish-form" name="name" placeholder=" ">
                <span class="label-hover">Название блюда</span>
                <label class="form-label">Введите название блюда ...</label>
            </div>
            <div class="form-group">
                <input type="text" class="create-dish-form" placeholder=" " name="price">
                <span class="label-hover">Стоимость блюда</span>
                <label class="form-label">Введите стоимость блюда ...</label>
            </div>
            <div class="add-dish-img-container">
                <input type="file" accept="image/*" id="add-img-input" style="display: none;" name="img">
                <button id="add-dish-img">Загрузить фотографию</button>
            </div>
            <h2>Описание блюда</h2>
            <div></div>
            <div class="form-group">
                <input type="text" class="create-dish-form" placeholder=" " name="products">
                <span class="label-hover">Состав блюда</span>
                <label class="form-label">Состав блюда ...</label>
            </div>
            <div class="form-group">
                <input type="text" class="create-dish-form" placeholder=" " name="callories">
                <span class="label-hover">Калораж</span>
                <label class="form-label">Калораж ...</label>
            </div>
            <div class="img-info">
                <div class="chosen-img">
                    <p id="chosen-img-name"></p>
                    <img src="img/clip.svg" width="15px" height="15px" style="display: none;">
                </div>
                <button class="remove-img"></button>
            </div>
            <div class="form-group">
                <input type="text" class="create-dish-form" placeholder=" " name="proteins">
                <span class="label-hover">Количество белков</span>
                <label class="form-label">Количество белков ...</label>
            </div>
            <div class="form-group">
                <input type="text" class="create-dish-form" placeholder=" " name="carbohydrates">
                <span class="label-hover">Количество углеводов</span>
                <label class="form-label">Количество углеводов ...</label>
            </div>
            <div class="form-group">
                <input type="text" class="create-dish-form" placeholder=" " name="fats">
                <span class="label-hover">Количество жиров</span>
                <label class="form-label">Количество жиров ...</label>
            </div>
            <button type="submit" class="menu-button">Создать блюдо</button>
        </form>
        <div class="meals-list">
            <a href="#breakfast" class="meal-link">Завтрак</a>
            <a href="#second-breakfast" class="meal-link">Второй завтрак</a>
            <a href="#lunch" class="meal-link">Обед</a>
            <a href="#afternoon-snack" class="meal-link">Полдник</a>
        </div>
    </div>
    <section class="menu worker-menu">
        <x-meal-section :dishes="$dishes[1]" id="breakfast">
            Завтрак
        </x-meal-section>
        <x-meal-section :dishes="$dishes[2]" id="second-breakfast">
            Второй завтрак
        </x-meal-section>
        <x-meal-section :dishes="$dishes[3]" id="lunch">
            Обед
        </x-meal-section>
        <x-meal-section :dishes="$dishes[4]" id="afternoon-snack">
            Полдник
        </x-meal-section>
    </section>

    @push('scripts')
        <script>
            document.getElementById('add-dish-img').addEventListener('click', function() {
                event.preventDefault();
                document.getElementById('add-img-input').click();
            });
            document.getElementById('add-img-input').addEventListener('click', function(event) {
                event.stopPropagation();
            });
            document.getElementById('add-img-input').addEventListener('change', function(event) {
                const input = event.target;
                const chosenImgName = document.getElementById('chosen-img-name');
                const clipImage = document.querySelector('.chosen-img img');
                const removeImgButton = document.querySelector('.remove-img');
                const imgInfo = document.querySelector('.img-info');
                const chosenImg = document.querySelector('.chosen-img');
                
                if (input.files && input.files[0]) {
                    const fileName = input.files[0].name;
                    chosenImgName.textContent = fileName;
                    clipImage.style.display = 'inline-block';
                    removeImgButton.style.display = 'inline-block';
                    imgInfo.style.borderTop = '1px solid var(--grey-border)';
                    chosenImg.style.borderBottom = '1px solid var(--black-text)';
                } else {
                    chosenImgName.textContent = '';
                    clipImage.style.display = 'none';
                    removeImgButton.style.display = 'none';
                    imgInfo.style.borderTop = 'none';
                    chosenImg.style.borderBottom = 'none';
                }
            });
        </script>
        <script src="js/open-dish-info-card.js"></script>
        <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
    @endpush
</x-layout>