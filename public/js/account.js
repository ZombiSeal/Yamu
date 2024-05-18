
let accMenuItems = document.querySelectorAll(".ac-menu__item ");
if(accMenuItems.length !== 0) {
    accMenuItems.forEach(item => {
        item.addEventListener('click', () => {
            let link = item.querySelector('.ac-menu__link');
            if(link) window.location = link.href;
        })
    })
}

let inputs = document.querySelectorAll(".validate .input__text");
if (inputs.length !== 0) {
    inputs.forEach(input => {
        input.addEventListener('keyup', () => {
            validateInputs(input);
        })
    })
}

let dataSbmtBtns = document.querySelectorAll('.data-sbmt');

if(dataSbmtBtns.length !== 0) {
    dataSbmtBtns.forEach((sbmt) => {
        sbmt.addEventListener('click', event => {
            event.preventDefault();
            let form = sbmt.closest('form');
            ajaxEditData(form);
        })
    })
}

let cancels = document.querySelectorAll('.cancel');
if(cancels.length !== 0) {
    cancels.forEach(cancel => {
        cancel.addEventListener('click', event => {
           cancelReserve(cancel);
        })
    })
}

function cancelReserve(cancel) {
    fetch('', {
        method:'POST',
        body: new URLSearchParams({id: cancel.closest('.table').getAttribute('data-id')}),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        if(data["status"] === "ok") {
            cancel.closest('.table__action').innerHTML = '<div class="table__no-reserve">Отменено</div>';
        } else {
            alert(data["status"]);
        }

    }).catch((error) => console.log(error));
}
function ajaxEditData(form) {
    fetch(form.getAttribute('action'), {
        method: 'POST',
        body: new FormData(form),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        if(data['status'] === 'ok') {
            alert(data['message']);
        } else {
            setErrors(data["errors"]);
            inputs.forEach(input => {
                input.addEventListener('keyup', () => {
                    validateInputs(input);
                })
            })
        }
    }).catch((error) => console.log(error));
}
