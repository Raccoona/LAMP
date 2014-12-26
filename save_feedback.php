<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Отзывы</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="js/count.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="defaultpage">
<div class="container">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <ul class="nav nav-pills">
            <a class="brand">Автосервис</a>
            <li class="divider-vertical"></li>
            <li><a href="default.html">Главная</a></li>
            <li><a href="staff.html">Персонал</a></li>
            <li><a href="service.html">Услуги</a></li>
            <li><a href="gallery.html">Фотогалерея</a></li>
            <li><a href="reserve.php">Запись</a></li>
            <li><a href="contacts.html">Контакты</a></li>
            <li class="active"><a href="feedback.php">Отзывы</a></li>
            <li><a href="reg.php">Регистрация</a></li>
            <li><a href="login.php">Личный кабинет</a></li>
            <form class="navbar-search pull-center">
                <input type="text" class="search-query" placeholder="Введите запрос" style="width:600px">
                <button type="submit" class="btn">Поиск</button>
            </form>
        </ul>
    </div>
    <div class="row-fluid" style="margin-top:25px">
        <?php
        if (isset($_POST['comment'])) { $comment=$_POST['comment']; }
        if (empty($comment))
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        include ("bd.php");
        $login = $_SESSION['login'];
        $res = mysql_query("SELECT id FROM Users WHERE login='$login'",$db);
        $myrow = mysql_fetch_array($res);
        $id = $myrow['id'];
        $result = mysql_query ("INSERT INTO Feedback (user_id, text) VALUES('$id', '$comment')");
        if ($result=='TRUE')
        {
            echo "Отзыв успешно опубликован.";
        }
        else {
            echo "Ошибка!";
        }
        ?>
    </div>
    <div id="fancyCountdown"></div>
</div>
</body>
</html>