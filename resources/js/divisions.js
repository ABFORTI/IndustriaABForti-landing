
export function initDivisionSwitcher() {
    document.querySelectorAll('[data-division-switcher]').forEach((root) => {
        const tabs = Array.from(root.querySelectorAll('[data-tab]'));
        const panels = Array.from(root.querySelectorAll('[data-panel]'));

        const activate = (division) => {
            tabs.forEach((tab) => {
                const isActive = tab.dataset.division === division;
                tab.classList.toggle('is-active', isActive);
                tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                tab.setAttribute('tabindex', isActive ? '0' : '-1');
            });

            panels.forEach((panel) => {
                const isActive = panel.dataset.division === division;

                if (isActive) {
                    panel.hidden = false;
                    panel.classList.remove('is-active');
                    
                    void panel.offsetWidth;
                    requestAnimationFrame(() => panel.classList.add('is-active'));
                } else {
                    panel.classList.remove('is-active');
                    panel.hidden = true;
                }
            });
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => activate(tab.dataset.division));

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
                activate(target.dataset.division);
            });
        });
    });
}
