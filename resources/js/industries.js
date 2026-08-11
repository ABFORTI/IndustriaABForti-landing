
export function initIndustriesCarousel() {
    document.querySelectorAll('[data-industries-carousel]').forEach((root) => {
        const tabs = Array.from(root.querySelectorAll('[data-industry-tab]'));
        const panels = Array.from(root.querySelectorAll('[data-industry-panel]'));

        const activate = (industry) => {
            tabs.forEach((tab) => {
                const isActive = tab.dataset.industry === industry;
                tab.classList.toggle('is-active', isActive);
                tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                tab.setAttribute('tabindex', isActive ? '0' : '-1');
            });

            panels.forEach((panel) => {
                panel.classList.toggle('is-active', panel.dataset.industry === industry);
            });
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => activate(tab.dataset.industry));

            tab.addEventListener('keydown', (event) => {
                const isNext = event.key === 'ArrowRight' || event.key === 'ArrowDown';
                const isPrev = event.key === 'ArrowLeft' || event.key === 'ArrowUp';

                if (!isNext && !isPrev) {
                    return;
                }

                event.preventDefault();
                const targetIndex = isNext
                    ? (index + 1) % tabs.length
                    : (index - 1 + tabs.length) % tabs.length;

                const target = tabs[targetIndex];
                target.focus();
                activate(target.dataset.industry);
            });
        });
    });
}
