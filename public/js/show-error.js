let error = document.querySelector('.error-notification');

function showError(message){
    error.innerHTML = message;
    error.style.display = 'inline-block';

    setTimeout(hideError, 4*1000);
}

function hideError(){
    error.style.display = 'none';
}