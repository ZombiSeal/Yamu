document.addEventListener('click', event => {
    if (event.target.classList.contains('radio')) {
        let maxCount = document.querySelector('.quiz__title-up').getAttribute('max-count');
        let quizId = document.querySelector('.quiz-container').getAttribute('data-id');
        let questionCount = document.querySelector('.quiz__title-up').getAttribute('data-count');
        let answer = event.target.value;
        let url = "/quizzes/" + quizId + "/update/?quizId=" + quizId + "&count=" + questionCount + "&maxCount=" + maxCount + "&answer=" + answer;
        document.querySelector('.quiz-wrapper__count .count').innerHTML = ++questionCount;

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
            }
        }).then(res => {
            return res.json();
        }).then(data => {
            if (data) {
                if(data["status"] === 'ok') {
                    document.querySelector('.quiz__question').innerHTML = data["template"];
                } else {
                    window.location.href = data["url"];
                }
            }
        }).catch((error) => console.log(error));
    }
})
