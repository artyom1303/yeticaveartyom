<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email_ok = !""==$_POST['email'];
    $password_ok = !""==$_POST['password'];

    $form_valid = ($email_ok and $password_ok);

    $fields_data = array(
        "email" => $_POST['email'],
        "password" => $_POST['password'],
    );

    if($form_valid){

        $wrong_password = false;

        $connect = new mysqli("localhost","root","","yeticaveartyom");

        $query = "
        SELECT password FROM user_ WHERE email = '".$_POST['email']."'
        ";


        //header("location:lot.php?lot_id=$added_lot_id");




        $result = $connect->query($query);
        if(!$result){
            die($connect->error." $query");
        }
        else{
            if(mysqli_num_rows($result)==0){
                echo "пользователя с таким почтовым адресом не существует";
            }
            else{
                echo "пользователь с таким почтовым адресом существует";
                echo "<br>";
                $user = $result->fetch_array();
                if($user['password']==$_POST['password']){
                    echo "правильный пароль";

                }else{
                    echo "неправильный пароль";
                    $wrong_password = true;
                }
            }
        }

    }

}


$is_auth = rand(0, 1);
$user_name = 'user'; // укажите здесь ваше имя

require_once('functions.php');
require_once('data.php');

$main = include_template(
    'login.php',
    [
        'wrong_password' => $wrong_password,
        'fields_data' => $fields_data,
        'email_ok' => $email_ok,
        'password_ok' => $password_ok,
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
        'user_name' => $user_name
    ]
);

print($layout_content);
?>
