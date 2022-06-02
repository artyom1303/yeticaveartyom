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

$password_wrong = false;
$email_wrong = false;
$email_valid = false;
$password_valid = false;
$fields_data = array(
    "email" => '',
    "password" => ''
);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email_valid = !""==$_POST['email'];
    $password_valid = !""==$_POST['password'];

    $form_valid = ($email_valid and $password_valid);

    $fields_data = array(
        "email" => $_POST['email'],
        "password" => $_POST['password'],
    );



    if($form_valid){
        $connect = new mysqli("localhost","root","","yeticaveartyom");
        $query = "
        SELECT id, name, password, avatar FROM user_ WHERE email = '".$_POST['email']."'
        ";
        $result = $connect->query($query);
        if(!$result){
            die($connect->error." $query");
        }
        else{
            if(mysqli_num_rows($result)==0){
                $email_wrong = true;
            }
            else{
                //echo "пользователь с таким почтовым адресом существует"; echo "<br>";
                $user = $result->fetch_array();
                if($user['password']==$_POST['password']){
                    //echo "правильный пароль";
                    $_SESSION["id"]=$user['id'];
                    $_SESSION["name"]=$user['name'];
                    $_SESSION["avatar"]=$user['avatar'];

                    header("location:index.php");
                }else{
                    $password_wrong = true;
                }
            }
        }
    }
}


require_once('functions.php');
require_once('data.php');

$main = include_template(
    'login.php',
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
