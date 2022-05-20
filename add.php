<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo 'post';
    echo '<br>';
    echo 'lot-name: '.$_POST['lot-name'];
    echo '<br>';
    echo 'category: '.$_POST['category'];
    echo '<br>';
    echo 'message: '.$_POST['message'];
    echo '<br>';



    $file = $_FILES['lot-img']['name'];
    if ( isset($_FILES['lot-img']['name']) ){
        $file = 'true';
    }
    else{
        $file = 'false';
    }
    $path = $_FILES['lot-img']['tmp_name'];
    //move_uploaded_file($path,'img/'.$file);
    echo 'file: '.$file;
    echo '<br>';

    echo 'lot-rate: '.$_POST['lot-rate'];
    echo '<br>';
    echo 'lot-step: '.$_POST['lot-step'];
    echo '<br>';
    echo 'lot-date: '.$_POST['lot-date'];
    echo '<br>';
}


$is_auth = rand(0, 1);
$user_name = 'user'; // укажите здесь ваше имя

require_once('functions.php');
require_once('data.php');

$main = include_template(
    'add.php',
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
        'user_name' => $user_name
    ]
);

print($layout_content);
?>
