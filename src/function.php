<?php

class db_function
{
    public function updateStudent()
    {
        global $row;
        global $id;
        global $classselect;
        global $teacherselect;
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "select * from `student` where `id` = '$id'";
            $result = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($result);
            $classselect = $row['class'];
            $teacherselect = $row['teacher'];

        };


        if (isset($_POST['update_student'])) {
            if (isset($_GET['id_new'])) {
                $idnew = $_GET['id_new'];
            }
            $a_name = $_POST['name'];
            $a_lastname = $_POST['lastname'];
            $a_fathername = $_POST['fathername'];
            $a_date = $_POST['date'];
            $a_teacher = $_POST['teacher'];
            $a_class = $_POST['class'];
            $query = "update `student` set `name`='$a_name',`lastname`='$a_lastname',`fathername`='$a_fathername',`date`='$a_date',`teacher`='$a_teacher',`class`='$a_class' where `id` = '$idnew'";
            $result = mysqli_query($connect, $query);
            header('Location:workplace.php');

        }

    }

    public function classUpdate()
    {
        global $classselect;
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "select * from `class`";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option <?php if ($classselect == $row['name']) echo "selected"; ?> value="<?php echo $row['name']; ?>">
                <?php echo $row['name']; ?>
            </option>

            <?php
        }
    }

    public function teacherStudent()
    {
        global $teacherselect;
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "select * from `teacher`";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option <?php if ($teacherselect == $row['lastname']) echo "selected"; ?>
                    value="<?php echo $row['lastname']; ?>">
                <?php echo $row['lastname']; ?></td>
            </option>
            <?php
        }
    }

    public function delStudent()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "delete FROM `student`WHERE `id` = '$id'";
            $result = mysqli_query($connect, $query);
            header('Location:/../workplace.php');
        } else echo "Ошибка";
    }

    public function allTeacher()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "SELECT * FROM `teacher`";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $h = $row['lastname'];
            $check_student_3 = mysqli_query($connect, "SELECT COUNT(*) AS student_count FROM `student` INNER JOIN `teacher` ON `student`.`teacher` = '$h'");
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
    }

    public function minDate()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $sql = "SELECT MIN(date) AS min_date FROM student";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $min_date = $row['min_date'];
        echo "Минимальная дата рождения ученика: " . $min_date;
    }

    public function docInfo()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $check_student = mysqli_query($connect, "SELECT * FROM `student`");
        $allstudent = mysqli_num_rows($check_student);
        $check_student_2 = mysqli_query($connect, "SELECT * FROM `student` where `class` > '1я' and `class` < '3а'");
        $student_2 = mysqli_num_rows($check_student_2);
        global $allstudent;
        global $student_2;
    }

    public function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath)
    {

        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        $templine = '';


        $lines = file($filePath);

        $error = '';


        foreach ($lines as $line) {

            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }

            $templine .= $line;


            if (substr(trim($line), -1, 1) == ';') {

                if (!$db->query($templine)) {
                    $error .= 'Ошибка<b>' .
                        $templine . '</b>": ' . $db->error . '<br /><br />';
                }


                $templine = '';
            }
        }
        return !empty($error) ? $error : true;
    }

    public function createDatabase()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];

        $conn = new mysqli($mysqldb, $mysqldb_username, $pass);

        if ($conn->connect_error) {
            die("Ошибка" . $conn->connect_error);
        }

        $sql = "CREATE DATABASE test";
        if ($conn->query($sql) === TRUE) {
            echo "Создано";
        } else {
            echo "Ошибка" . $conn->error;
        }

        $conn->close();
    }

    public function teacherCreate()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $fathername = $_POST["fathername"];
        $class = $_POST["class"];

        if ($name == '') {
            $_SESSION['messege'] = 'Неверно введен учитель';
            header('Location:../workplace.php');


        } else {
            mysqli_query($connect, "INSERT INTO `teacher` (`id`, `name`,`lastname`,`fathername`,`class`) VALUES (NULL, '$name','$lastname','$fathername','$class')");
            header('Location:../workplace.php');
        }
    }

    public function studentCreate()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $fathername = $_POST["fathername"];
        $date = $_POST["date"];
        $class = $_POST["class"];
        $teacher = $_POST["teacher"];

        if ($name == '') {
            $_SESSION['messege'] = 'Неверно введен ученик';
            header('Location:../workplace.php');


        } else {
            mysqli_query($connect, "INSERT INTO `student` (`id`, `name`, `lastname`, `fathername`, `date`, `teacher`, `class`) VALUES (NULL, '$name', '$lastname', '$fathername', '$date', '$teacher', '$class')");
            header('Location:../workplace.php');
        }
    }

    public function classCreate()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $name = $_POST["class"];
        if ($name == '') {
            $_SESSION['messege'] = 'Неверно введен класс';
            header('Location:../workplace.php');


        } else {
            mysqli_query($connect, "INSERT INTO `class` (`id`, `name`) VALUES (NULL, '$name')");
            header('Location:../workplace.php');
        }
    }

    public function select_rows()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "SELECT * FROM `class`";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
        }
    }

    public function getTeacherList()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "select * from `teacher`";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['lastname'] . "'>" . $row['lastname'] . "</option>";
        }
    }

    public function select_class($table_name)
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "select * from `class`";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
    }

    public function show_students()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "SELECT * FROM student";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['lastname'] . '</td>';
                echo '<td>' . $row['fathername'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['teacher'] . '</td>';
                echo '<td>' . $row['class'] . '</td>';
                echo '<td><a href="update_page.php?id=' . $row['id'] . '">Изменить</a></td>';
                echo '<td><a href="delite_page.php?id=' . $row['id'] . '">Удалить</a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="7">Нет данных</td>';
            echo '</tr>';
        }
    }

    public function connectDB()
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        if (!$connect) {
            die("Ошибка подключения к базе данных");
        }
        global $connect;
        return $connect;
    }

    public function insert_data($login, $password)
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        if (!$connect) {
            die("Ошибка подключения к базе данных: " . mysqli_error($connect));
        }
        $mysqli_query = mysqli_query($connect, "INSERT INTO user (login, password) VALUES ('$login', '$password')");
        if (!$mysqli_query) {
            throw new Exception('Query failed.', mysqli_error($connect));
        }
    }

    public function authenticate($login, $password)
    {
        $mysqldb = $_ENV["DB_HOST"];
        $mysqldb_username = $_ENV["DB_LOGIN"];
        $pass = $_ENV["DB_PASSWORD"];
        $database = $_ENV["DB_BASE_NAME"];
        $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $check_user = mysqli_query($connect, "SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
        if (mysqli_num_rows($check_user) > 0) {
            header('Location:../workplace.php');
        } else {
            header('Location:../index.php');
            $_SESSION['messege'] = 'Неправильный логин или пароль';
        }
    }
}




