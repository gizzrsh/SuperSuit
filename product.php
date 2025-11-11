<!-- Подключение database -->
<?php include('includes/database.php') ?>

<?php

$id = $_GET['id'];
$product_result = $dbh->prepare("SELECT * FROM product WHERE id = :id");
$product_result->bindParam(':id', $id);
$product_result->execute();
$product = $product_result->fetch(PDO::FETCH_ASSOC);

$images_result = $dbh->prepare("SELECT * FROM product_images WHERE product_id = :product_id ORDER BY sort_order");
$images_result->bindParam(':product_id', $product['id']);
$images_result->execute();
$images = $images_result->fetchAll();

?>

<!-- Подключение header -->
<?php include('includes/header.php') ?>

<div class="container">
    <section class="product">
        <div class="product__breadcrumbs breadcrumbs">
            <ul class="breadcrumbs__list">
                <li class="breadcrumbs__item"><a href="index.php" class="breadcrumbs__link">Главная</a></li>
                <span>/</span>
                <li class="breadcrumbs__item"><a href="product.php?id=<?= $product['id'] ?>" class="breadcrumbs__link" ><?= $product['name'] ?></a></li>
            </ul>
        </div>
        <div class="product__content">
            <div class="product__swiper">
                <div class="swiper mySwiper" thumbsSlider="">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide">
                            <img src="images/<?= $image['image_url'] ?>" alt="<?= $product['name'] ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide"> 
                            <img src="images/<?= $image['image_url'] ?>" alt="<?= $product['name'] ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="product__characteristics">
                <h1 class="product__name"><?= $product['name'] ?></h1>
                <p class="product__sku">SKU-000<?= $product['sku'] ?></p>
                <h3 class="product__price"><?= $product['price'] ?>₽/сутки.</h3>
                <h4>Комплектация:</h4>
                <p class="product__equipment"><?= $product['equipment'] ?></p>
                <h4>Размер:</h4>
                <p class="product__size"><?= $product['size'] ?></p>
                <button type="submit" class="product__btn btn">Оставить заявку</button>
                <p class="product__stock">В наличии: <?= $product['availability'] ?></p>
            </div>
            <div class="product__descriptions">
                <h4>Описание</h4>
                <p class="product__description"><?= $product['description'] ?></p>
            </div>

            <!-- swiper modal - fullscreen -->
            <div class="product__swiper-fullscreen modal">
                <button type="button" class="modal__close"><img src="images/cross.svg" alt=""></button>
                <div class="swiper swiperModal" thumbsSlider="">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide">
                            <img src="images/<?= $image[2] ?>" alt="<?= $product['name'] ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper swiperModal2">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide"> 
                            <img src="images/<?= $image[2] ?>" alt="<?= $product['name'] ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <!-- /swiper modal -->

        </div>
    </section>
</div>

<!-- Подключение popup -->
<?php include('includes/popup.php') ?>

<?php include('includes/footer.php') ?>