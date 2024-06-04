let btns = document.querySelectorAll('.r-menu__item.content-link') || []

if(btns.length !== 0) {
    btns.forEach(btn => {
        btn.addEventListener('click',event => {
            event.preventDefault();
            menuRoute(btn);

            // if(menuLinks.length !== 0) {
            //
            // }
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

    if(event.target.classList.contains('r-menu-wrapper') && event.target.classList.contains('show')){
        event.preventDefault();
        btns.forEach(elem => {
            elem.classList.remove('active');
        })
        document.querySelector(".r-menu-wrapper").classList.remove('show');
        document.querySelector('body').classList.remove('open');
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

        if(data["status"] === "redirect") {
            window.location.href = data["redirect"];
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
    } else {
        btns.forEach(elem => {
            elem.classList.remove('active');
        })
        btn.classList.add('active');
        menuContent.classList.add('show');
        document.querySelector('body').classList.add('open');
    }
}

function setActiveMenuLink() {
    let currentUrl = window.location.pathname;
    let lastPart = currentUrl.split("/").pop();
    let activeLink = document.querySelector('.menu__link[data-code="' +lastPart+'"]');
    if(activeLink) {
        activeLink.classList.add('active');
    }
}
function changeBasket() {
    let basketBtns = document.querySelectorAll('.number-basket[data-type="basket"] .number__btn');
    if (basketBtns.length !== 0) {
        basketBtns.forEach(btn => {
            btn.addEventListener('click', addToBasket)
        })
    }
}


function addToBasket() {
    let number = this.closest('.number') || this.previousElementSibling;
    let numberTxt = number.querySelector('.number__txt');
    let product = this.closest('.basket-card') || this;
    let productId = product.getAttribute('data-id');

    let data = {
        productId: productId,
        capacity: numberTxt.innerHTML
    }

    fetch("/catalog/add", {
        method: 'POST',
        body: new URLSearchParams(data),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        changeBasketView(data, this, productId);
    }).catch((error) => console.log(error));

}

function delFromBasket(delBasketBtns) {
    if (delBasketBtns.length !== 0) {
        delBasketBtns.forEach(delBtn => {
            delBtn.addEventListener('click', () => {
                let product = delBtn.closest('.basket-card');
                let productId = product.getAttribute('data-id');
                fetch("/catalog/del", {
                    method: 'POST',
                    body: new URLSearchParams({productId: productId}),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                }).then(res => {
                    return res.json();
                }).then(data => {
                    changeBasketView(data, delBtn, productId);
                }).catch((error) => console.log(error));
            })
        })
    }
}

function clearBasket() {
    let clearBtn = document.querySelector('.basket__clear');
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            console.log("hello");
            fetch("/catalog/clear", {
                method: 'POST',
                body: new URLSearchParams(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                }
            }).then(res => {
                return res.json();
            }).then(data => {
                clear(data);
                setCapacity(0);
            }).catch((error) => console.log(error));
        })
    }
}

function changeBasketView(data, btn, productId) {
    console.log(btn);
    if (data["basket"].length !== 0) {
        let detailProduct = document.querySelector('.detail__info');
        if(detailProduct) {
            detailProduct.querySelector('.number__txt').innerHTML = (data['basket'][productId]) ? data['basket'][productId]["capacity"] : 0;
        }

        let currentProduct = document.querySelector('.product-card[data-id="' + productId + '"]');
        if(currentProduct) {
            currentProduct.classList.toggle('active', data["basket"][productId]);
            currentProduct.querySelector('.number__txt').innerHTML = (data['basket'][productId]) ? data['basket'][productId]["capacity"] : 0;
        }

        let orderProduct = document.querySelector('.order__list .basket-card[data-id="'+productId+'"]');
        if(orderProduct) {
            orderProduct.querySelector('.number__txt').innerHTML = (data['basket'][productId]) ? data['basket'][productId]["capacity"] : 0;
        }

        if (btn.classList.contains('number__btn') || btn.classList.contains('basket-card__del')) {

            let currentBasketCards = document.querySelectorAll('.basket-card[data-id="'+productId+'"]');
            let fullPriceElements = document.querySelectorAll('.full-price');

            if(currentBasketCards.length !== 0) {
                currentBasketCards.forEach(card => {
                    if (!data["basket"][productId]) {
                        card.remove();
                    }
                    let currentPriceElem = card.querySelector(".basket-card__price");
                    currentPriceElem.innerHTML = (data["basket"][productId]) ? data['basket'][productId]["fullPrice"] + " руб." : 0;
                })
            }

            if(fullPriceElements.length !== 0) {
                fullPriceElements.forEach(elem => {
                    elem.innerHTML = data['fullPrice'] + " руб.";
                })
            }

        }
        let couponPrice = document.querySelector('.coupon-price');
        if(couponPrice) {
            let fullPrice = document.querySelector('.full-price');
            let sale = couponPrice.getAttribute('data-sale');
            if(sale) {
                couponPrice.innerHTML = (parseFloat(fullPrice.innerHTML) * (1 - sale)).toFixed(2) + " руб.";
            } else {
                couponPrice.innerHTML = fullPrice.innerHTML;
            }
        }
    } else {
        clear(data["empty"]);
    }
    setCapacity(data["fullCapacity"]);
}
function clear(data) {
    let productCards = document.querySelectorAll('.product-card');
    if(productCards.length !== 0) {
        productCards.forEach(item => {
            item.classList.remove('active');
            item.querySelector('.number__txt').innerHTML = 0;
        })
    }

    let orderPage = document.querySelector('.order');
    if(orderPage) {
        orderPage.innerHTML = "Корзина пуста, сделайте заказ";
    }
    document.querySelector('.r-menu-wrapper__content').innerHTML = data;
}

function setCapacity(capacity) {
    console.log('hello');
    document.querySelector('.capacity').classList.toggle('show', capacity)
    document.querySelector('.capacity').innerHTML = capacity|| "";
}
function init() {
    let numbers = document.querySelectorAll('.number-basket[data-type="basket"] .number__btn');
    let delBasketBtns = document.querySelectorAll('.basket-card[data-type="basket"] .basket-card__del');

    setInputs();
    setNumber(numbers);
    changeBasket();
    delFromBasket(delBasketBtns);
    clearBasket();
    setActiveMenuLink();
}
