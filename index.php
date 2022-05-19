<?php
$is_auth = rand(0, 1);
$user_name = 'user'; // укажите здесь ваше имя

require_once('functions.php');

//$connection = new mysqli('127.0.0.1','root','','yeticaveartyom');
$connection = mysqli_connect('127.0.0.1', 'root', '', 'yeticaveartyom');
mysqli_set_charset($connection, utf8);

if (!$connection) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
} else {
    $sql = 'SELECT `name` as rus, `name_eng` as eng FROM category';
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($connection);
        $content = include_template('error.php', ['error' => $error]);
    }




    $sql = 'SELECT lot.name as name, category.name as category, image as url, starting_price as price FROM lot inner join category on lot.category_id = category.id';
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($connection);
        $content = include_template('error.php', ['error' => $error]);
    }
}

//print include_template('index.php', ['content' => $content, 'categories' => $categories]);

/*
$categories = [
    [
        'eng' => 'boards',
        'rus' => 'Доски и лыжи',
    ],
    [
        'eng' => 'attachment',
        'rus' => 'Крепления',
    ],
    [
        'eng' => 'boots',
        'rus' => 'Ботинки',
    ],
    [
        'eng' => 'clothing',
        'rus' => 'Одежда',
    ],
    [
        'eng' => 'tools',
        'rus' => 'Инструменты',
    ],
    [
        'eng' => 'other',
        'rus' => 'Разное',
    ],
];


$lots = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '10990',
        'url' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '159999',
        'url' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'url' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => '10999',
        'url' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => '7500',
        'url' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5400',
        'url' => 'img/lot-6.jpg'
    ],
];
*/


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

