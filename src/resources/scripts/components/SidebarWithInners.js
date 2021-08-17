export const SidebarWithInners = (classList = ['text-green', 'font-bold']) => {
    const CLASS_LIST = classList;
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
                            CLASS_LIST.forEach(function (classes) {
                                link.classList.add(classes);
                            })
                        } else {
                            CLASS_LIST.forEach(function (classes) {
                                link.classList.remove(classes);
                            })
                        }
                    }
                });
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
    }

    const init = () => {
        links.forEach(function (link, index) {
            if (index === 0 && link.getAttribute('href').charAt(0) === '#') {
                CLASS_LIST.forEach(function (classes) {
                    link.classList.add(classes);
                })
            }
            link.addEventListener('click', scrollTo);
        });

        window.addEventListener('scroll', highlight);
        window.addEventListener('load', highlight)
    };

    return { init };
};
