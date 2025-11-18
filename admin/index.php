<?php include('../includes/database.php') ?>

<?php
$products_result = $pdo->prepare("SELECT * FROM product ORDER BY created_at DESC LIMIT 50 OFFSET 0;");
$products_result->execute();
$products = $products_result->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('./includes/header.php') ?>

<section class="dashboards">
    <div class="dashboards__container container">
        <h1 class="dashboards__title">Admin Panel</h1>

        <ul class="dashboards__list">
            <?php foreach ($products as $product): ?>
                <li class="dashboards__item">
                    <img class="dashboards__item-image" src="../images/<?= htmlspecialchars($product['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="dashboards__item-text">
                        <h4 class="dashboards__item-name"><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p class="dashboards__item-description"><?= mb_strimwidth(htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'), 0, 180, '. . .') ?></p>
                    </div>
                    <div class="dashboards__item-info">
                        <p class="dashboards__item-size">Размер: <?= htmlspecialchars($product['size'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <h5 class="dashboards__item-price"><?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>₽/день.</h5>
                        <?php if ($product['availability'] === 0): ?>
                            <p class="dashboards__item-stock">Нет в наличии</p>
                        <?php else: ?>
                            <p class="dashboards__item-stock">В наличии: <?= htmlspecialchars($product['availability'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="dashboards__item-actions">
                        <a href="product.php?id=<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" class="dashboards__item-btn btn">Редактировать</a>
                        <form action="" method="POST" onsubmit="return confirm('Удалить товар?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                            <button class="dashboards__item-btn btn">Удалить</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php include('./includes/footer.php') ?>