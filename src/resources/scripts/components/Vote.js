export const Vote = (mainElem = '.kb-helpful') => {
  const wrapper = document.querySelector(mainElem);
  const btns = Array.from(
    wrapper.querySelectorAll('.btn')
  );

  const addClass = (index, status) => {
    if (index.target.classList.contains('btn--outline--grey')) {

      if (status === 'like') {
        index.target.classList.remove('btn--outline', 'btn--outline--blue');
        index.target.classList.add('btn--blue');
        btns[1].classList.remove('btn--blue');
        btns[1].classList.add('btn--outline', 'btn--outline--blue');
      }

      if (status === 'dislike') {
        index.target.classList.remove('btn--outline', 'btn--outline--blue');
        index.target.classList.add('btn--blue');
        btns[0].classList.remove('btn--blue');
        btns[0].classList.add('btn--outline', 'btn--outline--blue');
      }
    }
  }

  const Ajax = (index, key, postId) => {
    const metas = document.getElementsByName('csrf-token');
    let token = metas[0].getAttribute('content');
    let data = {action:'vote', key:key, value:postId};

    fetch(wp.ajax_url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': token,
      },

      body: new URLSearchParams(data),
    });
  }

  const Like = (index) => {
    Ajax(index, 'like', index.target.getAttribute('data-target'));
    addClass(index, 'like');
  }

  const Dislike = (index) => {
    Ajax(index, 'dislike', index.target.getAttribute('data-target'));
    addClass(index, 'dislike');
  }

  const init = () => {
    btns.forEach(function (btn) {
      if (btn.getAttribute('data-id') === 'like') {
        btn.addEventListener('click', Like)
      }

      if (btn.getAttribute('data-id') === 'dislike') {
        btn.addEventListener('click', Dislike)
      }
    });
  };

  return { init };
};
