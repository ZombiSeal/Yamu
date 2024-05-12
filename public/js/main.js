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

let phone = document.querySelector('#phone');
let mask;

if(phone) {
    phone.addEventListener("focus", (e) => {
        let maskOptions = {
            mask: '+375(00)000-00-00',
            lazy: false
        }
        mask = new IMask(phone, maskOptions);
    })

    phone.addEventListener('blur', (event) => {
        if(mask.unmaskedValue === ''){
            mask.updateOptions(
                {lazy: true}
            )
            mask.destroy();

            event.currentTarget.parentElement.classList.remove('focus');
        }
    })
}
