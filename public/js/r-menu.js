let btns = document.querySelectorAll('.r-menu__item.content-link') || []

if(btns.length !== 0) {
    btns.forEach(btn => {
        btn.addEventListener('click',event => {
            event.preventDefault();
            menuRoute(btn);
        })
    })
}

document.addEventListener('click', event => {
    if(event.target.classList.contains('reg-link')) {
        event.preventDefault();
        let linkParams = event.target.href + "/?page=" + event.target.getAttribute('data-page');
        getMenuContent(linkParams);
    }
    if(event.target.parentElement.classList.contains('sbmt')){
        event.preventDefault();
        submitForm(event.target.closest("form"));
    }
})


function getMenuContent(url) {
    fetch(url, {
        method:'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.text();
    }).then(data => {
        document.querySelector(".r-menu-wrapper__content").innerHTML = data;
       init();
    }).catch((error) => console.log(error));
}
function submitForm(form) {
    let formData = new FormData(form);
    fetch(form.getAttribute('action'), {
        method:'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        console.log(data);

        if(data["errors"]) {
            setErrors(data["errors"]);
        }

        if(data["loginError"]) {
            let errorBlock = document.createElement('div');
            errorBlock.classList.add('form__error');
            errorBlock.innerHTML = data["loginError"];
            form.insertBefore(errorBlock, document.querySelector('.form__row'));
        }

        if(data["status"] === "ok") {
            window.location = '/account';
        }

    }).catch((error) => console.log(error));

}

function menuRoute(btn) {
    let menuContent = document.querySelector(".r-menu-wrapper");
    let link = btn.querySelector('.r-menu__link');
    let linkParams = link.href + "/?page=" + link.getAttribute('data-page');

    getMenuContent(linkParams);

    if (btn.classList.contains('active')) {
        btn.classList.remove('active');
        menuContent.classList.remove('show');
        document.querySelector('body').classList.remove('open');
        document.querySelector('main').classList.remove('blur');
        document.querySelector('header').classList.remove('blur');
    } else {
        btns.forEach(elem => {
            elem.classList.remove('active');
        })
        btn.classList.add('active');
        menuContent.classList.add('show');
        document.querySelector('body').classList.add('open');
        document.querySelector('main').classList.add('blur');
        document.querySelector('header').classList.add('blur');
    }
}

function init() {
    setInputs();
    setNumber();
}
