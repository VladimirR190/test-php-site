<?php
require_once __DIR__ . '/db/db.php';
?>
<?php
$isBlogActive = false;
$isAboutActive = false;
if (isset($_SERVER['REQUEST_URI']) && preg_match('#/db/get_news.php#', $_SERVER['REQUEST_URI'])) {
    $isBlogActive = true;
}

if (isset($_SERVER['REQUEST_URI']) && preg_match('#/about.php#', $_SERVER['REQUEST_URI'])) {
    $isAboutActive = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Manrope:200,300,400,500,600,700,800|Montserrat:200,300,400,500,600,700,800|Inter:400,500,600,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css" >


</head>

<body>
    <header class="site-header">
        <div class="nav-menu">
            <div class="logo-block">
                <div class="logo-logo">
                    <span class="city-label">Тюмень</span>
                    <span class="logo-text">Fabrika</span>
                </div>
                <span class="slogon">От идеи <br>до воплощения</span>
            </div>
            <nav class="navigation" id="main-nav">
                <div class="nav-link nav-catalog" tabindex="0">
                    Каталог
                    <div class="catalog-dropdown">
                        <a href="#" class="dropdown-link">Перетяжка мебели</a>
                        <a href="#" class="dropdown-link">Изготовление кроватей</a>
                        <a href="#" class="dropdown-link">Изготовление мягких стеновых панелей</a>
                        <a href="#" class="dropdown-link">Изготовление диванов</a>
                    </div>
                </div>
                <a href="../about.php" class="nav-link nav-about <?php if ($isAboutActive)
                    echo ' active'; ?>">О
                    компании</a>
                <a href="#" class="nav-link">Портфолио</a>
                <a href="#" class="nav-link nav-blog <?php if ($isBlogActive)
                    echo ' active'; ?>">Блог</a>
                <a href="#" class="nav-link">Контакты</a>
            </nav>
            <div class="numbers-profile">
                <div class="phone-number">
                    <a href="tel:+71234567890" class="phone-number">+7 (123) 456-78-90</a>
                    <a href="tel:+79876543210" class="phone-number">+7 (987) 654-32-10</a>
                </div>
                <div class="profile">
                    <img src="../img/profile1.png" alt="Профиль" class="profile-icon">
                </div>
            </div>
            <button class="burger" id="burger-menu" aria-label="Открыть меню" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="mobile-menu" id="mobile-menu" aria-hidden="true">
                <button class="close-btn" id="close-menu" aria-label="Закрыть меню">&times;</button>
                <a href="#" class="nav-link">Войти</a>
                <a href="#" class="nav-link">Каталог</a>
                <a href="../about.php" class="nav-link nav-about<?php if ($isAboutActive) echo ' active'; ?>">О компании</a>
                <a href="#" class="nav-link">Портфолио</a>
                <a href="#" class="nav-link nav-blog<?php if ($isBlogActive) echo ' active'; ?>">Блог</a>
                <a href="#" class="nav-link">Контакты</a>
            </nav>
        </div>
    </header>
    <div class="modal" id="modal">
        <div class="modal-profile" id="modal-profile">
            <div class="modal-content">
                <div class="title">
                    <h2>Войти</h2>
                    <span class="modal-close" id="modal-close">&times;</span>
                </div>
                <div class="login">
                    <input type="text" class="name" placeholder="Логин">
                    <input type="password" class="password" placeholder="Пароль">
                    <button class="login-btn" type="submit">Войти</button>
                </div>
                <div class="register-modal-page">
                    <p class="register-slog">У вас еще нет аккаунта?</p>
                    <p class="register-page" id="register-page">Зарегистрироваться</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-register" id="modal-register">
        <div class="modal-profile-register" id="modal-profile-register">
            <div class="modal-content">
                <div class="title">
                    <h2>Регистрация</h2>
                    <span class="modal-close" id="modal-close">&times;</span>
                </div>
                <div class="register">
                    <input type="text" class="name" placeholder="Имя">
                    <input type="text" class="surname" placeholder="Фамилия">
                    <input type="tel" class="contact-input contact-tel " placeholder="Телефон">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="register-agree" class="checkbox">
                        <label id="register-agree" for="agree">Соглашаюсь с условиями обработки персональных
                            данных</label>
                    </div>
                    <button class="register-btn" type="submit">Зарегистрироваться</button>
                </div>
                <div class="register-modal-page">
                    <p class="register-slog">У вас есть аккаунт?</p>
                    <p class="login-page" id="login-page">Авторизоваться</p>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-success-reg " id="modal-success-reg">
        <div class="modal-profile-success-reg">
            <div class="modal-close-wrapper">
                <span class="modal-close" id="modal-close">&times;</span>
                <h2>Спасибо!</h2>
                <p>Регистрация прошла успешно!</p>
                <button class="success-reg">Ок</button>
            </div>

        </div>
    </div>
    <div class="modal-success-log " id="modal-success-reg">
        <div class="modal-profile-success-reg">
            <div class="modal-close-wrapper">
                <span class="modal-close" id="modal-close">&times;</span>
                <h2>Спасибо!</h2>
                <p>Вы успешно авторизованны!</p>
                <button class="success-reg">Ок</button>
            </div>

        </div>
    </div>