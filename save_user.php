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
        if (isset($_POST['fname'])) { $fname = $_POST['fname']; if ($fname == '') { unset($fname);} }
        if (isset($_POST['lname'])) { $lname = $_POST['lname']; if ($lname =='') { unset($lname);} }
        if (isset($_POST['phone'])) { $phone = $_POST['phone']; if ($phone == '') { unset($phone);} }
        if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
        if (empty($login) or empty($password) or empty($fname) or empty($lname) or empty($phone))
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        $login = stripslashes($login);
        $login = htmlspecialchars($login);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
        $fname = stripslashes($fname);
        $fname = htmlspecialchars($fname);
        $lname = stripslashes($lname);
        $lname = htmlspecialchars($lname);
        $phone = stripslashes($phone);
        $phone = htmlspecialchars($phone);
        $login = trim($login);
        $password = trim($password);
        $fname = trim($fname);
        $lname = trim($lname);
        $phone = trim($phone);
        include ("bd.php");
        $result = mysql_query("SELECT id FROM Users WHERE login='$login'",$db);
        $myrow = mysql_fetch_array($result);
        if (!empty($myrow['id'])) {
            exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
        }
        $result2 = mysql_query ("INSERT INTO Users (first_name, last_name, telephone, login, password) VALUES('$fname', '$lname', '$phone', '$login','$password')");
        if ($result2=='TRUE')
        {
            echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт.";
        }
        else {
            echo "Ошибка! Вы не зарегистрированы.";
        }
        ?>
</div>
<div id="fancyCountdown"></div>
</div>
</body>
</html>