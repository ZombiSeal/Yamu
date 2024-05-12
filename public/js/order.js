let tabs = document.querySelectorAll('.tabs');
if(tabs) {
    tabs.forEach(tab => {
        tab.addEventListener('click', (event) => {
            let tabName = event.target.getAttribute('data-tab');
            let tabSect = event.target.parentElement.getAttribute('data-sect');

            let currentContent = document.querySelector('.tab-content[data-tab="'+tabName+'"]');
            let activeTab = document.querySelector('.tabs[data-sect="' +tabSect+'"] .tabs__item.active');
            let activeContent = document.querySelector('.tab-content[data-sect="' +tabSect+'"].show');

            if(currentContent && activeContent && activeTab) {
               activeTab.classList.remove('active');
                activeContent.classList.remove('show');

                event.target.classList.add('active');
                currentContent.classList.add('show');
            }
            // console.log(content);
        })
    });
}

let payments = document.querySelectorAll('.payment__item');
if(payments) {
    payments.forEach(payment => {
        payment.addEventListener('click', (event) => {
            let active = document.querySelector('.payment__item.active');
            active.classList.remove('active');
            event.target.classList.add('active');
        })
    })
}
