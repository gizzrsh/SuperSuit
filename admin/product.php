<?php require_once('../includes/database.php') ?>

<?php
$id = isset($_GET['id']) ? filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT): false;

if ($id) {
    $productResult = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $productResult->execute(['id' => $id]);
    $product = $productResult->fetch();

    $imagesResult = $pdo->prepare("SELECT * FROM product_images WHERE product_id = :id");
    $imagesResult->bindParam('id', $id);
    $imagesResult->execute();
    $images = $imagesResult->fetchAll();
}

$name         = $_POST['name'] ?? $product['name'] ?? '';
$description  = $_POST['description'] ?? $product['description'] ?? '';
$price        = $_POST['price'] ?? $product['price'] ?? 0;
$equipment    = $_POST['equipment'] ?? $product['equipment'] ?? '';
$size         = $_POST['size'] ?? $product['size'] ?? 0;
$availability = $_POST['availability'] ?? $product['availability'] ?? 0;
$is_active    = $_POST['is_active'] ?? $product['is_active'] ?? 0;

$errors         = [];
$uploadedImages = [];
$uploadDir      = '../images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($name)) {
        $errors[] = "Введите название костюма";
    }
    
    if ($price <= 0) {
        $errors[] = "Стоимость должна быть больше 0";
    }

    if ($availability < 0) {
        $errors[] = "Товаров не может быть меньше 0";
    }

    if (!empty($_FILES['image_url']['name'][0])) {
        $savedFiles = [];
    }

    foreach ($_FILES['image_url']['tmp_name'] as $key => $tmpName) {
        if ($_FILES['image_url']['error'][$key] === UPLOAD_ERR_OK) {
            $originalName = $_FILES['image_url']['name'][$key];
            $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);

            $newFileName = 'product-' . $nameWithoutExtension . '_' . time() . '.' . $fileExtension;
            $destination = $uploadDir . $newFileName;
            
            if (move_uploaded_file($tmpName, $destination)) {
                $savedFiles[] = $newFileName;
            }
        }
    }

    if (isset($_POST['add'])) {
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO `product` (`name`, `description`, `price`, `equipment`, `size`, `availability`, `image_url`, `is_active`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $equipment, $size, $availability, $savedFiles['0'], $is_active]);

            $productId = $pdo->lastInsertId();

            $imageStmt = $pdo->prepare("INSERT INTO `product_images` (`product_id`, `image_url`, `sort_order`, `is_main`)
            VALUES (?, ?, ?, ?)");

            foreach ($savedFiles as $index => $image) {
                $imageStmt->execute([
                    $productId,
                    $image,
                    $index,
                    0
                ]);
            }

            $pdo->commit();
            header("Location: ../product.php?id=" . $productId);
            exit;

        } catch (Exception $e) {
            $pdo->inTransaction();
            $pdo->rollBack();
            echo "Ошибка: " . $e->getMessage();
        }
    }

    if (isset($_POST['save'])) {
        $updateStmt = $pdo->prepare("UPDATE `product` 
        SET `name` = ?, `description` = ?, `price` = ?, `equipment` = ?, `size` = ? , `availability` = ?, `is_active` = ? WHERE id = ?");
        $updateStmt->execute([$name, $description, $price, $equipment, $size, $availability, $is_active, $id]);
        
        header("Location: ../product.php?id=" . $id);
        exit;
    }

}
?>

<?php include('./includes/header.php') ?>

<section class="product">
    <div class="product__container container">
        <form action="" method="post" enctype="multipart/form-data" class="product__form">
            <fieldset>
                <legend><?= $id ? "Редактирование" : "Добавление" ?> карточки товара</legend>

                <ul class="product__form-list">
                    <li class="product__form-item">
                        <label for="name">Название костюма:</label>
                        <input type="text" id="name" name="name" value="<?= isset($product['name']) ? htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    </li>
                    <li class="product__form-item">
                        <label for="description">Описание костюма:</label>
                        <textarea name="description" id="description"><?= isset($product['description']) ? htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                    </li>
                    <li class="product__form-item">
                        <label for="price">Стоимость костюма (в рублях):</label>
                        <input type="number" id="price" name="price" value="<?= isset($product['price']) ? htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8') : 0; ?>">
                    </li>
                    <li class="product__form-item">
                        <label for="equipment">Комплектация костюма:</label>
                        <input type="text" id="equipment" name="equipment" value="<?= isset($product['equipment']) ? htmlspecialchars($product['equipment'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    </li>
                    <li class="product__form-item">
                        <label for="size">Размер костюма:</label>
                        <input type="number" id="size" name="size" value="<?= isset($product['size']) ? htmlspecialchars($product['size'], ENT_QUOTES, 'UTF-8') : 44; ?>">
                    </li>
                    <li class="product__form-item">
                        <label for="availability">Количество костюмов в наличии (штук.):</label>
                        <input type="number" id="availability" name="availability" value="<?= isset($product['availability']) ? htmlspecialchars($product['availability'], ENT_QUOTES, 'UTF-8') : 0; ?>">
                    </li>
                    <li class="product__form-item">
                        <label for="image_url">Изображение костюма (можно выбрать несколько):</label>
                        <input type="file" id="image_url" name="image_url[]" accept="image/*" multiple>
                    </li>
                    <?php if ($id): ?>
                    <li class="product__form-item">
                        <div class="product__form-images">
                            <?php foreach ($images as $image): ?>
                                <img src="<?= $uploadDir . $image['image_url'] ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>" width="150" loading="lazy">
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <?php endif; ?>
                    <li class="product__form-item">
                        <label for="is_active">Активен ли товар (по умолчанию: Да)</label>
                        <select id="is_active" name="is_active">
                            <?php if (!$id): ?>
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            <?php elseif ($id): ?>
                                <option value="1" <?= ($product['is_active'] === 1) ? 'selected' : '' ?>>Да</option>
                                <option value="0" <?= ($product['is_active'] === 0) ? 'selected' : '' ?>>Нет</option>
                            <?php endif; ?>
                        </select>
                    </li>
                </ul>

                <?php if ($id): ?>
                    <button type="submit" class="product__form-btn btn" name="save">Сохранить</button>
                <?php elseif(!$id): ?>
                    <button type="submit" class="product__form-btn btn" name="add">Добавить костюм</button>
                <?php endif; ?>
            </fieldset>
        </form>
    </div>
</section>

<?php include('./includes/footer.php') ?>