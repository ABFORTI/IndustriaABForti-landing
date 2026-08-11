export function initCounters() {
    const bars = Array.from(document.querySelectorAll('[data-infra-bar]'));

    if (!bars.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const run = (bar) => {
        const targetWidth = bar.dataset.targetWidth;
        const targetValue = parseInt(bar.dataset.targetValue, 10);
        const valueEl = bar.closest('[data-infra-row]')?.querySelector('[data-infra-value]');

        bar.style.setProperty('--infra-width', `${targetWidth}%`);
        bar.style.width = `${targetWidth}%`;

        if (!valueEl || Number.isNaN(targetValue)) {
            return;
        }

        if (prefersReducedMotion) {
            valueEl.textContent = `${targetValue.toLocaleString('es-MX')} m²`;
            return;
        }

        const duration = 900;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min(1, (now - start) / duration);
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(targetValue * eased);
            valueEl.textContent = `${current.toLocaleString('es-MX')} m²`;

            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };

        window.requestAnimationFrame(step);
    };

    if (!('IntersectionObserver' in window)) {
        bars.forEach(run);
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    run(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.3 }
    );

    bars.forEach((bar) => observer.observe(bar));
}
