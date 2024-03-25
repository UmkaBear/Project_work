<?php
function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){

    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    $templine = '';


    $lines = file($filePath);

    $error = '';


    foreach ($lines as $line){

        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }

        $templine .= $line;


        if (substr(trim($line), -1, 1) == ';'){

            if(!$db->query($templine)){
                $error .= 'Ошибка<b>' .
                    $templine . '</b>": ' . $db->error . '<br /><br />'; }


            $templine = '';
        }
    }
    return !empty($error)?$error:true;
}
require(__DIR__.'/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV["DB_HOST"];
$dbUsername = $_ENV["DB_LOGIN"];
$dbPassword = $_ENV["DB_PASSWORD"];
$dbName = $_ENV["DB_BASE_NAME"];
$filePath = 'sql/project_1.sql';

restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath);