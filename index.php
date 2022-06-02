<?php
session_start();

if (isset($_SESSION["id"])){
    $is_auth = 1;
    $user_name = $_SESSION["name"];
    $avatar = $_SESSION['avatar'];
}else{
    $is_auth = 0;
    $user_name = true;
    $avatar = true;
}


require_once('functions.php');
require_once('data.php');

$main = include_template(
    'index.php',
    [
    'categories' => $categories,
    'lots' => $lots
    ]
);

$layout_content = include_template(
    'layout.php',
    [
    'title' => 'Главная страница',
    'main' => $main,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'avatar' => $avatar
    ]
);

print($layout_content);
?>

