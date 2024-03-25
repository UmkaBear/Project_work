<?php
require_once "src/connect.php";
if(isset($_GET['id']))
    {
    $id = $_GET['id']; 

    $query = "delete FROM `student`WHERE `id` = '$id'";
    $result = mysqli_query($connect,$query);
    header('Location:workplace.php');
} else echo "Ошибка"
?>