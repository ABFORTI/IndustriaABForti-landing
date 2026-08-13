export function initContactForm() {
    const select = document.getElementById('company');

    if (!select) {
        return;
    }

    document.querySelectorAll('[data-contact-shortcut]').forEach((button) => {
        button.addEventListener('click', () => {
            select.value = button.dataset.contactShortcut;
            select.closest('form')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            select.focus();
        });
    });

    const form = document.querySelector('[data-contact-form]');
    const submitButton = form?.querySelector('button[type="submit"]');

    form?.addEventListener('submit', () => {
        if (!form.checkValidity()) {
            return;
        }

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.setAttribute('aria-busy', 'true');
        }
    });
}
