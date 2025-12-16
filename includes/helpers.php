<?php

function generateSku($prefix = 'SKU') {
    // Генерируем случайную строку из букв и цифр
    $bytes = random_bytes(6);
    $randomString = bin2hex($bytes); // Получим 12 символов hex
    $randomString = strtoupper($randomString); // Делаем заглавными
    
    // Берем первые 8 символов
    $randomPart = substr($randomString, 0, 8);
    
    return $prefix . '-' . $randomPart;
}

function strLenght(string $str, int $min = 2, int $max = 50) {
    $lenght = mb_strlen($str);
    return $lenght > $min && $lenght < $max;
}

function validateEmail(string $email) {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    [$user, $domain] = explode('@', $email);
    return checkdnsrr($domain, 'MX');

}

function dd($value) {
    echo "<pre>";
        var_dump($value);
    echo "</pre>";
    exit;
}

function view($uri, $params = []) {
    extract($params, EXTR_SKIP); // EXTR_SKIP - не перезаписывает существующие переменные
    
    $viewPath = APP_PATH . "/resources/views/{$uri}";
    
    if (!file_exists($viewPath)) {
        throw new Exception("View [{$uri}] not found at: {$viewPath}");
    }
    
    include_once $viewPath;
}

