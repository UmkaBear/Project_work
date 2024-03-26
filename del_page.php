<?php
session_start();
$title = "Delite";
require_once "src/connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
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
        <form class="form_1" action="" method="GET">
            <h1>Удалить ученика?</h1>
            <div class="content_form">
                <a href="del.php?id=<?php echo $id; ?>">Подтвердить</a>
                <a href="workplace.php" class="close">Закрыть окно</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>