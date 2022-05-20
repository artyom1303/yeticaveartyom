<?php
$connection = mysqli_connect('127.0.0.1', 'root', '', 'yeticaveartyom');
mysqli_set_charset($connection, utf8);

if (!$connection) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
} else {
    $sql = 'SELECT id, name as rus, name_eng as eng FROM category';
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($connection);
        $content = include_template('error.php', ['error' => $error]);
    }




    $sql = '
SELECT
lot.id as lot_id,
lot.name as name,
description,
category.name as category,
image as url,
starting_price as price
FROM lot inner join category on lot.category_id = category.id
';
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($connection);
        $content = include_template('error.php', ['error' => $error]);
    }
}
?>
