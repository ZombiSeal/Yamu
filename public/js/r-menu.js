
let btns = document.querySelectorAll('.r-menu__item.content-link') || [];

if(btns.length !== 0) {
    let menuContent = document.querySelector(".r-menu-wrapper");
    btns.forEach(btn => {
        btn.addEventListener('click',event => {
            event.preventDefault();

            let link = btn.querySelector('.r-menu__link');
            let linkParams = link.href + "/?page=" + link.getAttribute('data-page');

            routeMenu(linkParams);

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

        })

    })
}

document.addEventListener('click', event => {
    if(event.target.classList.contains('reg-link')) {
        event.preventDefault();
        let linkParams = event.target.href + "/?page=" + event.target.getAttribute('data-page');
        routeMenu(linkParams);
    }
    if(event.target.classList.contains('form__sbmt')){
        event.preventDefault();
        formAjax(event.target.closest("form"))
    }


})

function routeMenu(url) {
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
    }).catch((error) => console.log(error));
}

function formAjax(form) {
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
        let formErrors = form.querySelectorAll(".error") || [];
        if(formErrors.length) {
            formErrors.forEach(error => {
                error.remove();
            })
        }


        if(data["errors"]) {
            console.log(data["errors"]);
            for(key in data["errors"]) {
                let error = document.createElement('div');
                error.setAttribute('class', 'error');
                error.innerHTML = data["errors"][key];
                document.querySelector('input[name="' + key + '"]').before(error);
            }
        }

        if(data["customError"]) {
            alert(data["customError"])
        }

        if(data["status"] === "ok") {
            alert(data["data"]);
            window.location = '/account';
        }

    }).catch((error) => console.log(error));

}
