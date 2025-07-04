<?php include 'header.php'; ?>
<main id="main-content">
    <section class="slider">
        <button class="slider-arrow slider-arrow--left">
            <svg width="32" height="32" viewBox="0 0 40 32" fill="none">
                <path d="M22 6L10 16L22 26" stroke="#fff" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                <line x1="12" y1="16" x2="29" y2="16" stroke="#fff" stroke-width="3" stroke-linecap="round" />
            </svg>
        </button>
        <div class="slider-images swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide slider-image ">
                    <img src="img/slider1.jpg" alt="слайд 1">
                    <div class="slider-overlay"></div>
                    <div class="slider-caption">
                        Перетяжка мягкой мебели
                        <button class="slider-more-btn">Подробнее</button>
                    </div>
                </div>
                <div class="swiper-slide slider-image ">
                    <img src="img/slider2.jpg" alt="слайд 2">
                    <div class="slider-overlay"></div>
                    <div class="slider-caption">
                        Изготовление диванов
                        <button class="slider-more-btn">Подробнее</button>
                    </div>
                </div>
                <div class="swiper-slide slider-image ">
                    <img src="img/slider3.jpg" alt="слайд 3">
                    <div class="slider-overlay"></div>
                    <div class="slider-caption">
                        Изготовление мягких стеновых панелей
                        <button class="slider-more-btn">Подробнее</button>
                    </div>
                </div>
                <div class="swiper-slide slider-image ">
                    <img src="img/slider4.jpg" alt="слайд 4">
                    <div class="slider-overlay"></div>
                    <div class="slider-caption">
                        Изготовление кроватей
                        <button class="slider-more-btn">Подробнее</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="slider-arrow slider-arrow--right">
            <svg width="32" height="32" viewBox="0 0 40 32" fill="none">
                <path d="M18 6L30 16L18 26" stroke="#fff" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                <line x1="28" y1="16" x2="11" y2="16" stroke="#fff" stroke-width="3" stroke-linecap="round" />
            </svg>
        </button>
    </section>
    <section class="search">
        <div class="search-input-wrapper">

            <input type="text" placeholder="Найти" class="search-input">
            <span class="search-icon">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                    <circle cx="16" cy="16" r="12" stroke="#969696" stroke-width="2.5" />
                    <line x1="25" y1="25" x2="34" y2="34" stroke="#969696" stroke-width="2.5" stroke-linecap="round" />
                </svg>
            </span>
        </div>
    </section>

    <section class="ready-solutions">
        <h2> Готовые решения </h2>
        <div class="products">
            <?php
            $result = $conn->query("SELECT * FROM products LIMIT 4");
            while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <div class="product-name"><?= htmlspecialchars($row['name']) ?></div>
                    <div class="product-price"><?= number_format($row['price'], 0, '', ' ') ?> Р.</div>
                    <button class="product-btn">В корзину</button>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <section class="about-company">
        <div class="about-card">
            <div class="about-text">
                <p class="about-title">О компании</p>
                <p class="about-description">
                    Более 7 лет «Fabrika» радует своих клиентов, воплощая идеи в уникальную мягкую мебель
                    изготовленную по индивидуальному заказу.
                </p>
                <p class="about-description">
                    Соединяя передовые технологии и многолетний опыт, мы не просто создаем широкий модельный ряд
                    или
                    восстанавливаем износившуюся мебель, но и вдыхаем новую жизнь в ваш интерьер!
                </p>
                <p class="about-description">
                    А получить предворительную оценку стоимости можно просто прислав проект, любым удобным для
                    вас
                    образом, или приехав к нам в офис.
                </p>
            </div>
            <img src="img/about.jpg" alt="О компании" class="about-image">
        </div>
    </section>
    <section class="job-application">
        <div class="application-card">
            <h2>ОСТАВЬТЕ ЗАЯВКУ</h2>
            <P>Мы свяжемся с вами и расскажем подробнее обо всех видах услуг</P>
            <div class="contacts">
                <input type="text" placeholder="Как вас зовут?" class="contact-input contact-name" id="contact-name">
                <input type="tel" placeholder="+7 (___) ___-__-__" class="contact-input contact-tel" id="contact-tel">
                <input type="email" placeholder="Email" class="contact-input contact-email" id="contact-email">
            </div>
            <div class="message">
                <input type="text" placeholder="Сообщение" class="contact-input contact-message">
            </div>
            <div class="checkbox-wrapper">
                <input type="checkbox" id="agree" class="contact-checkbox">
                <label for="agree">Соглашаюсь с условиями обработки персональных данных</label>
            </div>
            <button class="send-job-application-btn">
                <p>
                    Отправить
                </p>
            </button>
        </div>
    </section>

    <section class="news">

        <div class="news-titles">
            <h2> Новости</h2>
            <p> Все статьи ></p>
        </div>
        <div class="news-cards">
            <?php
            $result = $conn->query("SELECT * FROM news LIMIT 4");
            while ($row = $result->fetch_assoc()): ?>
                <div class="news-card">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['image']) ?>">
                    <div class="news-date">
                        <p>
                            <?= date('d.m.Y', strtotime($row['published_at'])) ?>
                        </p>
                        <p>
                            Чтение: 5 минут
                        </p>
                    </div>
                    <a class="news-title" href="db/get_news.php?id=<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['title']) ?>
                    </a>
                    <div class="news-description">
                        <?= htmlspecialchars($row['description']) ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>


</main>

<?php include 'footer.php'; ?>