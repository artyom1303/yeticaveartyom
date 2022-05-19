<?php
$is_auth = rand(0, 1);
$user_name = 'user'; // укажите здесь ваше имя

require_once('functions.php');
require_once('data.php');

$main = include_template(
    'index.php',
    [
    'categories' => $categories,
    'lots' => $lots,
    ]
);

$layout_content = include_template(
    'layout.php',
    [
    'title' => 'Главная страница',
    'main' => $main,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name
    ]
);

print($layout_content);
?>

