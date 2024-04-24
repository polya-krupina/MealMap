let meals = [
    [],
    [],
    [],
    []
];

function checkState(meal){
    let parent = meal.closest('.chosen-dishes');
    let button = meal.querySelector('.remove-dish');
    if (parent){
        button.style.display = 'inline-block';
    } else {
        button.style.display = 'none';
    }

}

function addToMeals(meal, dish){
    meals[meal].push(dish.dataset.id);
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

document.addEventListener("DOMContentLoaded", (event) => {
    document.querySelectorAll('.meal-info').forEach((meal) => {
        let searchList = meal.querySelector('.dishes-choice');
        let chosenList = meal.querySelector('.chosen-dishes');
        let meal_id = mealDetector(meal);

        function add(event, el) {
            if (el.closest('.chosen-dishes'))
                return;
            chosenList.appendChild(el);
            meals[meal_id].push(el.dataset.id);
            checkState(el);
        }

        function remove(event, el){
            event.stopPropagation();
            searchList.appendChild(el);
            meals[meal_id].splice(meals.indexOf(el.dataset.id), 1);
            checkState(el);
        }

        searchList.querySelectorAll('.dish-card').forEach((el) => {
            el.addEventListener('click', (evenet) => add(event, el));
            el.querySelector('.remove-dish').addEventListener('click', (event) => remove(event, el));
        });

        chosenList.querySelectorAll('.dish-card').forEach((el) => {
            el.addEventListener('click', (evenet) => add(event, el));
            el.querySelector('.remove-dish').addEventListener('click', (event) => remove(event, el));
            checkState(el);
            addToMeals(meal_id, el);
        })
    });
});