<?php
    session_start();
    $title = "Admin";
    require_once "src/connect.php";
    require_once "src/function.php";
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
            <a class="button_p" href="doc.php">Отчет</a>
            <a class="button_p" href="#zatemnenie">Создать класс</a>
            <a class="button_p" href="#zatemnenie_2">Создать руководителя</a>
            <a class="button_p" href="#zatemnenie_3">Создать ученика</a>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Отчество</th>
                        <th>Дата рождения</th>
                        <th>Руководитель</th>
                        <th>Класс</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        show_students();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="zatemnenie">
      <div id="okno">
      <form class="form_1" action="src/class_create.php" method="post">
        <h1>Создать класс</h1>
        <div class="content_form">
            <label for="class">Класс:</label>
            <input type="text" name="class" placeholder="Введите номер класса">
        </div>
        <div class="content_form">
            <button type="submit">Отправить</button>
            <a href="#" class="close">Закрыть окно</a>
        </div>
        </form>
      </div>
    </div>
    <div id="zatemnenie_2">
      <div id="okno">
        <form class="form_1" action="src/teacher_create.php" method="post">
            <h1>Создать учителя</h1>
            <div class="content_form">
                <label for="teacher">Имя:</label>
                <input type="text" name="name" placeholder="Введите имя">
            </div>
            <div class="content_form">
                <label for="teacher">Фамилия:</label>
                <input type="text" name="lastname" placeholder="Введите фамилию">
            </div>
            <div class="content_form">
                <label for="teacher">Отчество:</label>
                <input type="text" name="fathername" placeholder="Введите отчество">
            </div>
            <div class="content_form">
                <label for="teacher">Класс:</label>
                <select name="class" id="">
                    <?php
                        select_class($table_name);
                    ?>
                </select>
            </div>
            <div class="content_form">
                <button type="submit">Отправить</button>
                <a href="#" class="close">Закрыть окно</a>
            </div>
        </form>
      </div>
    </div>
    <div id="zatemnenie_3">
      <div id="okno">
        <form class="form_1" action="src/student_create.php" method="POST">
            <h1>Создать ученика</h1>
                <div class="content_form">
                    <label for="student">Имя:</label>
                    <input type="text" name="name" placeholder="Введите имя">
                </div>
                <div class="content_form">
                <label for="student">Фамилия:</label>
                <input type="text" name="lastname" placeholder="Введите фамилию">
            </div>
            <div class="content_form">
                <label for="student">Отчество:</label>
                <input type="text" name="fathername" placeholder="Введите отчество">
            </div>
            <div class="content_form">
                <label for="student">Дата рождения:</label>
                <input type="date" name="date" placeholder="Введите дату рождения">
            </div>
            <div class="content_form">
                <label for="student">Руководитель:</label>
                <select name="teacher" id="">
                    <?php
                        getTeacherList();
                    ?>
                </select>
            </div>
            <div class="content_form">
                <label for="student">Класс:</label>
                <select name="class" id="">
                <?php
                    select_rows();  
                    ?>
                </select>
            </div>
            <div class="content_form">
                <button type="submit">Отправить</button>
                <a href="#" class="close">Закрыть окно</a>
            </div>
        </form>
      </div>
    </div>
</main>
</body>
</html>