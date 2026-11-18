document.addEventListener('change', (event) => {
    const toggle = event.target;

    if (!(toggle instanceof HTMLInputElement) || !toggle.matches('[data-password-toggle]')) {
        return;
    }

    const password = document.querySelector(toggle.dataset.passwordToggle);

    if (password instanceof HTMLInputElement) {
        password.type = toggle.checked ? 'text' : 'password';
    }
});
