import Field from './Field'

class Select extends Field {
    constructor (elem) {
        super(elem);

        this.actualField = this.elem.querySelector('textarea')
    }
}

export default Select
