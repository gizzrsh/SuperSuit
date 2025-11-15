<?php
$products_result = $pdo->query("SELECT * FROM product WHERE is_active = 1 ORDER BY created_at DESC");
$products = $products_result->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="catalog" id="catalog">
    <div class="container catalog__container">
        <h2 class="catalog__title">Костюмы в наличии</h2>
        <ul class="catalog__products">
            <?php foreach ($products as $product): ?>
                <li class="catalog__product">
                    <img src="images/<?= $product['image_url']; ?>" alt="<?php $product['image_url'] ?>" class="catalog__product-image">
                    <h4 class="catalog__product-name"><?= $product['name']; ?></h4>
                    <p  class="catalog__product-size">Размер: <?= $product['size']; ?></p>
                    <h5 class="catalog__product-price"><?= $product['price']; ?>₽/день.</h5>
                    <a  class="catalog__product-link btn" href="product.php?id=<?= htmlspecialchars($product['id']); ?>">Быстрый просмотр</a>
                    <p  class="catalog__product-stock"><?= $product['availability'] == 0 ? "<p style='color:red;'>Нет в наличии</p>" : "В наличии: ".$product['availability'] ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>