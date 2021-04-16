export const Sidebar = () => {
  const sidebar = document.querySelector('.sidebar-list')

  const init = () => {
    let items = Array.from(sidebar.querySelectorAll('.has-children'))
    let draggableBlock = sidebar.closest('.has-draggable')

    items.forEach(function (item) {
      let toggler = item.querySelector('.cat-item__opener')

      toggler.addEventListener('click', function () {
        if (item.classList.contains('has-children--open')) {
          item.classList.remove('has-children--open')
        } else {
          item.classList.add('has-children--open')
        }

        draggableBlock.dispatchEvent(new Event('refreshScrollMagic'))
      })
    })
  };

  return { init };
};
