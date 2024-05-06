let burger = document.querySelector('.burger');
if(burger) {
    burger.addEventListener('click', event => {
        document.querySelector('body').classList.toggle('open');
        burger.classList.toggle('open');
        document.querySelector('.nav-mob').classList.toggle('open')
        document.querySelectorAll('.curtain__panel ').forEach(panel=> {
            panel.classList.toggle('open');
        })
    })
}
