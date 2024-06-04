const imageInput = document.getElementById('image-input');
const removeImageButton = document.getElementById('remove-image');

if (imageInput && removeImageButton) {
    const previewImage = document.getElementById('preview-image');
    const previewName = document.getElementById('preview-name');
    setImagePreview(previewImage, previewName);
    imageInput.addEventListener('change', function () {
        setImagePreview(previewImage, previewName);
    });

    removeImageButton.addEventListener('click', function () {
        previewImage.src = '#';
        previewName.textContent = '';
        previewImage.style.display = 'none';
        removeImageButton.style.display = 'none';
        imageInput.value = '';
    });
}


setInputs();
setPhoneMask();


let quizAddBtn = document.querySelector('.add');
if (quizAddBtn) {
    quizAddBtn.addEventListener('click', e => {
        e.preventDefault();
        add(quizAddBtn);
    })
}


let questionsAddBtn = document.querySelectorAll('.questions-add');
if (questionsAddBtn.length !== 0) {
    questionsAddBtn.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            addQuestion(btn);
        })
    })
}

let delBtns = document.querySelectorAll('.del');
if(delBtns.length !== 0) {
    delBtns.forEach(del => {
        del.addEventListener('click', (event) => {
            event.preventDefault()
            showPopup("Хотите удалить элемент?");
            let okPopup = document.querySelector(".popup .ok");
            if (okPopup) {
                okPopup.addEventListener('click', () => {
                    console.log('del');
                    document.querySelector('.popup').classList.remove('show');
                    fetch(del.getAttribute('data-action'), {
                        method: 'POST',
                        body: new URLSearchParams({id: del.getAttribute('data-id')}),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                        }
                    }).then(res => {
                        return res.json();
                    }).then(data => {
                        console.log(data);
                        if (data["status"] === "ok") {
                            del.closest('.admin-container__tr').remove();
                        }
                    }).catch((error) => console.log(error));
                })
            }
        })
    })
}

let radioActive = document.querySelectorAll('.admin-container__radio input');
if(radioActive.length !== 0) {
    radioActive.forEach(radio => {
        radio.addEventListener('change', updateReserve)
    })
}

let selectStatus = document.querySelectorAll('.admin-container__radio select');
if(selectStatus.length !== 0) {
    selectStatus.forEach(select => {
        select.addEventListener('change', updateStatus)
        // select.addEventListener('change', () => {
        //     console.log(select.options[select.selectedIndex]);
        // })

    })
}

function updateStatus() {
    let active = (this.checked) ? 1 : 0;
    fetch('/admin-panel/orders/update', {
        method: 'POST',
        body: new URLSearchParams({
            id: this.getAttribute('data-id'),
            status: this.options[this.selectedIndex].value
        }),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        console.log(data);
    }).catch((error) => console.log(error));
}
function updateReserve() {
    let active = (this.checked) ? 1 : 0;
    fetch('/admin-panel/reserve/update', {
        method: 'POST',
        body: new URLSearchParams({id: this.value, active: active}),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        }
    }).then(res => {
        return res.json();
    }).then(data => {
        console.log(data);
    }).catch((error) => console.log(error));
}
console.log(radioActive);
function add(btn) {
    let form = quizAddBtn.closest('form');
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
        if (data["status"] === "error") {
            setErrors(data["errors"]);
            setImageError(data["errors"]);
        }
        if (data["status"] === "ok") {
            window.location.href = data["redirect"];
        }
        console.log(data)
    }).catch((error) => console.log(error));
}

function addQuestion(btn) {
    let form = btn.closest('form');
    let formData = new FormData(form);
    formData.append('action', btn.getAttribute('data-action'))

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
        console.log(data);
        if (data["status"] === "error") {
            setErrors(data["errors"]);
            setAnswerErrors(data["errors"]);
        }
        if (data["status"] === "ok") {
            window.location.href = data["redirect"];
        }
    }).catch((error) => console.log(error));
}

function setImagePreview(previewImage, previewName) {

    const file = imageInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewName.textContent = file.name;
            previewImage.style.display = 'block';
            removeImageButton.style.display = 'inline-block';
        }
        reader.readAsDataURL(file);

        const imageError = document.querySelector('.input-file__label');
        if(imageError) imageError.classList.remove('error');
    }
}

function setAnswerErrors(errors) {
    const answerInputs = document.querySelectorAll('.answer');
    answerInputs.forEach((input, index) => {
        if (errors[`answer.${index}`]) {
            input.classList.add('error');
            input.nextElementSibling.textContent = errors[`answer.${index}`][0];
        } else {
            input.classList.remove('error');
            input.nextElementSibling.textContent = '';
        }
    });
}

function setImageError(errors) {
    const imageError = document.querySelector('.input-file__label');
    if(imageError) {
        if (errors['image']) {
            imageError.classList.add('error');
        } else {
            imageError.classList.remove('error');
        }
    }
}
