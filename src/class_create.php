<?php
    require_once "connect.php";
    

    $name = $_POST["class"];

    if ($name == '' ){
        $_SESSION['messege'] = 'Неверно введен класс';
        header('Location:../workplace.php');

        
    } else{
        mysqli_query($connect, "INSERT INTO `class` (`id`, `name`) VALUES (NULL, '$name')");
        header('Location:../workplace.php');
    }