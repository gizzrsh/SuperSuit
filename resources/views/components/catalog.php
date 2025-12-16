<?php

$pdo = new Database();

$products_result = $pdo->query("SELECT * FROM product WHERE is_active = 1  ORDER BY (availability = 0), created_at DESC;");
$products = $products_result->fetchAll();
?>

<section class="catalog" id="catalog">
    <div class="container catalog__container">
        <h2 class="catalog__title">Костюмы в наличии</h2>
        <ul class="catalog__products">
            <?php foreach ($products as $product): ?>
                <li class="catalog__product">
                    <img src="/resources/images/<?= htmlspecialchars($product['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>" class="catalog__product-image">
                    <h4 class="catalog__product-name"><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                    <p  class="catalog__product-size">Размер: <?= htmlspecialchars($product['size'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <h3 class="catalog__product-price"><?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>₽/сутки.</h3>
                    <a  class="catalog__product-link btn" href="product/<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>">Быстрый просмотр</a>
                    <?php if ((int)$product['availability'] === 0): ?>
                        <p  class="catalog__product-stock" style="color: red">Нет в наличии</p>
                    <?php else: ?>
                        <p class="catalog__product-stock">В наличии: <?= htmlspecialchars($product['availability'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>