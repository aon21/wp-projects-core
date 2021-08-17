export const SidebarWithInners = () => {
    const links = Array.from(
        document.querySelectorAll('.sidebar-link')
    );

    const wrapper = document.querySelector('.desc');
    const blocks = Array.from(
        wrapper.querySelectorAll('.desc > .core-block--columns')
    );

    const highlight = () => {
        links.forEach(function (link) {
            if (link.getAttribute('href').charAt(0) === '#') {
                blocks.forEach(function (block) {
                    if (window.pageYOffset - 300 >= block.offsetTop) {
                        if (link.classList.contains(block.id)) {
                            link.classList.add('text-green', 'font-bold');
                        } else {
                            link.classList.remove('text-green', 'font-bold');
                        }
                    }
                });
            }
        });
    }

    const addClass = (clicked) => {
        links.forEach(function (link) {
            if (!link.classList.contains('text-green') && link === clicked.target) {
                clicked.target.classList.add('text-green', 'font-bold');
            } else {
                link.classList.remove('text-green', 'font-bold');
            }
        });
    }

    const scrollTo = (event) => {
        if (event.target.getAttribute('href').charAt(0) === '#') {
            event.preventDefault();
            let offset = document.querySelector(event.target.getAttribute('href')).offsetTop;
            let topOffset = document.querySelector('.has-draggable').getAttribute('data-offset-top');
            window.scrollTo(0, offset + parseInt(topOffset));
        }

        addClass(event);
    }

    const init = () => {
        links.forEach(function (link, index) {
            if (index === 0 && link.getAttribute('href').charAt(0) === '#') {
                link.classList.add('text-green', 'font-bold');
            }
            link.addEventListener('click', scrollTo);
        });

        window.addEventListener('scroll', highlight);
        window.addEventListener('load', highlight)
    };

    return { init };
};
