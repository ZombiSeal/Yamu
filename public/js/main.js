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

setInputs();
setPhoneMask();


function setPhoneMask() {
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
}
function setInputs() {
    let inputs = document.querySelectorAll(".validate .input__text");
    if (inputs.length !== 0) {
        inputs.forEach(input => {
            input.addEventListener('keyup', () => {
                validateInputs(input);
            })
        })
    }
}
function validateInputs(input){
    let inputLength = 2;
    let errorBlock = input.parentElement.nextElementSibling;

    if(input.value.length === 0) {
        if(!input.parentElement.classList.contains('no-require')) {
            errorBlock.innerHTML = "Заполните поле";
        } else {
            errorBlock.innerHTML = "";
            input.classList.remove('error');
        }
    } else {
        let isMinInput = input.value.length >= inputLength;
        input.classList.toggle('error', !isMinInput);
        errorBlock.innerHTML = (!isMinInput) ? "Недостаточная длина" : "";

        if (input.id === 'phone') {
            let phoneRegex = /\+375\((29|33|44|17|25)\)\d{3}-\d{2}-\d{2}/;
            let isValidPhone = phoneRegex.test(input.value);
            input.classList.toggle('error', !isValidPhone);
            errorBlock.innerHTML = (!isValidPhone) ? "Неверный формат телефона" : "";

            if(mask.unmaskedValue === '') {
                if(!input.parentElement.classList.contains('no-require')) {
                    errorBlock.innerHTML = "Заполните поле";
                } else {
                    errorBlock.innerHTML = "";
                    input.classList.remove('error');
                }
            }
        }

        if (input.id === 'email') {
            let emailRegex = /.+?@.+\.([a-z]{1,4}\.)?[a-z]{1,4}/;
            let isValidEmail = emailRegex.test(input.value);
            input.classList.toggle('error', !isValidEmail);
            errorBlock.innerHTML = (!isValidEmail) ? "Неверный формат email" : "";
        }

        if (input.id === 'password') {
            let isValidPassword = (input.value.length >= 6);
            input.classList.toggle('error', !isValidPassword);
            errorBlock.innerHTML = (!isValidPassword) ? "Ненадежный пароль(минимум 6 символов)" : "";
        }

        if (input.id === 'password_repeat') {
            let isValidRepeat = input.value === document.querySelector('#password').value;
            input.classList.toggle('error', !isValidRepeat);
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
            let errorInput = document.querySelector('input[name="' + key + '"]');
            errorInput.classList.add('error');
            let errorBlock = errorInput.parentElement.nextElementSibling;
            if (errorBlock) {
                errorBlock.innerHTML = dataErrors[key];
            }
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
function setNumber() {
    let numbers = document.querySelectorAll('.number__btn');
    if(numbers.length !== 0) {
        numbers.forEach(number => {
            number.addEventListener('click', (event) => {
                let action = number.getAttribute('data-action');
                let numberText = number.previousElementSibling || number.nextElementSibling;

                if(action && numberText) {
                    let currentNumber = numberText.innerHTML;
                    if(action === 'minus' && currentNumber > 0) currentNumber--;
                    if(action === 'plus') currentNumber++;
                    numberText.innerHTML = currentNumber;
                }
            })
        })
    }
}

