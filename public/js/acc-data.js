let forms = document.querySelectorAll('form') || '';
if(forms.length !== 0) {
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault();
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
                    document.querySelector('.error-data').innerHTML = "";
                    alert(data['message']);
                } else {
                    document.querySelector('.error-data').innerHTML = "";
                    for(key in data["errors"]) {
                        let error = document.createElement('div');
                        error.setAttribute('class', 'error');
                        error.innerHTML = key + ":" + data["errors"][key];
                        document.querySelector('.error-data').appendChild(error);
                    }
                }
               console.log(data);

            }).catch((error) => console.log(error));
        })
    })
    // cancel.addEventListener('click', event => {
    //     // console.log(cancel.closest('.table').getAttribute('data-id'));
    //     fetch('', {
    //         method:'POST',
    //         body: new URLSearchParams({id: cancel.closest('.table').getAttribute('data-id')}),
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest',
    //             'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
    //         }
    //     }).then(res => {
    //         return res.json();
    //     }).then(data => {
    //         if(data["status"] === "ok") {
    //             alert(data["status"]);
    //             cancel.remove();
    //         } else {
    //             alert(data["status"]);
    //         }
    //
    //     }).catch((error) => console.log(error));
    // })

}
