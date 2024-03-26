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
function createDatabase()
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
function teacherCreate()
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

    if ($name == '' ){
        $_SESSION['messege'] = 'Неверно введен учитель';
        header('Location:../workplace.php');


    } else{
        mysqli_query($connect, "INSERT INTO `teacher` (`id`, `name`,`lastname`,`fathername`,`class`) VALUES (NULL, '$name','$lastname','$fathername','$class')");
        header('Location:../workplace.php');
    }
}
function studentCreate()
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

    if ($name == '' ){
        $_SESSION['messege'] = 'Неверно введен ученик';
        header('Location:../workplace.php');


    } else{
        mysqli_query($connect, "INSERT INTO `student` (`id`, `name`, `lastname`, `fathername`, `date`, `teacher`, `class`) VALUES (NULL, '$name', '$lastname', '$fathername', '$date', '$teacher', '$class')");
        header('Location:../workplace.php');
    }
}
function classCreate(){
    $mysqldb = $_ENV["DB_HOST"];
    $mysqldb_username = $_ENV["DB_LOGIN"];
    $pass = $_ENV["DB_PASSWORD"];
    $database = $_ENV["DB_BASE_NAME"];
    $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
    $name = $_POST["class"];
    if ($name == '' ){
        $_SESSION['messege'] = 'Неверно введен класс';
        header('Location:../workplace.php');


    } else{
        mysqli_query($connect, "INSERT INTO `class` (`id`, `name`) VALUES (NULL, '$name')");
        header('Location:../workplace.php');
    }
}
function select_rows() {
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
function getTeacherList() {
    $mysqldb = $_ENV["DB_HOST"];
    $mysqldb_username = $_ENV["DB_LOGIN"];
    $pass = $_ENV["DB_PASSWORD"];
    $database = $_ENV["DB_BASE_NAME"];
    $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
    $query = "select * from `teacher`";
    $result = mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)){
        echo "<option value='". $row['lastname'] ."'>". $row['lastname'] ."</option>";
    }
}
function select_class($table_name) {
    $mysqldb = $_ENV["DB_HOST"];
    $mysqldb_username = $_ENV["DB_LOGIN"];
    $pass = $_ENV["DB_PASSWORD"];
    $database = $_ENV["DB_BASE_NAME"];
    $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
        $query = "select * from `class`";
        $result = mysqli_query($connect,$query);

        while($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        }
}
function show_students() {
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
            echo '<td><a href="del_page.php?id=' . $row['id'] . '">Удалить</a></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="7">Нет данных</td>';
        echo '</tr>';
    }
}
function connectDB(){
    $mysqldb = $_ENV["DB_HOST"];
    $mysqldb_username = $_ENV["DB_LOGIN"];
    $pass = $_ENV["DB_PASSWORD"];
    $database = $_ENV["DB_BASE_NAME"];
    $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
    if(!$connect){
        die("Ошибка подключения к базе данных");
    }
    global $connect;
    return $connect;
}
function insert_data($login, $password) {
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
function authenticate($login, $password) {
    $mysqldb = $_ENV["DB_HOST"];
    $mysqldb_username = $_ENV["DB_LOGIN"];
    $pass = $_ENV["DB_PASSWORD"];
    $database = $_ENV["DB_BASE_NAME"];
    $connect = mysqli_connect($mysqldb, $mysqldb_username, $pass, $database);
    $check_user = mysqli_query($connect,"SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user)>0){
        header('Location:../workplace.php');
    } else {
        header('Location:../index.php');
        $_SESSION['messege'] = 'Неправильный логин или пароль';
    }
}



