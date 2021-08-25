export const Navigation = () => {
  const ACCOUNT_CLASS = 'hidden'
  const BODY_ACTIVE_CLASS = 'overflow-hidden'
  const TOGGLER_ACTIVE_CLASS = 'btn-me--active'
  const SITE_HEADER_MOBILE_ACTIVE_CLASS = 'site-header--mobile-active'
  const SITE_HEADER_MOBILE_SUB_MENU_ACTIVE_CLASS = 'site-header--submenu-active'
  const OPEN_ITEM_ACTIVE_CLASS = 'menu-link--active'
  const SUBMENU_ACTIVE_CLASS = 'sub-menu--active'

  const account = document.querySelector('.account')
  const body = document.querySelector('body')
  const wrap = document.querySelector('.site-header')
  const toggler = wrap.querySelector('.btn-me')
  const subBack = wrap.querySelector('.site-header__nav-cont-back')
  const expanders = Array.from(wrap.querySelectorAll('.site-header__nav-list > .menu-item-has-children > .menu-link'))
  const mobMenu = wrap.querySelector('.site-header__nav-list')
  const maxWidth = window.matchMedia('(max-width: 767px)')

  let prevActiveMenuItem

  const isMenuActive = () => {
    return toggler.classList.contains(TOGGLER_ACTIVE_CLASS)
  }

  const closeMenu = () => {
    body.classList.remove(BODY_ACTIVE_CLASS)
    toggler.classList.remove(TOGGLER_ACTIVE_CLASS)
    wrap.classList.remove(SITE_HEADER_MOBILE_ACTIVE_CLASS)
    wrap.classList.remove(SITE_HEADER_MOBILE_SUB_MENU_ACTIVE_CLASS)
    if (expanders[0]) {
      expanders[0].classList.remove(OPEN_ITEM_ACTIVE_CLASS)
      expanders[0].nextElementSibling.classList.remove(SUBMENU_ACTIVE_CLASS)
    }
    if (mobMenu.nextElementSibling) {
      mobMenu.nextElementSibling.classList.add('mobile-tablet:hidden', 'tablet-desktop:hidden');
    }
  }

  const openMenu = () => {
    body.classList.add(BODY_ACTIVE_CLASS)
    toggler.classList.add(TOGGLER_ACTIVE_CLASS)
    wrap.classList.add(SITE_HEADER_MOBILE_ACTIVE_CLASS)
    if (mobMenu.nextElementSibling) {
      mobMenu.nextElementSibling.classList.remove('mobile-tablet:hidden', 'tablet-desktop:hidden');
    }
    if (!maxWidth.matches) {
      expanders[0].classList.add(OPEN_ITEM_ACTIVE_CLASS)
      openItem(expanders[0])
    }

  }

  const toggleMenu = () => {
    isMenuActive() ? closeMenu() : openMenu()
  }

  const isExpandItemActive = (item) => {
    return item.classList.contains(OPEN_ITEM_ACTIVE_CLASS)
  }

  const openItem = (item) => {
    if (prevActiveMenuItem) {
      closeItem(prevActiveMenuItem)
    }

    const sub = item.nextElementSibling

    item.classList.add(OPEN_ITEM_ACTIVE_CLASS)
    account.classList.add(ACCOUNT_CLASS)
    if (maxWidth.matches) {
      sub.classList.add(SUBMENU_ACTIVE_CLASS)
    }
    wrap.classList.add(SITE_HEADER_MOBILE_SUB_MENU_ACTIVE_CLASS)

    prevActiveMenuItem = item
  }

  const closeItem = (item) => {
    const sub = item.nextElementSibling

    item.classList.remove(OPEN_ITEM_ACTIVE_CLASS)
    account.classList.remove(ACCOUNT_CLASS)
    if (maxWidth.matches) {
      sub.classList.remove(SUBMENU_ACTIVE_CLASS)
    }
    wrap.classList.remove(SITE_HEADER_MOBILE_SUB_MENU_ACTIVE_CLASS)
  }

  const toggleItem = (event, item) => {
    event.preventDefault()

    if (! isExpandItemActive(item)) openItem(item)
  }

  const init = () => {
    toggler.addEventListener('click', toggleMenu)
    subBack.addEventListener('click', () => {
      closeItem(prevActiveMenuItem)
    })

    expanders.forEach(function (item) {
      item.addEventListener('click', event => toggleItem(event, item))
    })
  }

  return { init }
};
