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
$dbHost = 'mysqldb';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'test';
$filePath = 'sql/project_1.sql';

restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath);