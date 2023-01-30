const buttons = document.querySelectorAll('.x-animation');

buttons.forEach(button => button.addEventListener('click', () => {
    const id = button.id;
    console.log(id);
    fetch(`/remove/${id}`)
        .then(function () {
            window.location.reload();
        })
    }
));