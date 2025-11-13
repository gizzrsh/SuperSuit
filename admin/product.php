<?php include('../includes/database.php') ?>

<?php include('./includes/header.php') ?>

<?php

$name         = $_POST['name'] ?? '';
$description  = $_POST['description'] ?? '';
$price        = $_POST['price'] ?? 0;
$equipment    = $_POST['equipment'] ?? '';
$size         = $_POST['size'] ?? 0;
$availability = $_POST['availability'] ?? 0;
$is_active    = $_POST['is_active'] ?? 0;

$errors         = [];
$uploadedImages = [];
$uploadDir = '../images/';

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

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO `product`(`name`, `description`, `price`, `equipment`, `size`, `availability`, `is_active`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $equipment, $size, $availability, $is_active]);

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

    // 1) Принять данные из формы
    // 2) Сделать валидацию данных
    // 3) Добавить изображения в каталог сервера
    // 3) Добавить данные в базу данных

}

?>

<section class="product">
    <div class="product__container container">
        <form action="" method="post" enctype="multipart/form-data" class="product__form">
            <fieldset>
                <legend>Добавление карточки товара</legend>

                <ul class="product__form-list">
                    <li class="product__form-item">
                        <label for="name">Название костюма:</label>
                        <input type="text" id="name" name="name">
                    </li>
                    <li class="product__form-item">
                        <label for="description">Описание костюма:</label>
                        <input type="text" id="description" name="description">
                    </li>
                    <li class="product__form-item">
                        <label for="price">Стоимость костюма (в рублях):</label>
                        <input type="number" id="price" name="price">
                    </li>
                    <li class="product__form-item">
                        <label for="equipment">Комплектация костюма:</label>
                        <input type="text" id="equipment" name="equipment">
                    </li>
                    <li class="product__form-item">
                        <label for="size">Размер костюма:</label>
                        <input type="number" id="size" name="size">
                    </li>
                    <li class="product__form-item">
                        <label for="availability">Количество костюмов в наличии (штук.):</label>
                        <input type="number" id="availability" name="availability">
                    </li>
                    <li class="product__form-item">
                        <label for="image_url">Изображение костюма (можно выбрать несколько):</label>
                        <input type="file" id="image_url" name="image_url[]" accept="image/*" multiple>
                    </li>
                    <li class="product__form-item">
                        <label for="is_active">Активен ли товар</label>
                        <select id="is_active" name="is_active">
                            <option value="1">Да</option>
                            <option value="0">Нет</option>
                        </select>
                    </li>
                </ul>

                <button type="submit" class="product__form-btn btn">Добавить костюм</button>

            </fieldset>
        </form>
    </div>
</section>

<?php include('./includes/footer.php') ?>