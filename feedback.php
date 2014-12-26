<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Отзывы</title>
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
            <h2>Отзывы</h2>
            <?php
                include ("bd.php");
                $sql = "SELECT * FROM Feedback";
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_assoc($rs)) {
                    $userid = $row['user_id'];
                    $rs2 = mysql_query("SELECT login FROM Users WHERE id='$userid'", $db);
                    $row2 = mysql_fetch_assoc($rs2);
                    $name = $row2['login'];
                    $text = $row['text'];
                    echo "<table>
                            <tr>
                                <td><div style='font-size:10pt; color:purple;'>$name</div></td>
                                <td><div style='font-size: 14pt'><br>   $text</div></td>
                            </tr>
                        </table><br>";
                }

                if (empty($_SESSION['login']) or empty($_SESSION['id']))
                {
                    echo "Чтобы оставить отзыв, необходимо <a href='reg.php'>зарегистрироваться</a> или <a href='login.php'>авторизоваться</a>";
                }
                else
                echo '
                <form action="save_feedback.php" method="post">
                    <p>
                        <label>Комментарий:<br></label>
                        <input name="comment" type="text" size="250" maxlength="250">
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Отправить">
                    </p>
                </form>'
            ?>
		</div>
	</div>
</body>
</html>