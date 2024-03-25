<?php
require_once "function.php";
require(__DIR__.'/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mysqldb = $_ENV["DB_HOST"];
$mysqldb_username = $_ENV["DB_LOGIN"];
$pass = $_ENV["DB_PASSWORD"];
$database = $_ENV["DB_BASE_NAME"];
$connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);


if (!$connect){
    die('Ошибка Подключения к базе данных');
}