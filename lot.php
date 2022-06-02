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

if(isset($_GET["lot_id"])){
    $id = $_GET["lot_id"];

    $found=false;
    foreach ($lots as $lot)
    {
        if($lot['lot_id']==$id){
            $currentLot=$lot;
            $found=true;
            break;
        }
    }
    if ($found) {

        $main = include_template(
            'lot.php',
            [
                'is_auth' => $is_auth,
                'categories' => $categories,
                'lots' => $lots,
                'currentLot' => $currentLot,
                'id' => $id,
            ]);

        $layout_content = include_template(
            'layout.php', [
            'title' => 'Главная страница',
            'main' => $main,
            'categories' => $categories,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'avatar' => $avatar
        ]);

        print($layout_content);

    }else{
        require_once('pages/404.html');
    }
}
else {
    require_once('pages/404.html');
}
?>
