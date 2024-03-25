<?php
    session_start();
    $title = "Update";
    require_once "src/connect.php";
    if(isset($_GET['id']))
    {
    $id = $_GET['id']; 
    
    $query = "select * from `student` where `id` = '$id'";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
};
    $classselect = $row['class'];
    $teacherselect = $row['teacher']; 
    
?>

<?php
    if(isset($_POST['update_student'])){
        if(isset($_GET['id_new'])){
            $idnew = $_GET['id_new'];
        }
        $a_name = $_POST['name'];
        $a_lastname = $_POST['lastname'];
        $a_fathername = $_POST['fathername'];
        $a_date = $_POST['date'];
        $a_teacher = $_POST['teacher'];
        $a_class = $_POST['class'];
        $query = "update `student` set `name`='$a_name',`lastname`='$a_lastname',`fathername`='$a_fathername',`date`='$a_date',`teacher`='$a_teacher',`class`='$a_class' where `id` = '$idnew'";
        $result = mysqli_query($connect,$query);
        header('Location:workplace.php');
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
    <link rel="stylesheet" type="text/css" href="src/normalize.css">
    <link rel="stylesheet" type="text/css" href="src/style.css">
</head>
<body>
    
    <main>
      <div id="okno">
        <form class="form_1" action="update_page.php?id_new=<?php echo $id?>" method="POST">
            <h1>Изменить ученика</h1>
                <div class="content_form">
                    <label for="student">Имя:</label>
                    <input type="text" value="<?php echo $row['name']?>" name="name" placeholder="Введите имя">
                </div>
                <div class="content_form">
                <label for="student">Фамилия:</label>
                <input type="text" value="<?php echo $row['lastname']?>" name="lastname"  placeholder="Введите фамилию">
            </div>
            <div class="content_form">
                <label for="student">Отчество:</label>
                <input type="text" value="<?php echo $row['fathername']?>" name="fathername" placeholder="Введите отчество">
            </div>
            <div class="content_form">
                <label for="student">Дата рождения:</label>
                <input type="date" value="<?php echo $row['date']?>" name="date" placeholder="Введите дату рождения">
            </div>
            <div class="content_form">
                <label for="student">Руководитель:</label>
                <select name="teacher" id="">
                    <?php
                        $query = "select * from `teacher`";
                        $result = mysqli_query($connect,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <option <?php if ($teacherselect == $row['lastname']) echo "selected";  ?> value="<?php echo $row['lastname']; ?>">
                                    <?php echo $row['lastname']; ?></td>
                                </option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div class="content_form">
                <label for="student">Класс:</label>
                <select name="class" id="">
                <?php
                        $query = "select * from `class`";
                        $result = mysqli_query($connect,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            ?> 
                                    <option <?php if ($classselect == $row['name']) echo "selected";  ?> value="<?php echo $row['name']; ?>">
                                    <?php echo $row['name']; ?>
                                    </option>

                            <?php
                        }
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