<?php
session_start();
$title = "Doc";
require_once "src/connect.php";
require_once "src/function.php";

docInfo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="src/normalize.css">
    <link rel="stylesheet" type="text/css" href="src/style.css">
</head>
<body>
<main>
    <div class="container">
        <div class="button_place">
            <a class="button_p" href="workplace.php">Назад</a>
        </div>
        <div>
            <p>Всего учеников: <?php echo $allstudent ?></p>
            <p>Учеников 2-х классов: <?php echo $student_2 ?></p>
            <p>
                <?php
                minDate();
                ?>
            </p>
            <p>Педогогический состав:</p>
        </div>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Количество учеников</th>
                </tr>
                </thead>
                <tbody>
                <?php
                allTeacher();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>