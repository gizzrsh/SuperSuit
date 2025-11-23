<?php
// Подключение базы данных
require_once('../config/database.php');
// Подключение помощника
include('../includes/helpers.php');

// Проверяем на соответсвия запросу POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из $_POST
    $name               = $_POST['name'] ?? '';
    $email              = trim($_POST['email']) ?? '';
    $password           = $_POST['password'] ?? '';
    $password_confirm   = $_POST['password_confirm'] ?? '';

    // Массив с оштбками
    $errors = [];

    // Проверяем введенные данные на ошибки
    if (empty($name)) {
        $errors['name'] = 'Поле Имя не может быть пустым';
    } elseif (!strLenght($name)) {
        $errors['name'] = 'Имя должно иметь от 2 до 50 символов';
    }

    if (empty($email)) {
        $errors['email'] = 'Поле Email не может быть пустым';
    } elseif(!validateEmail($email)) {
        $errors['email'] = 'Email не валидный';
    }

    if (empty($password)) {
        $errors['password'] = 'Поле Пароль не может быть пустым';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Пароль должен быть не менее 6 символов';
    } elseif ($password !== $password_confirm) {
        $errors['password_confirm'] = 'Пароли не совпадают';
    }

    // Если ошибок нет, то создаем пользователя
    if (empty($errors)) {
        $pdo = new Database();

        try {
            // Проверка существования пользователя с таким Email
            $existingUser = $pdo->query('SELECT id FROM users WHERE email = ?', [$email])->fetch();
            if ($existingUser) {
                $errors['email'] = 'Пользователь с таким Email уже существует';
            } else {
                // Хешируем пароль
                $password_hashed = password_hash($password, PASSWORD_BCRYPT);

                // Если пользователя нет с таким Email, то создаем нового
                $pdo->query('INSERT INTO `users`(`email`, `password`, `name`) VALUES (?, ?, ?)', [$email, $password_hashed, $name]);

                // Редирект на основную страницу сайта после успешной регистрации
                header('Location: ../index.php?registration=success#popup-auth');
                exit;
            }
        } catch (PDOException $e){
            $errors['database'] = 'Ошибка при регистрации. Попробуйте позже.';
        }
    }

    if (!empty($errors)) {
        header('Location: ../index.php#popup-register');
        exit;
    }
}