export const LiveSearch = () => {
    const searchForm = document.querySelector('.searchform');
    const resultsWrapper = document.querySelector('.search-results');
    const searchInput = document.querySelector('.searchInput');
    const type = document.querySelector('.search-field').getAttribute('data-type');
    let res;

    const reset = (event) => {
        if (!event.target.classList.contains('search-field')) {
            resultsWrapper.classList.add('hidden');
            searchInput.classList.add('rounded-t');
            searchInput.classList.add('rounded');
        }
    }

    const addHtml = (htmlData) => {
        resultsWrapper.innerHTML = htmlData;
        resultsWrapper.classList.remove('hidden');
        resultsWrapper.classList.add('rounded-b');
        searchInput.classList.remove('rounded');
        searchInput.classList.add('rounded-t');
    }

    const Ajax = (event) => {
        clearTimeout(res);
        let param = event.target.value ? event.target.value : '';

        if (param.length >= 3 ) {
            res = setTimeout(function () {
                const metas = document.getElementsByName('csrf-token');
                let token = metas[0].getAttribute('content');
                let data = {action:'search', param:param, type:type};

                fetch(wp.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': token,
                    },
                    body: new URLSearchParams(data),
                }).then((response) => {
                    return response.text();
                }).then((htmlData) => {
                    if (htmlData != '') {
                        addHtml(htmlData);
                    }
                });
            }, 500);
        }

    }

    const init = () => {
        searchForm.addEventListener('keyup', Ajax)
        document.addEventListener('click', reset)
    };

    return { init };
};
