document.addEventListener('DOMContentLoaded', function() {
    const searchContainers = document.querySelectorAll('.meal-info');

    searchContainers.forEach(function(mealInfo) {
        const searchLine = mealInfo.querySelector('.search-line');
        const dishesChoice = mealInfo.querySelector('.dishes-choice');
        const searchLineContainer = mealInfo.querySelector('.search-container');
        const darkOverlay = document.getElementById('dark-overlay');
        console.log('Я работаю');

        searchLine.addEventListener('focus', function() {
            mealInfo.style.backgroundColor = '#EAEAEA';
            dishesChoice.style.display = 'flex';
            dishesChoice.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
            searchLineContainer.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
        });

        document.addEventListener('click', function(event) {
            if (!searchLineContainer.contains(event.target) && !dishesChoice.contains(event.target) && !darkOverlay.contains(event.target)) {
                mealInfo.style.backgroundColor = '#F6F6F6';
                console.log('АЛО, Я РАБОТАЮ')
                dishesChoice.style.display = 'none';
                dishesChoice.style.boxShadow = 'none';
                searchLineContainer.style.boxShadow = 'none';
            }
        });
    });
});
