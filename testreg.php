<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Вход в Личный кабинет</title>
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
            <li><a href="reg.php">Регистрация</a></li>
            <li class="active"><a href="login.php">Личный кабинет</a></li>
            <form class="navbar-search pull-center">
                <input type="text" class="search-query" placeholder="Введите запрос" style="width:600px">
                <button type="submit" class="btn">Поиск</button>
            </form>
        </ul>
    </div>
    <div class="row-fluid" style="margin-top:25px">
        <?php
        session_start();
        if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
        if (empty($login) or empty($password))
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        $login = stripslashes($login);
        $login = htmlspecialchars($login);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
        $login = trim($login);
        $password = trim($password);
        include ("bd.php");

        $result = mysql_query("SELECT * FROM Users WHERE login='$login'",$db);
        $myrow = mysql_fetch_array($result);
        if (empty($myrow['password']))
        {
            exit ("Извините, введённый вами login или пароль неверный.");
        }
        else {
            if ($myrow['password']==$password) {
                $_SESSION['login']=$myrow['login'];
                $_SESSION['id']=$myrow['id'];
                echo "Вы успешно вошли на сайт!";
            }
            else {
                exit ("Извините, введённый вами login или пароль неверный.");
            }
        }

        if (isset($_POST['mode'])){
            session_unset();
            session_destroy();
            header("Location: login.php");
        }
        ?>
    </div>
    <div id="fancyCountdown"></div>
</div>
</body>
</html>