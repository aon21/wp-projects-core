const DIRTY_CLASSNAME = 'material-field--focused'

class Field {
  constructor (elem) {
    this.elem = elem
    this.actualField = null
  }

  handleFocusIn () {
    this.addClass(DIRTY_CLASSNAME)
  }

  handleFocusOut () {
    if (this.isDirty()) {
      return
    }

    this.removeClass(DIRTY_CLASSNAME)
  }

  isDirty () {
    return this.actualField.value.length > 0
  }

  addClass (className) {
    this.elem.classList.add(className)
  }

  removeClass (className) {
    this.elem.classList.remove(className)
  }

  init () {
    this.actualField.addEventListener('focusin', () => this.handleFocusIn())
    this.actualField.addEventListener('focusout', () => this.handleFocusOut())
  }
}

export default Field;
