<?php
session_start();
require_once "connect.php";
require_once "function.php";

$login = $_POST["username"];
$password = md5($_POST["password"]);

authenticate($login, $password);

