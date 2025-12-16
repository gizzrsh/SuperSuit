<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аренда костюмов</title>
    <link rel="stylesheet" href="<?php APP_PATH ?>/resources/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="container header__container">
            <div class="header__main">
                <a href="/" class="header__logo">SuperSuit</a>
            </div>
            <div class="header__auth">
                <!-- Авторизован, показываем кнопку на личный кабинет и выход -->
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <!-- ссылка в личный кабинет -->
                    <a href="/user" class="cabinet-link header_btn"><img src="/resources/images/login-link.png" alt="cabinet"></a>
                    <!-- выход из аккаунта -->
                    <form action="/handlers/logout.php">
                        <button type="submit" class="logout-link header_btn"><img src="/resources/images/logout-link.png" alt="logout"></button>
                    </form>
                <!-- Не авторизован, показываем кнопку на вход -->
                <?php else: ?>
                    <!-- кнопка для входа в аккаунт -->
                    <button type="button" class="login-link header_btn"><img src="/resources/images/login-link.png" alt="login"></button>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="main">