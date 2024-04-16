document.querySelectorAll('.open-info').forEach(function(a){
    a.addEventListener('click', (e) => {
        e.preventDefault();
        window.open(a.href);
    })
})