import Input from './Input';
import Select from './Select';


export const MaterialInitializer = () => {
  const FIELD_SELECTOR = '.material-field'
  const INPUT_CLASS_SELECTOR = 'material-field--input'
  const SELECT_CLASS_SELECTOR = 'material-field--select'

  const init = (input) => {
    const classList = input.classList
    if (classList.contains(INPUT_CLASS_SELECTOR)) {
      (new Input(input)).init()
    } else if (classList.contains(SELECT_CLASS_SELECTOR)) {
      (new Select(input)).init()
    }
  }

  const initAll = () => {
    const inputs = Array.from(
      document.querySelectorAll(FIELD_SELECTOR)
    )

    inputs.forEach((input) => {
      init(input)
    })
  };

  return { initAll };
};
