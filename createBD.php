<?php
$servername = "mysqldb";
$username = "root";
$password = "root";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Ошибка" . $conn->connect_error);
}

$sql = "CREATE DATABASE test";
if ($conn->query($sql) === TRUE) {
    echo "Создано";
} else {
    echo "Ошибка" . $conn->error;
}

$conn->close();
