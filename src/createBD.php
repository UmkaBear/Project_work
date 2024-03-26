<?php
require(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$db_function_class = new db_function();
$db_function_class->createDatabase();
