<?php
    session_start();


    require_once "connect.php";

    $login = $_POST["username"];
    $password = $_POST["password"];

    if ($login == '' || $password==''){
        $_SESSION['messege'] = 'Неверно введен логин или пароль';
        header('Location:../register.php');

        
    } else{
        $password= md5($password);
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        insert_data($login, $password);
        header('Location:../index.php');
        $_SESSION['messege'] = 'Регистрация прошла успешно';
    }
