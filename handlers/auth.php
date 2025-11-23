<?php
session_start();
// Подключение базы данных
require_once('../config/database.php');
// Подключение помощника
include('../includes/helpers.php');

// Проверяем на соответсвтие запросу POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из $_POST
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Массив с ошибками
    $errors = [];

    // Проверяем поля на ошибки
    if (empty($email)) {
        $errors['email'] = 'Поле Email не может быть пустым';
    } elseif (!validateEmail($email)) {
        $errors['email'] = 'Email не валидный';
    }

    if (empty($password)) {
        $errors['password'] = 'Поле Пароль не может быть пустым';
    }

    // Если ошибок нет, то авторизуем пользователя
    if (empty($errors)) {
        $pdo = new Database();

        try {
            $userStmt = $pdo->query('SELECT * FROM users WHERE `email` = ?', [$email]);
            $user = $userStmt->fetch();
    
            if ($user && password_verify($password, $user['password'])) {
                // Обновляем сессию
                session_regenerate_id(true);
    
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['logged_in'] = true;
                $_SESSION['login_time'] = time();
    
                $_SESSION['success'] = 'Вы успешно авторизованы';
                header('Location: ../index.php');
                exit;
            }
        } catch (PDOException $e) {
                $errors['auth'] = 'Неверный Email или Пароль';

                $_SESSION['errors'] = $errors;
            }
    }
}