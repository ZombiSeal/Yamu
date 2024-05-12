let form = document.querySelector('.book-form');
let btnSbmt = document.querySelector('.book-form__sbmt');
let date = document.querySelector('input[type="date"]');
date.value = new Date().toISOString().slice(0, 10);

let tables = document.querySelectorAll('.table');
if (tables.length !== 0) {
    tables.forEach(table => {
        table.addEventListener('click', () => {
            checkTable(table)
        });
    })
}
document.addEventListener('DOMContentLoaded', updateTables);
date.addEventListener('change', updateTables);

let inpunts = document.querySelectorAll("input[type='text']");
if (inpunts.length !== 0) {
    inpunts.forEach(input => {
        input.addEventListener('keyup', () => {
            let inputLength = 2;
            let errorBlock = input.parentElement.nextElementSibling;

            if(input.value.length !== 0) {
                if (input.value.length >= inputLength) {
                    if (input.name === 'phone') {
                        let phoneRegex = /\+375\((29|33|44|17|25)\)\d{3}-\d{2}-\d{2}/;
                        let isValidPhone = phoneRegex.test(input.value);
                        input.classList.toggle('error', !isValidPhone);
                        errorBlock.innerHTML = (!isValidPhone) ? "Неверный формат телефона" : "";
                    } else {
                        input.classList.remove('error');
                        if (errorBlock) errorBlock.innerHTML = "";
                    }
                } else {
                    input.classList.add('error');
                    if(errorBlock) errorBlock.innerHTML = "Недостаточная длина";
                }
            } else {
                if(errorBlock) errorBlock.innerHTML = "Заполните поле";
            }

        })
    })
}
btnSbmt.addEventListener('click', event => {
    event.preventDefault();
    formSubmit();
})


function updateTables() {
    fetch('/booking/update', {
        method: 'POST',
        body: new URLSearchParams({date: date.value}),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        if (document.querySelector('.table.check'))
            document.querySelector('.table.check').classList.remove('check');

        if (data.length !== 0) {
            let tables = document.querySelectorAll('.table') || [];
            if (tables.length !== 0) {
                tables.forEach(table => {
                    if (data.includes(+table.getAttribute('data-number'))) {
                        table.classList.add('reserve');
                    }
                })
            }
        } else {
            let bookTables = document.querySelectorAll('.table.reserve') || [];
            if (bookTables.length !== 0) {
                bookTables.forEach(table => {
                    table.classList.remove('reserve')
                })
            }
        }
    }).catch((error) => console.log(error));
}

function formSubmit() {
    let formData = new FormData(form);
    let checkTable = document.querySelector('.table.check');
    let tableNumber = (checkTable) ? checkTable.getAttribute('data-number') : "";
    formData.append('number', tableNumber);

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
        if (data["status"] === "ok") {
            alert(data["message"]);
            updateTables();
        } else {
            if(data["errors"].length !== 0) {
                setErrors(data["errors"]);
            }
        }
    }).catch((error) => console.log(error));
}

function checkTable(table) {
    let error = document.querySelector('.table-error');
    if (error) error.remove();
    let checkTable = document.querySelector('.table.check');
    if (checkTable && !table.classList.contains('check')) {
        checkTable.classList.remove('check');
    }

    if (!table.classList.contains('reserve')) {
        table.classList.toggle('check');
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
