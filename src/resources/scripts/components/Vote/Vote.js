export const Vote = (mainElem = '.kb-helpful') => {
  const wrapper = document.querySelector(mainElem);
  const btns = Array.from(
    wrapper.querySelectorAll('.btn')
  );

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
  }

  const Dislike = (index) => {
    Ajax(index, 'dislike', index.target.getAttribute('data-target'));
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
