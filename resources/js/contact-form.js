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
}
