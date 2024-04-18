document.querySelectorAll('.meal-info').forEach((e) => {
    let searchList = e.querySelector('.dishes-choice');
    let chosenList = e.querySelector('.chosen-dishes');
    let meal_id = mealDetector(e);
    
    searchList.querySelectorAll('.dish-card').forEach((el) => {
        function add(event) {
            chosenList.appendChild(el);
            meals[meal_id].push(el.dataset.id);
            checkState(el);
        }

        function remove(event){
            event.stopPropagation();
            searchList.appendChild(el);
            meals[meal_id].splice(meals.indexOf(el.dataset.id), 1);
            checkState(el);
        }

        el.addEventListener('click', add);
        el.querySelector('.remove-dish').addEventListener('click', remove);
    });
});

function checkState(e){
    let parent = e.closest('.chosen-dishes');
    let button = e.querySelector('.remove-dish');
    if (parent){
        button.style.display = 'inline-block';
    } else {
        button.style.display = 'none';
    }

}

function mealDetector(meal){
    let value = meal.querySelector('h1').innerHTML;
    if (value == 'Завтрак')
        return 0;
    else if (value == 'Второй завтрак')
        return 1;
    else if (value == 'Обед')
        return 2;
    else 
        return 3;
}