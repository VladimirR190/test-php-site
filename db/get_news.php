<?php
require_once __DIR__ . '/db.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM news WHERE id = $id");
if ($row = $result->fetch_assoc()) {
    ?>
    <?php include '../header.php'; ?>
    <main class="main-news-content">



        <div class="news-card news-detail">
            <div class="breadcrumbs">
                <a href="#" class="breadcrumbs-blog">Блог</a>
                <p>></p> <span><?= htmlspecialchars($row['title']) ?></span>
            </div>
            <img src="../img/news-title.png" alt="img/news-title.png">
            <div class="news-wrapper">
                <div class="news-date">
                    <p><?= date('d.m.Y', strtotime($row['published_at'])) ?></p>
                    <img src="../img/clock.png" alt="Часы">
                    <p>Чтение: 5 минут</p>
                </div>


                <div class="news-title"><?= htmlspecialchars($row['title']) ?></div>

                <div class="news-content">
                    <p>Итак, на семейном совете принято решение отремонтировать мягкую мебель, и вы начали интересоваться
                        ценами
                        на её ремонт в различных мастерских (в Тюмени таких много). Проведя их анализ, у вас возник вопрос:
                        «Чем
                        можно объяснить разброс цен на ремонт и что же влияет на их формирование?».</p>
                    <p>Удивляться весьма большому разбросу не приходится, так как влияющих на стоимость ремонта мягкой
                        мебели
                        факторов очень много. Среди них</p>
                </div>
            </div>

        </div>
        <section class="news">

            <div class="news-titles">
                <h2>Наши статьи</h2>
                <p> Все статьи ></p>
            </div>
            <div class="news-cards">
                <?php
                $result = $conn->query("SELECT * FROM news LIMIT 4");
                while ($row = $result->fetch_assoc()): ?>
                    <div class="news-card">
                        <img src="../<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['image']) ?>">
                        <div class="news-date">
                            <p>
                                <?= date('d.m.Y', strtotime($row['published_at'])) ?>
                            </p>
                            <p>
                                Чтение: 5 минут
                            </p>
                        </div>
                        <a class="news-title" href="../db/get_news.php?id=<?= $row['id'] ?>">
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
    <?php include '../footer.php'; ?>
<?php
} else {
    echo '<p>Новость не найдена</p>';
}