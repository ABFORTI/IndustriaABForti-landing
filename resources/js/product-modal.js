
export function initProductModal() {
    const modal = document.querySelector('[data-product-modal]');

    if (!modal) {
        return;
    }

    const backdrop = modal.querySelector('[data-product-modal-backdrop]');
    const panel = modal.querySelector('[data-product-modal-panel]');
    const closeButton = modal.querySelector('[data-product-modal-close]');
    const imageWrap = modal.querySelector('[data-product-modal-image]');
    const image = modal.querySelector('[data-product-modal-img]');
    const title = modal.querySelector('[data-product-modal-title]');
    const list = modal.querySelector('[data-product-modal-list]');

    let lastFocused = null;

    const open = (trigger) => {
        const label = trigger.dataset.productLabel || '';
        const imageSrc = trigger.dataset.productImage || '';
        let advantages = [];

        try {
            advantages = JSON.parse(trigger.dataset.productAdvantages || '[]');
        } catch (error) {
            advantages = [];
        }

        title.textContent = label;

        if (imageSrc) {
            image.src = imageSrc;
            image.alt = label;
            imageWrap.classList.remove('hidden');
        } else {
            imageWrap.classList.add('hidden');
        }

        list.innerHTML = '';
        advantages.forEach((advantage) => {
            const item = document.createElement('li');
            item.className = 'flex items-start gap-3 text-sm leading-relaxed text-gray-600 sm:text-base';

            const dot = document.createElement('span');
            dot.className = 'mt-2 h-1.5 w-1.5 shrink-0 rounded-full';
            dot.style.background = 'var(--tab-accent)';

            const text = document.createElement('span');
            text.textContent = advantage;

            item.append(dot, text);
            list.appendChild(item);
        });

        lastFocused = document.activeElement;
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        panel.classList.remove('scale-95');
        panel.classList.add('scale-100');
        document.documentElement.classList.add('overflow-hidden');
        closeButton.focus();
    };

    const close = () => {
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100', 'pointer-events-auto');
        panel.classList.add('scale-95');
        panel.classList.remove('scale-100');
        document.documentElement.classList.remove('overflow-hidden');

        if (lastFocused) {
            lastFocused.focus();
        }
    };

    document.querySelectorAll('[data-product-trigger]').forEach((trigger) => {
        trigger.addEventListener('click', () => open(trigger));
    });

    closeButton.addEventListener('click', close);
    backdrop.addEventListener('click', close);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal.classList.contains('opacity-100')) {
            close();
        }
    });
}
