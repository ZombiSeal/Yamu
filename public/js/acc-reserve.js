let cancel = document.querySelector('.cancel') || '';
if(cancel.length !== 0) {
    cancel.addEventListener('click', event => {
        // console.log(cancel.closest('.table').getAttribute('data-id'));
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
                alert(data["status"]);
                cancel.remove();
            } else {
                alert(data["status"]);
            }

        }).catch((error) => console.log(error));
    })

}
