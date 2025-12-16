<?php include('./resources/views/components/header.php') ?>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="container hero__container">
        <div class="hero__content">
            <div class="hero__text">
                <h1 class="hero__title"><span>Аренда костюмов</span> высшего качества <br> по доступной цене</h1>
                <a href="#catalog" class="hero__link btn">Подобрать костюм</a>
            </div>
            <div class="hero__image"><img src="./resources/images/hero__image.png" alt="hero image"></div>
        </div>
    </div>
</section>

<?php include './resources/views/components/catalog.php' ?>

<!-- Подключение popup -->
<?php include('./resources/views/components/popup.php') ?>

<?php include('./resources/views/components/footer.php') ?>