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

$fields_data = [
    'email' => NULL,
    'name' => NULL,
    'password' => NULL,
    'contacts' => NULL
];

$errors = [
    'email' => '',
    'name' => '',
    'password' => '',
    'contacts' => '',
    'avatar' => ''
];
$all_inputed = true;
$no_errors = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(   ""==$_POST['email']   ){   $errors['email']='Введите e-mail'; $all_inputed = false;   }
    if(   ""==$_POST['name']   ){   $errors['name']='Введите имя'; $all_inputed = false;   }
    if(   ""==$_POST['password']   ){   $errors['password']='Введите пароль'; $all_inputed = false;   }
    if(   ""==$_POST['contacts']   ){   $errors['contacts']='Напишите как с вами связаться'; $all_inputed = false;   }
    //if(   true   ){   $errors['avatar']='Загрузите аватар';   }
    if(   ""==$_FILES['avatar']['name']   ){   $errors['avatar']='Загрузите аватар'; $all_inputed = false;   }

    if ($all_inputed){

        $connect = new mysqli("localhost","root","","yeticaveartyom");

        /* проверка email */if(true){

        $query = "
SELECT email FROM user_
WHERE email='".$_POST['email']."'
";
        $result = $connect->query($query);
        if(!$result){
            die($connect->error." $query");
        }
        else{
            if(mysqli_num_rows($result)>0){
                $errors['email']='e-mail занят'; $no_errors = false;
            }
            else{
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $errors['email']='не валидный e-mail'; $no_errors = false;
                }
            }
        }
        }

        /* проверка avatar */if(true){
            $f = mime_content_type($_FILES['avatar']['tmp_name']);
            if (!($f == 'image/png' or $f == 'image/jpeg')) {
                $errors['avatar'] = 'Допустимые форматы файлов: jpg, jpeg, png';
                $no_errors = false;
            }
        }


        if($no_errors){

            $file = $_FILES['avatar']['name'];
            $path = $_FILES['avatar']['tmp_name'];
            move_uploaded_file($path,'avatars/'.$file);

            $date = date('Y-m-d H:i:s');
            $query = "
INSERT INTO user_ VALUES (
                    null,
                    '".$date."',
                    '".$_POST['email']."',
                    '".$_POST['name']."',
                    '".password_hash($_POST['password'], PASSWORD_DEFAULT)."',
                    '".$file."',
                    '".$_POST['contacts']."'
                    )
";
            $connect->query($query);

            header("location:login.php");
        }
    }

    $fields_data = [
        'email' => $_POST["email"],
        'name' => $_POST["name"],
        'password' => $_POST["password"],
        'contacts' => $_POST["contacts"]
    ];

}


require_once('functions.php');
require_once('data.php');

$main = include_template(
    'sign-up.php',
    [
        'all_inputed' => $all_inputed,
        'no_errors' => $no_errors,
        'errors' => $errors,
        'fields_data' => $fields_data,
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
