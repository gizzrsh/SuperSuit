<?php
session_start();

// Уничтожаем все данные сессии
$_SESSION = array();

// Уничтожаем сессию
session_destroy();

// Редирект на главную
header('Location: ../index.php');
exit;