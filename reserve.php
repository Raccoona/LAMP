<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Запись</title>
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
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
            <h2>Запись на услугу</h2>
            <?php
                if (empty($_SESSION['login']) or empty($_SESSION['id']))
                {
                    echo "Чтобы записаться на услугу, необходимо <a href='reg.php'>зарегистрироваться</a> или <a href='login.php'>авторизоваться</a>";
                }
                else {
                    include("bd.php");
                    echo '
                    <form action="save_service.php" method="post">
                    <p>
                        <label>Услуга:<br></label>
                        <select name="my_select1"><option value="service">Выбрать</option>';
                    $sql = "SELECT * FROM Service s JOIN ServiceDatetime sd ON s.id=sd.service_id ";
                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_assoc($rs)) {
                        $uid = $row["id"];
                        echo '<option value="' . $row["id"] . '" ';
                        ($_POST['my_select'] == "$uid") ? "selected" : "";
                        echo '>' . $row["name"] . '</option>';
                    }
                    echo '</select>
                    </p>
                    <p>
                        <label>День:<br></label>
                        <select name="my_select2"><option value="data">Выбрать</option>';
                    $sql = "SELECT * FROM Datetime d JOIN ServiceDatetime sd ON d.id=sd.datetime_id";
                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_assoc($rs)) {
                        $did = $row["id"];
                        echo '<option value="' . $row["id"] . '" ';
                        ($_POST['my_select2'] == "$did") ? "selected" : "";
                        echo '>' . $row["datecol"] . '</option>';
                    }
                    echo '</select>
                    </p>
                    <p>
                        <label>Время:<br></label>
                        <select name="my_select3"><option value="time">Выбрать</option>';
                    $sql = "SELECT * FROM Datetime d JOIN ServiceDatetime sd ON d.id=sd.datetime_id";
                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_assoc($rs)) {
                        $tid = $row["id"];
                        echo '<option value="' . $row["id"] . '" ';
                        ($_POST['my_select3'] == "$tid") ? "selected" : "";
                        echo '>' . $row["timecol"] . '</option>';
                    }
                    echo '</select>
                    </p>
                    <p>
                        <label>Телефон:<br></label>
                        <input name="phone" type="text" size="15" maxlength="15">
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Записаться">
                    </p>
                    </form>';
            }
            ?>
		</div>
	</div>
</body>
</html>