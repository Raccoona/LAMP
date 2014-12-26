<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Регистрация</title>
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
            <li><a href="feedback.php">Отзывы</a></li>
            <li class="active"><a href="reg.php">Регистрация</a></li>
            <li><a href="login.php">Личный кабинет</a></li>
            <form class="navbar-search pull-center">
                <input type="text" class="search-query" placeholder="Введите запрос" style="width:600px">
                <button type="submit" class="btn">Поиск</button>
            </form>
        </ul>
    </div>
    <div class="row-fluid" style="margin-top:25px">
        <?php
        if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
            echo '
                <h2>Регистрация</h2>
               <form action="save_user.php" method="post">
                <p>
                    <label>Имя:<br></label>
                    <input name="fname" type="text" size="15" maxlength="15">
                </p>
                <p>
                    <label>Фамилия:<br></label>
                    <input name="lname" type="text" size="15" maxlength="15">
                </p>
                <p>
                    <label>Телефон:<br></label>
                    <input name="phone" type="number" size="15" maxlength="15">
                </p>
                <p>
                    <label>Ваш логин:<br></label>
                    <input name="login" type="text" size="15" maxlength="15">
                </p>
                <p>
                    <label>Ваш пароль:<br></label>
                    <input name="password" type="password" size="15" maxlength="15">
                </p>
                <p>
                    <input type="submit" name="submit" value="Зарегистрироваться">
                </p></form> ';
        }
        else
        {
            echo "Вы вошли на сайт, как ".$_SESSION['login'];
            echo ' <br><a href="logout.php">Выйти</a>';
        }
        ?>
    </div>
    <div id="fancyCountdown"></div>
</div>
</body>
</html>