/**
 * Fade-up al entrar en viewport (BRIEF §17: "fade-up, fade-in"). Un solo
 * IntersectionObserver para todo el sitio en vez de uno por sección —
 * cualquier elemento con [data-reveal] se anima una sola vez la primera
 * vez que aparece.
 *
 * Si el usuario tiene activado "reducir movimiento" en su sistema, no se
 * observa nada: los elementos se quedan visibles desde el inicio (la regla
 * CSS de reduced-motion en app.css ya neutraliza la transición, esto solo
 * evita el trabajo de observarlos).
 */
export function initReveal() {
    const targets = document.querySelectorAll('[data-reveal]');

    if (!targets.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        targets.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
    );

    targets.forEach((el) => observer.observe(el));
}
