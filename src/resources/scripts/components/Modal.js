export const Modal = () => {
    const buttons = Array.from(
        document.querySelectorAll('.modal-button')
    );
    const modal = document.querySelector('.modal');
    const closeButton = document.querySelector('.closeModal');
    const main = document.querySelector('.main');

    const openClass = () => {
        modal.classList.remove('hidden');
        main.classList.remove('z-10');
        document.body.classList.add('overflow-hidden');
    }

    const closeClass = () => {
        modal.classList.add('hidden');
        main.classList.add('z-10');
        document.body.classList.remove('overflow-hidden');
    }

    const close = (event) => {
        event.key === 'Escape' ? closeClass() : '';
        event.target === modal ? closeClass() : '';
        event.target === closeButton ? closeClass() : '';
    }

    const open = () => {
        openClass();
        window.addEventListener('keydown', close);
        window.addEventListener('click', close);
        closeButton.addEventListener('click', close);
    }

    const init = () => {
        buttons.forEach(function (button) {
            button.addEventListener('click', open);
        });
    };

    return { init };
};
