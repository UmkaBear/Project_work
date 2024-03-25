<?php
    require_once "connect.php";
    

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $fathername = $_POST["fathername"];
    $class = $_POST["class"];

    if ($name == '' ){
        $_SESSION['messege'] = 'Неверно введен учитель';
        header('Location:../workplace.php');

        
    } else{
        mysqli_query($connect, "INSERT INTO `teacher` (`id`, `name`,`lastname`,`fathername`,`class`) VALUES (NULL, '$name','$lastname','$fathername','$class')");
        header('Location:../workplace.php');
    }