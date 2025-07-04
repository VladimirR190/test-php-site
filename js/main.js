// --- Авторизация ---
const loginBtn = document.querySelector('.login button[type="submit"]');
const loginModal = document.getElementById('modal');
const loginInput = document.querySelector('.login input.name');
const passInput = document.querySelector('.login input.password');
const modalSuccessLog = document.querySelector('.modal-success-log');

if (loginBtn && loginInput && passInput && loginModal && modalSuccessLog) {
    loginBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const login = loginInput.value.trim();
        const password = passInput.value.trim();
        if (!login || !password) {
            loginInput.classList.toggle('error', !login);
            passInput.classList.toggle('error', !password);
            return;
        }
        // Пример запроса на сервер (заменить на реальный обработчик)
        fetch('../db/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ login, password })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    loginModal.style.display = 'none';
                    modalSuccessLog.style.display = 'flex';
                    loginInput.value = '';
                    passInput.value = '';
                } else {
                    alert('Ошибка авторизации: ' + (data.error || 'Неверный логин или пароль'));
                }
            })
            .catch(() => {
                alert('Ошибка соединения с сервером');
            });
    });
    // Кнопка "Ок" и крестик закрывают модалку успеха
    modalSuccessLog.querySelector('.success-reg').addEventListener('click', function () {
        modalSuccessLog.style.display = 'none';
    });
    modalSuccessLog.querySelector('.modal-close').addEventListener('click', function () {
        modalSuccessLog.style.display = 'none';
    });
    // Клик вне окна
    modalSuccessLog.addEventListener('click', function (e) {
        if (e.target === this) this.style.display = 'none';
    });
}


// Новый бургер-меню
document.addEventListener('DOMContentLoaded', function () {

    // Открытие модального окна авторизации из мобильного меню
    const mobileMenuEl = document.getElementById('mobile-menu');
    const mobileLoginLink = mobileMenuEl ? mobileMenuEl.querySelector('.nav-link') : null;
    const modal = document.getElementById('modal');
    if (mobileLoginLink && modal && mobileMenuEl) {
        mobileLoginLink.addEventListener('click', function (e) {
            e.preventDefault();
            mobileMenuEl.classList.remove('open');
            document.body.classList.remove('menu-open');
            document.body.style.overflow = '';
            // Сбросить aria-атрибуты и показать бургер
            var burger = document.getElementById('burger-menu');
            if (burger) {
                burger.setAttribute('aria-expanded', 'false');
                burger.style.display = 'flex';
            }
            modal.style.display = 'flex';
        });
    }
    // --- Активация кнопки Войти ---
    const loginBtn = document.querySelector('.login button[type="submit"]');
    const loginInputs = document.querySelectorAll('.login input');
    function validateLoginForm() {
        const loginFilled = Array.from(loginInputs).every(input => input.value.trim() !== '');
        if (loginFilled) {
            loginBtn.classList.add('active');
        } else {
            loginBtn.classList.remove('active');
        }
    }
    if (loginBtn && loginInputs.length) {
        loginInputs.forEach(function (input) {
            input.addEventListener('input', validateLoginForm);
        });
        validateLoginForm();
    }
    const burger = document.getElementById('burger-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeBtn = document.getElementById('close-menu');

    function openMenu() {
        mobileMenu.classList.add('open');
        burger.setAttribute('aria-expanded', 'true');
        mobileMenu.setAttribute('aria-hidden', 'false');
        document.body.classList.add('menu-open');
        // Блокируем скролл
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        mobileMenu.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('menu-open');
        document.body.style.overflow = '';
    }

    if (burger && mobileMenu && closeBtn) {
        burger.addEventListener('click', function (e) {
            e.stopPropagation();
            if (mobileMenu.classList.contains('open')) {
                closeMenu();
            } else {
                openMenu();
            }
        });
        closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeMenu();
        });
        // Закрытие по клику вне меню
        document.addEventListener('click', function (e) {
            if (
                mobileMenu.classList.contains('open') &&
                !mobileMenu.contains(e.target) &&
                !burger.contains(e.target)
            ) {
                closeMenu();
            }
        });
        // Закрытие по Esc
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
                closeMenu();
            }
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {


    initSwiper();
    Inputmask("+7 (999) 999-99-99").mask(document.querySelectorAll('input[type="tel"]'));
    const checkboxreg = document.getElementById('register-agree');
    const modal = document.getElementById('modal');
    const modalreg = document.getElementById('modal-register');
    const header = document.querySelector('.site-header');
    const modalSuccessReg = document.getElementById('modal-success-reg');
    let lastScroll = 0;

    window.addEventListener('scroll', function () {
        if (window.scrollY > 20) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
        lastScroll = window.scrollY;
    });
    document.querySelector('.profile').addEventListener('click', function () {
        document.getElementById('modal-success-reg').style.display = 'none';
        document.getElementById('modal').style.display = 'flex';
        document.getElementById('modal-register').style.display = 'none';


    });



    document.querySelectorAll('.modal-close').forEach(function (e) {
        e.addEventListener('click', function () {
            if (getComputedStyle(modal).display === 'flex' || getComputedStyle(modalreg).display === 'flex' || getComputedStyle(modalSuccessReg).display === 'flex') {
                modal.style.display = 'none';
                modalreg.style.display = 'none';
                modalSuccessReg.style.display = 'none';
            }
        })
    });
    document.querySelector('.success-reg').addEventListener('click', function () {
        modalSuccessReg.style.display = 'none';
    });





    ['modal', 'modal-register', 'modal-success-reg'].forEach(function (id) {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('click', function (e) {
                if (e.target === this) this.style.display = 'none';
            });
        }
    });

    [
        { btn: 'register-page', hide: 'modal', show: 'modal-register' },
        { btn: 'login-page', hide: 'modal-register', show: 'modal' }
    ].forEach(function (e) {
        const btn = document.getElementById(e.btn);
        const hide = document.getElementById(e.hide);
        const show = document.getElementById(e.show);
        if (btn && hide && show) {
            btn.addEventListener('click', function () {
                hide.style.display = 'none';
                show.style.display = 'flex';
            });
        }
    });


    document.querySelectorAll('.register input:not([type="checkbox"])').forEach(function (e) {
        e.addEventListener('input', validateRegisterForm);
    });

    checkboxreg.addEventListener('change', validateRegisterForm);

    function validateRegisterForm() {
        const inputs = document.querySelectorAll('.register input:not([type="checkbox"])');
        const allFilled = Array.from(inputs).every(input => input.value.trim() !== '');
        const checkboxreglabel = document.getElementById('register-agree');
        const buttonreg = document.querySelector('.register-btn');
        inputs.forEach(function (e) {
            if (e.value.trim() === "" && checkboxreg.checked) {
                e.classList.add('error');
            } else {
                e.classList.remove('error');
            }
        });
        if (allFilled && !checkboxreg.checked) {
            checkboxreg.classList.add('error');
            checkboxreglabel.classList.add('error');

        } else {
            checkboxreg.classList.remove('error');
            checkboxreglabel.classList.remove('error');
        }

        if (allFilled && checkboxreg.checked) {
            buttonreg.classList.add('active');
        } else {
            buttonreg.classList.remove('active');

        }
    };



    document.querySelector('.register-btn').addEventListener('click', function (e) {
        e.preventDefault();

        const name = document.querySelector('.register input.name').value.trim();
        const surname = document.querySelector('.register input.surname').value.trim();
        const phone = document.querySelector('.register input.contact-tel').value.trim();

        if (!name || !surname || !phone || !checkboxreg.checked) {
            console.log('Заполните все поля');
            return;
        } else {
            fetch('db/register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name, surname, phone
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Показываем модалку успеха регистрации
                        modalreg.style.display = 'none';
                        modalSuccessReg.style.display = 'flex';
                        // Можно вывести логин/пароль через alert, если нужно
                        // alert('Данные отправлены! ' + data.login + ', Пароль: ' + data.password);
                    } else {
                        alert('Ошибка регистрации: ' + data.error);
                    }
                })
        }
    });




    document.querySelector('.logo-logo').addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = '/';
    });
    function initSwiper() {
        if (document.querySelector('.swiper')) {
            new Swiper('.swiper', {
                loop: true,
                speed: 900,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                navigation: {
                    nextEl: '.slider-arrow--right',
                    prevEl: '.slider-arrow--left',
                },
            });
        }
    }


    // --- Отправка заявки (job-application) ---
    document.querySelector('.send-job-application-btn').addEventListener('click', function (e) {
        e.preventDefault();
        const name = document.getElementById('contact-name').value.trim();
        const tel = document.getElementById('contact-tel').value.trim();
        const email = document.getElementById('contact-email').value.trim();
        const message = document.querySelector('.contact-message').value.trim(); // у поля сообщения нет id, только класс
        const agree = document.getElementById('agree').checked;

        // Валидация
        if (!name || !tel || !email || !message || !agree) {
            alert('Заполните все поля');
            return;
        }

        fetch('db/job_application.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, tel, email, message })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('modal-success-reg').style.display = 'flex';
                    document.getElementById('contact-name').value = '';
                    document.getElementById('contact-tel').value = '';
                    document.getElementById('contact-email').value = '';
                    document.querySelector('.contact-message').value = '';
                    document.getElementById('agree').checked = false;
                } else {
                    alert('Ошибка: ' + (data.error || 'Не удалось отправить заявку'));
                }
            })
            .catch(() => {
                alert('Ошибка соединения с сервером');
            });
    });


    const searchInput = document.querySelector('.search-input');
    const productCards = document.querySelectorAll('.product-card');


    searchInput.addEventListener('input', function () {
        const value = searchInput.value.trim().toLowerCase();
        productCards.forEach(card => {
            const name = card.querySelector('.product-name').textContent.toLowerCase();
            if (name.includes(value) || value === '') {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });


});



