export const CustomSelect = (mainElem = '.custom-select-wrapper') => {
    const wrapper = Array.from(
        document.querySelectorAll(mainElem));

    const toggle = (index) => {
        if (index.target.classList.contains('custom-select__trigger')) {
            if (index.target.parentNode.classList.contains('open')) {
                index.target.parentNode.classList.remove('open');
                index.target.classList.add('rounded');
            } else {
                index.target.parentNode.classList.add('open');
                index.target.classList.remove('rounded');
                index.target.classList.add('rounded-t');
            }
        }
    }

    const select = (index) => {
        console.log(index.target);
        console.log(index.target.parentNode.querySelector('.custom-option.selected'));
        if (!index.target.classList.contains('selected')) {
            index.target.parentNode.querySelector('.custom-option.selected').classList.remove('selected', 'text-green');
            index.target.classList.add('selected', 'text-green');
            index.target.closest('.custom-select').querySelector('.custom-select__trigger span').textContent = index.target.textContent;
            index.target.parentNode.parentNode.classList.remove('open');
        }
    }

    const init = () => {
        wrapper.forEach(function (wrap) {
            wrap.addEventListener('click', toggle);

            const optionsWrapper = wrap.querySelector('.custom-options')
            const options = Array.from(
                optionsWrapper.querySelectorAll('.custom-option'));

            options.forEach(function (option) {
                option.addEventListener('click', select);
            });
        });

        window.addEventListener('click', function (e) {
            wrapper.forEach(function (wrap) {
                if (!wrap.querySelector('.custom-select').contains(e.target)) {
                    wrap.querySelector('.custom-select').classList.remove('open');
                    wrap.querySelector('.custom-select__trigger').classList.add('rounded');
                }
            });
        });
    };

    return { init };
};
