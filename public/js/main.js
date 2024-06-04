let burger = document.querySelector('.burger');
if (burger) {
    burger.addEventListener('click', event => {
        document.querySelector('body').classList.toggle('open');
        burger.classList.toggle('open');
        document.querySelector('.nav-mob').classList.toggle('open')
        document.querySelectorAll('.curtain__panel ').forEach(panel => {
            panel.classList.toggle('open');
        })
    })
}

document.addEventListener("DOMContentLoaded", () => {
    let closePopup = document.querySelector(".popup .close");
    if (closePopup) {
        closePopup.addEventListener('click', () => {
            document.querySelector('.popup').classList.remove('show');
        })
    }
})

setInputs();
setPhoneMask();
function setPhoneMask() {
    let phone = document.querySelector('#phone');
    let mask;
    if (phone) {
        phone.addEventListener('keyup', function () {
            let errorBlock = phone.parentElement.nextElementSibling;
            if (mask.unmaskedValue === '') {
                if (!this.parentElement.classList.contains('no-require')) {
                    errorBlock.innerHTML = "Заполните поле";
                } else {
                    errorBlock.innerHTML = "";
                    this.classList.remove('error');
                }
            }
        })

        phone.addEventListener("focus", (e) => {
            let maskOptions = {
                mask: '+375(00)000-00-00',
                lazy: false
            }
            mask = new IMask(phone, maskOptions);
        })

        phone.addEventListener('blur', (event) => {
            if (mask.unmaskedValue === '') {
                mask.updateOptions(
                    {lazy: true}
                )
                mask.destroy();
                event.currentTarget.parentElement.classList.remove('focus');
            }
        })

    }
}

function setInputs() {
    let inputs = document.querySelectorAll(".validate .input__text");
    if (inputs.length !== 0) {
        inputs.forEach(input => input.addEventListener('keyup', validateInputs))
    }
}

function validateInputs() {
    let inputLength = 2;
    let errorBlock = this.parentElement.nextElementSibling;

    if (this.parentElement.classList.contains('no-text')) {
        errorBlock = "";
    }

    if (this.parentElement.classList.contains('number')) {
        this.value = this.value.replace(/[^0-9.]/g, '');
        inputLength = 1;
    }

    if (this.value.length === 0) {
        if (!this.parentElement.classList.contains('no-require')) {
            this.classList.add('error');
            errorBlock.innerHTML = "Заполните поле";
        } else {
            errorBlock.innerHTML = "";
            this.classList.remove('error');
        }
    } else {
        let isMinInput = this.value.length >= inputLength;
        this.classList.toggle('error', !isMinInput);
        errorBlock.innerHTML = (!isMinInput) ? "Недостаточная длина" : "";

        if (this.id === 'phone') {
            let phoneRegex = /\+375\((29|33|44|17|25)\)\d{3}-\d{2}-\d{2}/;
            let isValidPhone = phoneRegex.test(this.value);
            this.classList.toggle('error', !isValidPhone);
            errorBlock.innerHTML = (!isValidPhone) ? "Неверный формат телефона" : "";
        }

        if (this.id === 'email') {
            let emailRegex = /.+?@.+\.([a-z]{1,4}\.)?[a-z]{1,4}/;
            let isValidEmail = emailRegex.test(this.value);
            this.classList.toggle('error', !isValidEmail);
            errorBlock.innerHTML = (!isValidEmail) ? "Неверный формат email" : "";
        }

        if (this.id === 'password') {
            let isValidPassword = (this.value.length >= 6);
            this.classList.toggle('error', !isValidPassword);
            errorBlock.innerHTML = (!isValidPassword) ? "Ненадежный пароль(минимум 6 символов)" : "";
        }

        if (this.id === 'password_repeat') {
            let isValidRepeat = this.value === document.querySelector('#password').value;
            this.classList.toggle('error', !isValidRepeat);
            errorBlock.innerHTML = (!isValidRepeat) ? "Неверный пароль" : "";
        }


    }
}

function setErrors(dataErrors) {
    let errors = document.querySelectorAll('.input-error');
    if (errors.length !== 0) {
        errors.forEach(error => {
            error.innerHTML = "";
        })
    }

    for (let key in dataErrors) {
        if (key !== 'number') {
            let errorInputs = document.querySelectorAll('input[name="' + key + '"]');
            errorInputs.forEach(errorInput => {
                errorInput.classList.add('error');
                let errorBlock = errorInput.parentElement.nextElementSibling;
                if (errorBlock) {
                    errorBlock.innerHTML = dataErrors[key];
                }
            })

        } else {
            if (!document.querySelector('.table-error')) {
                let errorElem = document.createElement('div');
                errorElem.textContent = dataErrors[key];
                errorElem.classList.add('table-error');
                form.insertBefore(errorElem, document.querySelector('.rest'));
            }
        }
    }
}

function setNumber(numbers) {
    if (numbers.length !== 0) {
        numbers.forEach(number => {
            number.addEventListener('click', (event) => {
                event.preventDefault();
                let action = number.getAttribute('data-action');
                let numberText = number.previousElementSibling || number.nextElementSibling;

                if (action && numberText) {
                    let currentNumber = numberText.innerHTML;
                    if (action === 'minus' && currentNumber > 0) currentNumber--;
                    if (action === 'plus') currentNumber++;
                    numberText.innerHTML = currentNumber;
                }
            })
        })
    }
}

function showPopup(message) {
    let popup = document.querySelector('.popup');
    if (popup) {
        popup.classList.add('show');
        popup.querySelector('.popup__message').innerHTML = message;
    }
}
