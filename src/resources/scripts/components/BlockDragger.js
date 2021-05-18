import ScrollMagic from 'scrollmagic'

export const BlockDragger = () => {
  const blocks = Array.from(document.querySelectorAll('.has-draggable'))
  let controller = new ScrollMagic.Controller()

  const applyDrag = (item) => {

    let elem = item.querySelector('.to-drag')
    let spot = item.querySelector(item.dataset.smtrigger)
    let cont = item.querySelector('.is-sm-container')

    let height = item.querySelector('.trigger-drag') ?
        item.querySelector('.trigger-drag').offsetHeight :
        item.querySelector(item.getAttribute('data-smtrigger')).offsetHeight

    if (elem.offsetHeight >= height) return

    let params = {
      duration: cont.offsetHeight - elem.offsetHeight,
      triggerHook: item.dataset.triggerhook ? item.dataset.triggerhook : 0.5,
    }

    if (spot) {
      params.triggerElement = spot
    }

    if (item.dataset.smOffset) {
      params.offset = item.dataset.smOffset
    }

    return new ScrollMagic
        .Scene(params)
        .setPin(elem)
        .addTo(controller);
  }

  const init = () => {
    setTimeout(function () {
      blocks.forEach(function (item) {
        let scrollMagic = applyDrag(item)

        item.addEventListener('refreshScrollMagic', () => {
          scrollMagic.refresh()
          scrollMagic.update(true)
        })
      })
    }, 100)
  };

  return { init };
};
