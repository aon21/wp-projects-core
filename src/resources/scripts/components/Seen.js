export const Seen = (mainElem = '.kb-helpful') => {
    const wrapper = document.querySelector(mainElem);
    const elem = wrapper.childNodes[1];

    const Ajax = (postId) => {
        const metas = document.getElementsByName('csrf-token');
        let token = metas[0].getAttribute('content');
        let data = {action:'postview', value:postId};

        fetch(wp.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': token,
            },

            body: new URLSearchParams(data),
        });
    }

    const init = () => {
        setTimeout( function() {
            Ajax(elem.getAttribute('data-target'));
        }, 5000);
    };

    return { init };
};
