<?php
session_start();
require_once "connect.php";
require_once "function.php";
$db_function_class = new db_function();

$login = $_POST["username"];
$password = $_POST["password"];

if ($login == '' || $password == '') {
    $_SESSION['messege'] = 'Неверно введен логин или пароль';
    header('Location:../register.php');
} else {
    $password = md5($password);
    $db_function_class->insert_data($login, $password);
    header('Location:../index.php');
    $_SESSION['messege'] = 'Регистрация прошла успешно';
}
