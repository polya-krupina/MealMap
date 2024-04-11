document.addEventListener('DOMContentLoaded', function() {
    const searchContainers = document.querySelectorAll('.add-dish');
    var darkOverlay = document.getElementById('dark-overlay');

    searchContainers.forEach(function(searchContainer) {
        const searchLine = searchContainer.querySelector('.search-line');
        const dishesChoice = searchContainer.querySelector('.dishes-choice');
        const searchLineContainer = searchContainer.querySelector('.search-container');

        searchLine.addEventListener('focus', function() {
            dishesChoice.style.display = 'flex';
            dishesChoice.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
            searchLineContainer.style.boxShadow = '2px 2px 20px 0px rgba(0, 0, 0, 0.10)';
        });

        document.addEventListener('click', function(event) {
            if (!searchContainer.contains(event.target) && !dishesChoice.contains(event.target) && !darkOverlay.contains(event.target)) {
                dishesChoice.style.display = 'none';
            dishesChoice.style.boxShadow = 'none';
            searchLineContainer.style.boxShadow = 'none';
            }
        });
    });
});