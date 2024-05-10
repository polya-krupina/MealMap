let card = document.querySelector('#dish-info-card');

let dishName = card.querySelector('h4');
let price = card.querySelector('.price');
let products = card.querySelector('.composition-text');
let spisok = card.querySelector('.values-list');

// document.querySelectorAll('.open-info').forEach(function(a){
//     a.addEventListener('click', (e) => {
        
//     })
// });

function validate_products(products){
    let returning = '';
    products.forEach((p) => {
        let word = p.name;
        returning += word.charAt(0).toUpperCase() + word.slice(1) + ', ';
    });
    return returning.slice(1, -2);
}



document.addEventListener('DOMContentLoaded', function() {
    var openDishCards = document.querySelectorAll('.open-info');
    var closeButton = document.getElementById('close-card');
    var changeNumberForm = document.getElementById('dish-info-card');
    var darkOverlay = document.getElementById('dark-overlay');

    openDishCards.forEach(function(openDishCard) {
        let dish_id = openDishCard;
        if (dish_id.dataset.id != null)
            dish_id = openDishCard.dataset.id;
        else 
            dish_id = openDishCard.closest('.dish-card').dataset.id;
        openDishCard.addEventListener('click', function(e) {
            e.preventDefault();
            axios.get('/dish/' + dish_id).then( (response) => {
                dishName.innerHTML = response.data.name;
                price.innerHTML = response.data.price + '₽';
                callories.innerHTML = callories.innerHTML.split(' ')[0] + ' ' + response.data.callories;
                proteins.innerHTML = proteins.innerHTML.split(' ')[0] + ' ' + response.data.proteins;
                fats.innerHTML = fats.innerHTML.split(' ')[0] + ' ' + response.data.fats;
                carbohydrates.innerHTML = carbohydrates.innerHTML.split(' ')[0] + ' ' + response.data.carbohydrates;
                products.innerHTML = validate_products(response.data.products);
                document.body.style.overflow = 'hidden';
                changeNumberForm.style.display = 'block';
                darkOverlay.style.display = 'block';
                console.log(card);
            });
            
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