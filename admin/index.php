<?php include('../includes/database.php') ?>

<?php
$products_result = $pdo->query("SELECT * FROM product ORDER BY created_at DESC");
$products = $products_result->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('./includes/header.php') ?>

<section class="dashboards">
    <div class="dashboards__container container">
        <h1 class="dashboards__title">Admin Panel</h1>

        <ul class="dashboards__list">
            <?php foreach ($products as $product): ?>
                <li class="dashboards__item">
                    <img src="../images/<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>" class="dashboards__item-image">
                    <div class="dashboards__item-text">
                        <h4 class="dashboards__item-name"><?= $product['name']; ?></h4>
                        <p class="dashboards__item-description"><?= substr($product['description'], 0, 210) ?>. . .</p>
                    </div>
                    <div class="dashboards__item-info">
                        <p class="dashboards__item-size">Размер: <?= $product['size']; ?></p>
                        <h5 class="dashboards__item-price"><?= $product['price']; ?>₽/день.</h5>
                        <p class="dashboards__item-stock"><?= $product['availability'] === 0 ? "Нет в наличии" : "В наличии: ".$product['availability'] ?></p>
                    </div>
                    <div class="dashboards__item-actions">
                        <a href="product.php?id=<?= htmlspecialchars($product['id']); ?>" class="dashboards__item-btn btn">Update</a>
                        <a href="#" class="dashboards__item-btn btn">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php include('./includes/footer.php') ?>