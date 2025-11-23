<?php require_once('./config/database.php') ?>

<?php
// Запускаем сессию
session_start();

// Очищаем сессию после показа ошибок
unset($_SESSION['auth_errors']);
unset($_SESSION['old_auth']);
?>

<?php include('includes/header.php') ?>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="container hero__container">
        <div class="hero__content">
            <div class="hero__text">
                <h1 class="hero__title"><span>Аренда костюмов</span> высшего качества <br> по доступной цене</h1>
                <a href="#catalog" class="hero__link btn">Подобрать костюм</a>
            </div>
            <div class="hero__image"><img src="images/hero__image.png" alt="hero image"></div>
        </div>
    </div>
</section>

<?php include('includes/catalog.php') ?>

<!-- Подключение popup -->
<?php include('includes/popup.php') ?>

<?php include('includes/footer.php') ?>