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
    'sign-up.php',
    [
        'email_wrong' => $email_wrong,
        'password_wrong' => $password_wrong,
        'fields_data' => $fields_data,
        'email_valid' => $email_valid,
        'password_valid' => $password_valid,
        'categories' => $categories
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
