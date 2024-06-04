
let accMenuItems = document.querySelectorAll(".ac-menu__item ");
if(accMenuItems.length !== 0) {
    accMenuItems.forEach(item => {
        item.addEventListener('click', () => {
            let link = item.querySelector('.ac-menu__link');
            if(link) window.location = link.href;
        })
    })
}

setInputs();
setPhoneMask();

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
    cancels.forEach(cancel => cancel.addEventListener('click', cancelReserve))
}

let accordions = document.querySelectorAll(".accordion button");
if(accordions.length !== 0) {
    accordions.forEach(item => item.addEventListener('click', toggleAccordion));
}

let repeatOrderBtns = document.querySelectorAll('.repeat-order');
if(repeatOrderBtns.length !== 0) {
    repeatOrderBtns.forEach(btn => btn.addEventListener('click', repeatOrder));
}

function toggleAccordion() {
    const itemToggle = this.classList.contains('active');
    const content = this.nextElementSibling;

    for (i = 0; i < accordions.length; i++) {
        accordions[i].nextElementSibling.style.maxHeight = null;
        accordions[i].classList.remove('active');
    }

    if (!itemToggle) {
        content.style.maxHeight = content.scrollHeight + 'px';
        this.classList.add('active');
    }
}
function cancelReserve() {
    fetch('', {
        method:'POST',
        body: new URLSearchParams({id: this.closest('.table').getAttribute('data-id')}),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        if(data["status"] === "ok") {
            this.closest('.table__action').innerHTML = '<div class="table__no-reserve">Отменено</div>';
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
            showPopup(data['message']);
        } else {
            setErrors(data["errors"]);
            setInputs();
        }
    }).catch((error) => console.log(error));
}

function repeatOrder() {
    let orderId = this.closest('.accordion__item').getAttribute('data-id');
    fetch('/catalog/repeat', {
        method: 'POST',
        body: new URLSearchParams({orderId: orderId}),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        setCapacity(data["fullCapacity"]);
    }).catch((error) => console.log(error));
}
