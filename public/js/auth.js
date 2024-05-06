
let link = document.querySelector('.reg-link') || [];
if(link) {
    link.addEventListener('click',event => {
        event.preventDefault();

        let linkParams = link.href + "/?page=" + link.getAttribute('data-page');

        fetch(linkParams, {
            method:'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
            }
        }).then(res => {
            return res.text();
        }).then(data => {
            document.querySelector(".r-menu-wrapper__content").innerHTML = data;
        }).catch((error) => console.log(error));
    })
}
