// let card = document.querySelector('#dish-info-card');

// let dishName = card.querySelector('h4');
// let price = card.querySelector('.price');
// let products = card.querySelector('.composition-text');
// let spisok = card.querySelector('.values-list');

// document.querySelectorAll('.open-info').forEach(function(a){
//     let dish_id = a.closest('.dish-card').dataset.id;
//     a.addEventListener('click', (e) => {
//         e.preventDefault();
//         axios.get('/dish/' + dish_id).then( (response) => {
//             dishName.innerHTML = response.data.name;
//             price.innerHTML = response.data.price + '₽';
//             callories.innerHTML = callories.innerHTML.split(' ')[0] + ' ' + response.data.callories;
//             proteins.innerHTML = proteins.innerHTML.split(' ')[0] + ' ' + response.data.proteins;
//             fats.innerHTML = fats.innerHTML.split(' ')[0] + ' ' + response.data.fats;
//             carbohydrates.innerHTML = carbohydrates.innerHTML.split(' ')[0] + ' ' + response.data.carbohydrates;
//             products.innerHTML = validate_products(response.data.products);
//             console.log(card);
//         });
//     })
// });

// function validate_products(products){
//     let returning = '';
//     products.forEach((p) => {
//         let word = p.name;
//         returning += word.charAt(0).toUpperCase() + word.slice(1) + ', ';
//     });
//     return returning.slice(1, -2);
// }

