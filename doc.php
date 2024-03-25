<?php
    session_start();
    $title = "Doc";
    require_once "src/connect.php";
    $check_student = mysqli_query($connect,"SELECT * FROM `student`");
    $allstudent = mysqli_num_rows($check_student);
    $check_student_2 = mysqli_query($connect,"SELECT * FROM `student` where `class` > '1я' and `class` < '3а'");
    $student_2 = mysqli_num_rows($check_student_2);
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
                    $sql = "SELECT MIN(date) AS min_date FROM student";
                    $result = mysqli_query($connect, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $min_date = $row['min_date'];
                    echo "Минимальная дата рождения ученика: " . $min_date;
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
                        $query = "SELECT * FROM `teacher`";
                        $result = mysqli_query($connect,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            $h = $row['lastname'];
                            $check_student_3 = mysqli_query($connect,"SELECT COUNT(*) AS student_count FROM `student` INNER JOIN `teacher` ON `student`.`teacher` = '$h'");
                            $student_3 = mysqli_fetch_assoc($check_student_3)['student_count'];
                            $student_3 = $student_3;
                            ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['fathername']; ?></td>
                                    <td><?php echo $student_3; ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>