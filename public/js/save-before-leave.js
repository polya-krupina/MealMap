let saved = false;
function save(){
    saved = true;
    let breakfast = document.getElementsByName('breakfast')[0];
    let second_breakfast = document.getElementsByName('second_breakfast')[0];
    let dinner = document.getElementsByName('dinner')[0];
    let half_day = document.getElementsByName('half_day')[0];

    breakfast.value = meals[0];
    second_breakfast.value = meals[1];
    dinner.value = meals[2];
    half_day.value = meals[3];
}


window.addEventListener('beforeunload', function (e) {
    var confirmationMessage = 'Are you sure you want to leave?';  // Set a custom confirmation message
    if (saved){
        return false;
    }

    e.returnValue = confirmationMessage;     // Gecko, Trident, Chrome 34+
    return confirmationMessage;              // Gecko, WebKit, Chrome <34
});