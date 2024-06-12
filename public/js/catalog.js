let numbers = document.querySelectorAll('.number__btn');
setNumber(numbers);

let catalogCardLink = document.querySelectorAll('.product-card__link');
if (catalogCardLink.length !== 0) {
    catalogCardLink.forEach(link => {
        link.addEventListener('mouseenter', () => {
            link.closest('.product-card').classList.add('hover');
        })
        link.addEventListener('mouseleave', () => {
            link.closest('.product-card').classList.remove('hover');
        })
    })
}


let basketBtns = document.querySelectorAll('.basket-btn');
if (basketBtns.length !== 0) {
    basketBtns.forEach(btn => {
        btn.addEventListener('click', addToBasket)
    })
}

let numberBtns = document.querySelectorAll('.number-basket[data-type="order"] .number__btn');
if(numberBtns.length !== 0) {
    numberBtns.forEach(btn => {
        btn.addEventListener('click', addToBasket)
    })
}

let delBtns = document.querySelectorAll('.basket-card[data-type="order"] .basket-card__del');
if(delBtns.length !== 0) {
    delFromBasket(delBtns);
}
let tabs = document.querySelectorAll('.tabs');
if (tabs.length !== 0) {
    tabs.forEach(tab => {
        tab.addEventListener('click', (event) => {
            let tabName = event.target.getAttribute('data-tab');
            let tabSect = event.target.parentElement.getAttribute('data-sect');

            let currentContent = document.querySelector('.tab-content[data-tab="' + tabName + '"]');
            let activeTab = document.querySelector('.tabs[data-sect="' + tabSect + '"] .tabs__item.active');
            let activeContent = document.querySelector('.tab-content[data-sect="' + tabSect + '"].show');

            if (currentContent && activeContent && activeTab) {
                activeTab.classList.remove('active');
                activeContent.classList.remove('show');

                event.target.classList.add('active');
                currentContent.classList.add('show');
            }
        })
    });
}

let payments = document.querySelectorAll('.payment__item');
if (payments.length !== 0) {
    payments.forEach(payment => {
        payment.addEventListener('click', (event) => {
            let active = document.querySelector('.payment__item.active');
            active.classList.remove('active');
            event.target.classList.add('active');
        })
    })
}

setInputs();
setPhoneMask();

let orderForm = document.querySelector('.order__form');
if(orderForm) {
    let form = document.querySelector('.order__form');
    if(form) {
        let sbmtBtn = form.querySelector('.smbt');
        sbmtBtn.addEventListener('click', (event) => {
            event.preventDefault();
            if(parseFloat(document.querySelector('.full-price').innerHTML) <= 23) {
                showPopup("Сумма заказа недостаточна");
                return false;
            }
            let formData = new FormData(form);
            let delivery = document.querySelector('.tabs[data-sect="delivery"] .active').getAttribute('data-id');
            let payment = document.querySelector('.payment .active').getAttribute('data-id');
            let additionsElem = document.querySelectorAll('.addition .addition__item');
            // let additions = [];
            if(additionsElem.length !== 0) {
                additionsElem.forEach(elem => {
                        let additionNumber = elem.querySelector('.number__txt').innerHTML;
                        if(additionNumber > 0) {
                            let additionId = +elem.getAttribute('data-id');
                            formData.append("additions["+additionId+"]", additionNumber);
                        }
                })
            }
            let coupon = document.querySelector('.coupon');
            let couponId = (coupon) ? coupon.getAttribute('data-id') : '';

            let time = document.querySelector('.tabs[data-sect="time"] .active').getAttribute('data-tab');
            if(time === "fast") formData.set('time', '')

            formData.append("delivery", delivery);
            formData.append("payment", payment);
            formData.append("coupon", couponId);


            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                }
            }).then(res => {
                return res.json();
            }).then(data => {
                if(data["status"] === "ok") {
                    showPopup(data["message"]);
                    let close = document.querySelector('.popup .close');
                    close.addEventListener('click', () => {
                        if(data["auth"]) {
                            window.location.href = '/account/orders';
                        } else {
                            window.location.href = '/';
                        }

                    })
                    console.log(close);
                    console.log(data);
                }

                if(data["status"] === "error") {
                    for (let key in data["errors"]) {
                        let errorInput = document.querySelector('input[name="' + key + '"]');
                        errorInput.classList.add('error');
                    }

                    const errorElem = document.querySelector('.input__text.error');
                    if (errorElem) {
                        errorElem.scrollIntoView({ block: "center" ,behavior: 'smooth' });
                    }
                }

            }).catch((error) => console.log(error));
        })

    }
}

let couponBtn = document.querySelector('.coupon-btn');
if(couponBtn) {
    couponBtn.addEventListener('click', addCoupon)
}

function addCoupon() {
    let coupon = document.querySelector('.input-coupon input');
    if(coupon) coupon = coupon.value;
    if(coupon.length !== 0) {
        fetch("/basket/coupon", {
            method: 'POST',
            body: new URLSearchParams({coupon: coupon}),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
            }
        }).then(res => {
            return res.json();
        }).then(data => {
            if(data["status"] === "ok") {
                let couponCard = document.querySelector('.coupon');
                if(couponCard) couponCard.remove();

                let orderBlock = document.querySelector('.order__block');
                if(orderBlock) {
                    orderBlock.insertAdjacentHTML('beforeend', data["view"]);
                }

                let couponPrice = document.querySelector('.coupon-price');
                if(couponPrice) {
                    couponPrice.innerHTML = data["newPrice"] + " руб.";
                    couponPrice.setAttribute('data-sale', data["salePrice"]);
                }
                delCoupon();
            }

            if(data["status"] === "error") {
                showPopup(data["message"]);
            }
        }).catch((error) => console.log(error));
    }

}
function delCoupon() {
    let couponDel = document.querySelector('.coupon__del');
    if(couponDel) {
        couponDel.addEventListener('click', () => {
            let couponPrice = document.querySelector('.coupon-price');
            let fullPrice = document.querySelector('.full-price');

            if(couponPrice) {
                let price = parseFloat(couponPrice.innerHTML);
                let sale = parseFloat(couponPrice.getAttribute('data-sale'));
                let noSalePrice =  (price + sale).toFixed(2);
                couponPrice.innerHTML = fullPrice.innerHTML;
                couponPrice.removeAttribute('data-sale');
                couponDel.closest('.coupon').remove();
            }
        })
    }
}



