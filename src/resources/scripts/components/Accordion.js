export const Accordion = (
  groupClass = '.accordion-group',
  itemClass = '.accordion-item',
  itemQuestionClass = '.accordion-item__question',
  itemAnswerClass = '.accordion-item__answer'
) => {
  const open = (accordionItem) => {
    let question = accordionItem.querySelector(itemQuestionClass)
    let answer = accordionItem.querySelector(itemAnswerClass)

    let down = question.querySelector('.accordion-item__chev-down')
    let up = question.querySelector('.accordion-item__chev-up')

    answer.classList.remove('hidden')
    down.classList.add('hidden')
    up.classList.remove('hidden')
    accordionItem.classList.add('active')
  }

  const close = (accordionItem) => {
    let question = accordionItem.querySelector(itemQuestionClass)
    let answer = accordionItem.querySelector(itemAnswerClass)

    let down = question.querySelector('.accordion-item__chev-down')
    let up = question.querySelector('.accordion-item__chev-up')

    answer.classList.add('hidden')
    down.classList.remove('hidden')
    up.classList.add('hidden')
    accordionItem.classList.remove('active')
  }

  const closePrevious = (items) => {
    items.map((accordionItem) => {
      close(accordionItem)
    })
  }

  const initGroup = (accordion) => {
    let accordionItems = Array.from(accordion.querySelectorAll(itemClass))

    accordionItems.map((accordionItem) => {
      let question = accordionItem.querySelector(itemQuestionClass)

      question.addEventListener('click', function () {
        let currentActiveItem = accordion.querySelector('.active')

        closePrevious(accordionItems)

        if (currentActiveItem !== accordionItem) {
          open(accordionItem)
        }
      })
    })
  }

  const init = () => {
    let accordions = Array.from(document.querySelectorAll(groupClass))

    accordions.map((item) => initGroup(item))
  };

  return { init };
};
