<?php
session_start();
define('APP_PATH', __DIR__);

include(APP_PATH . '/includes/helpers.php');
include(APP_PATH . '/config/database.php');

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $uri);

require_once APP_PATH . '/routes/web.php';


?>