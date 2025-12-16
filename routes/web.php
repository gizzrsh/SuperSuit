<?php 

if (count($parts) === 0 || $parts[0] === '') {
    // Главная страница
    view('welcome.php');
} elseif ($parts[0] === 'product' && isset($parts[1])) {
    // /product/123
    view('product.php', ['id' => $parts[1]]);
} elseif ($parts[0] === 'user') {
    // /user
    view('user/index.php');
} elseif ($parts[0] === 'admin') {
    // admin
    view('admin/index.php');
} else {
    
    // 404
    http_response_code(404);
    echo "Страница не найдена";

}