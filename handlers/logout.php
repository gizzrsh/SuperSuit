<?php

session_start();

// Уничтожаем все данные сессии
$_SESSION = [];

// Уничтожаем сессию
session_destroy();

// Редирект на главную
header('Location: /');
exit;
