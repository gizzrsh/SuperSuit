<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аренда костюмов</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="container header__container">
            <div class="header__main">
                <a href="index.php" class="header__logo">Super<span>Suit</span></a>
                <a href="tel:+375293512740" class="header__phone">+375 29 351-27-40</a>
            </div>
            <div class="header__auth">
                <button type="button" class="login-link header_btn"><img src="./images/login-link.png" alt="login"></button>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <form action="./handlers/logout.php">
                        <button type="submit" class="login-link header_btn"><img src="./images/logout-link.png" alt="logout"></button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="main">