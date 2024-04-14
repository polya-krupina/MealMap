document.addEventListener('DOMContentLoaded', function() {
    const searchLines = document.querySelectorAll('.search-line');

    searchLines.forEach(function(searchLine) {
        searchLine.addEventListener('input', function() {
            const searchText = this.value.toLowerCase().trim();
            const dishCards = this.closest('.add-dish').querySelectorAll('.dish-card');

            dishCards.forEach(function(dishCard) {
                const composition = dishCard.querySelector('.main-dish-info h2').textContent.toLowerCase();
                if (composition.includes(searchText)) {
                    dishCard.style.display = 'block';
                } else {
                    dishCard.style.display = 'none';
                }
            });
        });
    });
});