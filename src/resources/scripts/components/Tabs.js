export const Tabs = (mainElem = '.panels-wrapper', activeCLassList = ['border-b-4', 'border-green', 'text-green']) => {
  const ACTIVE_CLASS_LIST = activeCLassList
  const wrapper = document.querySelector(mainElem);
  const tabs = Array.from(
    wrapper.querySelectorAll('.tab')
  );

  const hidePrevious = (currentClicked) => {
    tabs.forEach(function (tab) {
      const previous = tab.getAttribute('data-target');

      if (currentClicked !== previous) {
        ACTIVE_CLASS_LIST.forEach(function (activeClass) {
          tab.classList.remove(activeClass)
        })

        tab.classList.add('border-b', 'border-deep-blue-4');
      }
    });
  };

  const showPanel = (currentClicked) => {
    const panelsContainer = wrapper.querySelector('.panels-container');
    const panels = Array.from(
      panelsContainer.querySelectorAll('.single-panel')
    );

    panels.forEach(function (panel) {
      if (panel.classList.contains(currentClicked)) {
        panel.classList.remove('hidden');
      } else {
        panel.classList.add('hidden');
      }
    });
  };

  const showClicked = (index) => {
    const currentClicked = index.target.getAttribute('data-target');
    index.target.classList.remove('border-b' ,'border-deep-blue-4');

    ACTIVE_CLASS_LIST.forEach(function (activeClass) {
      index.target.classList.add(activeClass)
    })

    hidePrevious(currentClicked);
    showPanel(currentClicked);
  };

  const init = () => {
    tabs.forEach(function (tab) {
      tab.addEventListener('click', showClicked);
    });
  };

  return { init };
};
