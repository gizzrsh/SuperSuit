<?php 

$user = 'root';
$pass = '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=supersuit;charset=utf8mb4', $user, $pass);

} catch (PDOException $e) {

}