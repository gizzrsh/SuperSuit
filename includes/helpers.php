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