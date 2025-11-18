<!-- Подключение database -->
<?php require_once __DIR__ . '/includes/database.php'; ?>

<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    exit('Invalid ID');
}

$product_result = $pdo->prepare("SELECT * FROM product WHERE id = :id");
$product_result->execute(['id' => $id]);
$product = $product_result->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    http_response_code(404);
    exit('404 Page Not Found');
}

$images_result = $pdo->prepare("SELECT * FROM product_images WHERE product_id = :product_id ORDER BY sort_order");
$images_result->execute(['product_id' => $product['id']]);
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
                <li class="breadcrumbs__item"><a href="product.php?id=<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" class="breadcrumbs__link" ><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></a></li>
            </ul>
        </div>
        <div class="product__content">
            <div class="product__swiper">
                <div class="swiper mySwiper" thumbsSlider="">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide">
                            <img src="images/<?= htmlspecialchars($image['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide"> 
                            <img src="images/<?= htmlspecialchars($image['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="product__characteristics">
                <h1 class="product__name"><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="product__sku">SKU-000<?= htmlspecialchars($product['sku'], ENT_QUOTES, 'UTF-8'); ?></p>
                <h3 class="product__price"><?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>₽/сутки.</h3>
                <h4>Комплектация:</h4>
                <p class="product__equipment"><?= htmlspecialchars($product['equipment'], ENT_QUOTES, 'UTF-8'); ?></p>
                <h4>Размер:</h4>
                <p class="product__size"><?= htmlspecialchars($product['size'], ENT_QUOTES, 'UTF-8'); ?></p>
                <button type="submit" class="product__btn btn">Оставить заявку</button>
                <p class="product__stock">В наличии: <?= htmlspecialchars($product['availability'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div class="product__descriptions">
                <h4>Описание</h4>
                <p class="product__description"><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <!-- swiper modal - fullscreen -->
            <div class="product__swiper-fullscreen modal">
                <button type="button" class="modal__close"><img src="images/cross.svg" alt=""></button>
                <div class="swiper swiperModal" thumbsSlider="">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide">
                            <img src="images/<?= htmlspecialchars($image['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper swiperModal2">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                        <div class="swiper-slide"> 
                            <img src="images/<?= htmlspecialchars($image['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
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