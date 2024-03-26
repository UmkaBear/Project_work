<?php
session_start();
$_SESSION['messege'] = '';
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
    <form class="form_1" action="src/signin.php" method="post">
        <h1>Авторизация</h1>
        <label for="username">Логин:</label>
        <input type="text" name="username" placeholder="Введите логин:">
        <label for="password">Пароль:</label>
        <input type="password" name="password" placeholder="Введите пароль:">
        <button type="submit">Войти</button>
        <a href="register.php">Зарегистрироваться</a>
        <?php
        if ($_SESSION['messege']) {
            echo '<p class="msg"> ' . $_SESSION['messege'] . '</p>';
        }
        unset ($_SESSION['messege']);
        ?>
    </form>
</main>
</body>
</html>

