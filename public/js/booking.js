let form = document.querySelector('.book-form');
let date = document.querySelector('input[type="date"]');
date.value =new Date().toISOString().slice(0,10);

form.addEventListener('submit', event => {
    event.preventDefault();
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
        if(data["status"] === "ok") {
            alert(data["message"]);
            updateTables();
        } else {
            alert(data["errors"]);
        }

    }).catch((error) => console.log(error));
})



date.addEventListener('change', event => {
   updateTables();
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
        if (document.querySelector('.table>input:checked'))
            document.querySelector('.table>input:checked').checked = false;

        if(data.length !== 0) {
            let tables = document.querySelectorAll('.table') || [];
            if(tables.length !== 0) {
                tables.forEach(table => {
                    if (data.includes(+table.getAttribute('data-number'))) {
                        table.classList.add('table--reserve');
                        table.querySelector("input").disabled = true;
                    }
                })
            }
        } else {
            let bookTables = document.querySelectorAll('.table--reserve') || [];
            if(bookTables.length !== 0) {
                bookTables.forEach(table => {
                    table.classList.remove('table--reserve')
                    table.querySelector("input").disabled = false;
                })
            }
        }
    }).catch((error) => console.log(error));
}
