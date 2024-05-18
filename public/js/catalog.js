console.log('catalog');
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

let basketBtns = document.querySelectorAll('.basket');
if (basketBtns.length !== 0) {
    basketBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            let number = btn.previousElementSibling.querySelector('.number__txt');
            let productId = btn.getAttribute('data-id');
            let data = {
                productId: productId,
                capacity: number.innerHTML
            }

            console.log(number.innerHTML);
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
                console.log(data);
                if (data["basket"]) {
                    number.innerHTML = data['basket'][productId] || "0";
                    btn.closest('.product-card').classList.toggle('active', data["basket"][productId])
                }

                document.querySelector('.capacity').classList.toggle('show', data["fullCapacity"])
                document.querySelector('.capacity').innerHTML = data["fullCapacity"] || "";

            }).catch((error) => console.log(error));
        })
    })
}


setNumber();



