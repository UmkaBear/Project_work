<?php
require(__DIR__.'/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mysqldb = $_ENV["DB_HOST"];
$mysqldb_username = $_ENV["DB_LOGIN"];
$pass = $_ENV["DB_PASSWORD"];

$conn = new mysqli($mysqldb, $mysqldb_username, $pass);

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
