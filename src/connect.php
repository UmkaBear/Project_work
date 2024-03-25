<?php
require(__DIR__.'/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mysqldb = $_ENV["DB_HOST"];
$database = $_ENV["DB_BASE_NAME"];
$mysqldb_username = $_ENV["DB_LOGIN"];
$password = $_ENV["DB_PASSWORD"];

$connect = mysqli_connect($mysqldb, $mysqldb_username, $password, $database);

if (!$connect){
    die('Ошибка Подключения к базе данных');
}