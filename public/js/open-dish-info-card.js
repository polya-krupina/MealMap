document.addEventListener('DOMContentLoaded', function() {
    var openDishCards = document.querySelectorAll('.open-info');
    var closeButton = document.getElementById('close-card');
    var changeNumberForm = document.getElementById('dish-info-card');
    var darkOverlay = document.getElementById('dark-overlay');

    openDishCards.forEach(function(openDishCard) {
        openDishCard.addEventListener('click', function() {
            document.body.style.overflow = 'hidden';
            changeNumberForm.style.display = 'block';
            darkOverlay.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', function() {
        document.body.style.overflow = 'auto';
        changeNumberForm.style.display = 'none';
        darkOverlay.style.display = 'none';
    });

    darkOverlay.addEventListener('click', function() {
        document.body.style.overflow = 'auto';
        changeNumberForm.style.display = 'none';
        darkOverlay.style.display = 'none';
    });
});