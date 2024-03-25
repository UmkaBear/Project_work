<?php
    require_once "connect.php";
    

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $fathername = $_POST["fathername"];
    $date = $_POST["date"];
    $class = $_POST["class"];
    $teacher = $_POST["teacher"];

 if ($name == '' ){
    $_SESSION['messege'] = 'Неверно введен ученик';
         header('Location:../workplace.php');

        
    } else{
         mysqli_query($connect, "INSERT INTO `student` (`id`, `name`, `lastname`, `fathername`, `date`, `teacher`, `class`) VALUES (NULL, '$name', '$lastname', '$fathername', '$date', '$teacher', '$class')");
         header('Location:../workplace.php');
     }