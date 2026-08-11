
export function initParallax() {
    const targets = Array.from(document.querySelectorAll('[data-parallax]'));

    if (!targets.length) {
        return;
    }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const MAX_OFFSET = 18;

    let ticking = false;

    const update = () => {
        targets.forEach((el) => {
            const rect = el.getBoundingClientRect();
            const viewportCenter = window.innerHeight / 2;
            const elementCenter = rect.top + rect.height / 2;
            const distance = (elementCenter - viewportCenter) / viewportCenter;
            const offset = Math.max(-1, Math.min(1, distance)) * MAX_OFFSET;

            el.style.transform = `translateY(${offset.toFixed(1)}px)`;
        });
        ticking = false;
    };

    const onScroll = () => {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    };

    update();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
}
