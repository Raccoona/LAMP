<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Запись</title>
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
            <li class="active"><a href="reserve.php">Запись</a></li>
            <li><a href="contacts.html">Контакты</a></li>
            <li><a href="feedback.php">Отзывы</a></li>
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
        if (isset($_POST['my_select1'])) { $service = $_POST['my_select1']; }
        if (isset($_POST['my_select2'])) { $date=$_POST['my_select2']; }
        if (isset($_POST['my_select3'])) { $time = $_POST['my_select3'];}
        if (isset($_POST['phone'])) { $phone=$_POST['phone'];}
        if (empty($service) or empty($date) or empty($time) or empty($phone))
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }

        include ("bd.php");
        $login = $_SESSION["login"];
        $result0 = mysql_query ("SELECT * FROM Datetime WHERE id='$date'");
        $myrow0 = mysql_fetch_assoc($result0);
        $id = $myrow0['id'];
        $result1 = mysql_query ("UPDATE ServiceDatetime SET is_free=2 WHERE datetime_id='$id' AND service_id='$service'");
        $resultsd = mysql_query ("SELECT * FROM ServiceDatetime WHERE datetime_id='$id' AND service_id='$service'");
        $myrowsd = mysql_fetch_assoc($resultsd);
        $sdid = $myrowsd['id'];
        $resultu = mysql_query ("SELECT * FROM Users WHERE login='$login'");
        $myrow = mysql_fetch_array($resultu);
        $uid = $myrow['id'];
        $result2 = mysql_query ("INSERT INTO Journal (user_car_id, service_datetime_id, status) VALUES('$uid','$sdid', 'Wait')");
        if ($result2=='TRUE')
        {
            echo "Успешно!";
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