
export function initNavbar() {
    const header = document.getElementById('site-header');
    const openButton = document.getElementById('mobile-menu-open');
    const closeButton = document.getElementById('mobile-menu-close');
    const menu = document.getElementById('mobile-menu');

    if (header) {
        const SCROLL_THRESHOLD = 12;

        const onScroll = () => {
            header.classList.toggle('is-scrolled', window.scrollY > SCROLL_THRESHOLD);
        };

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    if (!openButton || !closeButton || !menu) {
        return;
    }

    const openMenu = () => {
        menu.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-4');
        menu.classList.add('opacity-100', 'translate-y-0');
        openButton.setAttribute('aria-expanded', 'true');
        document.documentElement.classList.add('overflow-hidden');
        closeButton.focus();
    };

    const closeMenu = () => {
        menu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-4');
        menu.classList.remove('opacity-100', 'translate-y-0');
        openButton.setAttribute('aria-expanded', 'false');
        document.documentElement.classList.remove('overflow-hidden');
    };

    openButton.addEventListener('click', openMenu);
    closeButton.addEventListener('click', closeMenu);

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && openButton.getAttribute('aria-expanded') === 'true') {
            closeMenu();
        }
    });
}
