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

if ($is_auth == 1){




    $form_valid = true;

    $errors = array(
        "lot_name_ok" => true,
        "category_ok" => true,
        "message_ok" => true,
        "lot_img_ok" => true,
        "lot_rate_ok" => true,
        "lot_step_ok" => true,
        "lot_date_ok" => true
    );

    $fields_data = array(
        "lot_name" => '',
        "category" => '',
        "message" => '',
        "lot_img" => '',
        "lot_rate" => '',
        "lot_step" => '',
        "lot_date" => ''
    );

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(!isset($_POST['category'])){
            $_POST['category'] = '';
        }

        $file = $_FILES['lot-img']['name'];
        $path = $_FILES['lot-img']['tmp_name'];
        move_uploaded_file($path,'img/'.$file);

        $date = date('Y-m-d');
        $date = date("Y-m-d",strtotime($date));
        $date2 = $_POST['lot-date'];
        //$date2 = date('Y-m-d', strtotime($date. ' + 1 day'));

        $lot_name_ok = !""==$_POST['lot-name'];
        $category_ok = !""==$_POST['category'];
        $message_ok = !""==$_POST['message'];
        $lot_img_ok = !""==$_FILES['lot-img']['name'];
        $lot_rate_ok = is_numeric($_POST['lot-rate']);
        $lot_step_ok = is_numeric($_POST['lot-step']);
        $lot_date_ok = !""==$_POST['lot-date'];

        $form_valid = ($lot_name_ok and $category_ok and $message_ok and $lot_img_ok and $lot_rate_ok and $lot_step_ok and $lot_date_ok);

        /*
        echo '<br>lot-name: '.($lot_name_ok?'true':'false');
        echo '<br>category: '.($category_ok?'true':'false');
        echo '<br>message: '.($message_ok?'true':'false');
        echo '<br>lot-img: '.($lot_img_ok?'true':'false');
        echo '<br>lot-rate: '.($lot_rate_ok?'true':'false');
        echo '<br>lot-step: '.($lot_step_ok?'true':'false');
        echo '<br>lot-date: '.($lot_date_ok?'true':'false');

        echo '<br>form_valid: '.($form_valid?'true':'false');
    */
        $fields_data = array(
            "lot_name" => $_POST['lot-name'],
            "category" => $_POST['category'],
            "message" => $_POST['message'],
            "lot_img" => $_FILES['lot-img'],
            "lot_rate" => $_POST['lot-rate'],
            "lot_step" => $_POST['lot-step'],
            "lot_date" => $_POST['lot-date']
        );

        $errors = array(
            "lot_name_ok" => $lot_name_ok,
            "category_ok" => $category_ok,
            "message_ok" => $message_ok,
            "lot_img_ok" => $lot_img_ok,
            "lot_rate_ok" => $lot_rate_ok,
            "lot_step_ok" => $lot_step_ok,
            "lot_date_ok" => $lot_date_ok
        );

        if($form_valid){

            $connect = new mysqli("localhost","root","","yeticaveartyom");

            $query = "
                    INSERT INTO lot VALUES (
                    null,

                    '".$date."',
                    '".$_POST['lot-name']."',
                    '".$_POST['message']."',
                    'img/".$_FILES['lot-img']['name']."',
                    '".$_POST['lot-rate']."',
                    '".$date2."',
                    '".$_POST['lot-step']."',

                    1,
                    null,
                    ".$_POST['category']."
                    )

                ";

            $connect->query($query);

            $added_lot_id = mysqli_insert_id($connect);

            header("location:lot.php?lot_id=$added_lot_id");

        }

    }


    require_once('functions.php');
    require_once('data.php');

    $main = include_template(
        'add.php',
        [
            'fields_data' => $fields_data,
            'form_valid' => $form_valid,
            'errors' => $errors,
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

}else{
    require_once('templates/403.html');
}


?>
