(function () {
    const loginModal    = document.getElementById('modal-login');
    const registerModal = document.getElementById('modal-register');

    function openModal(modal) {
        modal.hidden = false;
        document.body.style.overflow = 'hidden';
        lucide.createIcons();
    }

    function closeModal(modal) {
        modal.hidden = true;
        document.body.style.overflow = '';
    }

    document.getElementById('btn-login').addEventListener('click', () => openModal(loginModal));
    document.getElementById('btn-register-open').addEventListener('click', () => openModal(registerModal));

    document.getElementById('btn-login-close').addEventListener('click', () => closeModal(loginModal));
    document.getElementById('btn-register-close').addEventListener('click', () => closeModal(registerModal));

    document.getElementById('link-go-register').addEventListener('click', (e) => {
        e.preventDefault();
        closeModal(loginModal);
        openModal(registerModal);
    });

    document.getElementById('link-go-login').addEventListener('click', (e) => {
        e.preventDefault();
        closeModal(registerModal);
        openModal(loginModal);
    });

    [loginModal, registerModal].forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal(modal);
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (!loginModal.hidden)    closeModal(loginModal);
            if (!registerModal.hidden) closeModal(registerModal);
        }
    });

    lucide.createIcons();
})();
