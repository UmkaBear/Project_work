<?php

require_once "connect.php";
function insert_data($login, $password) {
    $connect = mysqli_connect("mysqldb", "root", "root", "test");
    if (!$connect) {
        die("Ошибка подключения к базе данных: " . mysqli_error($connect));
    }
    $mysqli_query = mysqli_query($connect, "INSERT INTO user (login, password) VALUES ('$login', '$password')");
    if (!$mysqli_query) {
        throw new Exception('Query failed.', mysqli_error($connect));
    }
}
function authenticate($login, $password) {
    $connect = mysqli_connect("mysqldb", "root", "root", "test");
    $check_user = mysqli_query($connect,"SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user)>0){
        header('Location:../workplace.php');
    } else {
        header('Location:../index.php');
        $_SESSION['messege'] = 'Неправильный логин или пароль';
    }
}


