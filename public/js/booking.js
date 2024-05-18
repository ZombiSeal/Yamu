let form = document.querySelector('.book-form');
let btnSbmt = document.querySelector('.book-form__sbmt');
let date = document.querySelector('input[type="date"]');
let time = document.querySelector('input[type="time"]');
date.value = new Date().toISOString().slice(0, 10);
let isEditLink = document.querySelector('.current-info');


let tables = document.querySelectorAll('.table');
if (tables.length !== 0) {
    tables.forEach(table => {
        table.addEventListener('click', () => {
            checkTable(table)
        });
    })
}
document.addEventListener('DOMContentLoaded', () => {
    setCurrentTime();

    if (isEditLink) {
        date._flatpickr.setDate(document.querySelector('input[name="currentDate"]').value);
        time._flatpickr.setDate(document.querySelector('input[name="currentTime"]').value);
        setEditTable();
    }

    updateTables();
});
date.addEventListener('change', () => {
    setCurrentTime();

    if (isEditLink) {
        time._flatpickr.setDate(document.querySelector('input[name="currentTime"]').value);
        setEditTable();
    }

    updateTables();
});

btnSbmt.addEventListener('click', event => {
    event.preventDefault();
    formSubmit();
})

function setCurrentTime() {
    let currentDate = getCurrentDate();
    if (date.value === currentDate && (new Date().getHours() <= 22 && new Date().getHours() >= 10)) {
        time._flatpickr.setDate(getCurrentTime());
        time._flatpickr.set('minTime', getCurrentTime());
    } else {
        time._flatpickr.setDate("10:00");
        time._flatpickr.set('minTime', "10:00");
    }
}

function getCurrentDate() {
    const date = new Date();
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    return `${day}.${month}.${year}`;
}

function getCurrentTime() {
    const date = new Date();
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    return `${hours}:${minutes}`;
}

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
                    let isReserve = data.includes(+table.getAttribute('data-number'));
                    table.classList.toggle('reserve', isReserve);
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
    formData.append('action', form.getAttribute('data-action'));
    if (isEditLink) formData.append('currentNumber', document.querySelector('input[name="currentNumber"]').value);

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
        }
        if (data["status"] === "edit") {
            window.location = "/account/reserve";
        }
        if (data["status" === "error"]) {
            if (data["errors"].length !== 0) {
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

function setEditTable() {
    let editNumber = document.querySelector('input[name="currentNumber"]').value;
    let editDate = document.querySelector('input[name="currentDate"]').value;
    let table = document.querySelector('.table[data-number="' + editNumber + '"]');
    let isEditTable = date.value === editDate;
    table.classList.toggle('edit', isEditTable);
}

