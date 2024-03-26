<?php
session_start();
$title = "Update";
require_once "src/connect.php";
require_once "src/function.php";
$db_function_class = new db_function();
$db_function_class->updateStudent();
global $row;

global $id;
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
    <link rel="stylesheet" type="text/css" href="assets/normalize.css">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
<main>
    <div id="okno">
        <form class="form_1" action="update_page.php?id_new=<?php echo $id ?>" method="POST">
            <h1>Изменить ученика</h1>
            <div class="content_form">
                <label for="student">Имя:</label>
                <input type="text" value="<?php echo $row['name'] ?>" name="name" placeholder="Введите имя">
            </div>
            <div class="content_form">
                <label for="student">Фамилия:</label>
                <input type="text" value="<?php echo $row['lastname'] ?>" name="lastname" placeholder="Введите фамилию">
            </div>
            <div class="content_form">
                <label for="student">Отчество:</label>
                <input type="text" value="<?php echo $row['fathername'] ?>" name="fathername"
                       placeholder="Введите отчество">
            </div>
            <div class="content_form">
                <label for="student">Дата рождения:</label>
                <input type="date" value="<?php echo $row['date'] ?>" name="date" placeholder="Введите дату рождения">
            </div>
            <div class="content_form">
                <label for="student">Руководитель:</label>
                <select name="teacher" id="">
                    <?php
                    $db_function_class->teacherStudent();
                    ?>
                </select>
            </div>
            <div class="content_form">
                <label for="student">Класс:</label>
                <select name="class" id="">
                    <?php
                    $db_function_class->classUpdate();
                    ?>
                </select>
            </div>
            <div class="content_form">
                <button type="submit" name="update_student" value="">Обновить</button>
                <a href="workplace.php" class="close">Закрыть окно</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>