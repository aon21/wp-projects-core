import Field from './Field'

class Input extends Field {
  constructor (elem) {
    super(elem);

    this.actualField = this.elem.querySelector('input')
  }
}

export default Input
