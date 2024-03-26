<?php
session_start();
require(__DIR__ . '/../vendor/autoload.php');
$db_function_class = new db_function();

$login = $_POST["username"];
$password = md5($_POST["password"]);

$db_function_class->authenticate($login, $password);

