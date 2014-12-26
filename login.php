<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Личный кабинет</title>
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
        if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
            echo '
                <h2>Вход в Личный кабинет</h2>
                <form action="testreg.php" method="post">

                    <p>
                        <label>Ваш логин:<br></label>
                        <input name="login" type="text" size="15" maxlength="15">
                    </p>
                    <p>

                        <label>Ваш пароль:<br></label>
                        <input name="password" type="password" size="15" maxlength="15">
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Войти">
                        <br>
                        <a href="reg.php">Зарегистрироваться</a>
                    </p>
                </form>
                  <br>';
        }
        else
        {
            include("bd.php");
            $login = $_SESSION['login'];
            $sql = "SELECT * FROM Users WHERE login like '$login'";
            $rs = mysql_query($sql);
            $row = mysql_fetch_assoc($rs);
            $id = $row['id'];
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $phone = $row['telephone'];
            echo "<h2>Персональные данные</h2>";
            echo "<table>
                        <tr>
                            <td><div style='font-size:10pt; color:purple;'>Логин: </div></td>
                            <td><div style='font-size: 14pt'><br>$login</div></td>
                        </tr>
                        <tr>
                            <td><div style='font-size:10pt; color:purple;'>Имя: </div></td>
                            <td><div style='font-size: 14pt'><br>$fname</div></td>
                        </tr>
                        <tr>
                            <td><div style='font-size:10pt; color:purple;'>Фамилия: </div></td>
                            <td><div style='font-size: 14pt'><br>$lname</div></td>
                        </tr>
                        <tr>
                            <td><div style='font-size:10pt; color:purple;'>Телефон: </div></td>
                            <td><div style='font-size: 14pt'><br>$phone</div></td>
                        </tr>
                    </table><br>";
            echo "<h2>История посещений</h2>";
            $sql = "SELECT * FROM Journal j
                    JOIN UserCar uc ON j.user_car_id=uc.id
                    JOIN Users u ON uc.user_id=u.id
                    JOIN ServiceDatetime sd ON j.service_datetime_id=sd.id
                    JOIN Service s ON sd.service_id=s.id
                    JOIN Datetime d ON sd.datetime_id=d.id
                    WHERE u.id=$id";
            $rs = mysql_query($sql);

            while ($row = mysql_fetch_assoc($rs)) {
                $jid = $row['id'];
                $date = $row['datecol'];
                $time = $row['timecol'];
                $service = $row['name'];
                $price = $row['price'];
                $status = $row['status'];
                echo "<table>
                            <tr style='border: 1px solid purple'>
                                <td style='border: 1px solid purple'><div style='margin-top: 10px; margin-left:10px; margin-bottom:10px; margin-right:10px'>$jid</div></td>
                                <td style='border: 1px solid purple'><div style='margin-top: 10px; margin-left:10px; margin-bottom:10px; margin-right:10px'>$date</div></td>
                                 <td style='border: 1px solid purple'><div style='margin-top: 10px; margin-left:10px; margin-bottom:10px; margin-right:10px'>$time</div></td>
                                <td style='border: 1px solid purple'><div style='margin-top: 10px; margin-left:10px; margin-bottom:10px; margin-right:10px'>$service</div></td>
                                 <td style='border: 1px solid purple'><div style='margin-top: 10px; margin-left:10px; margin-bottom:10px; margin-right:10px'>$price</div></td>
                                <td style='border: 1px solid purple'><div style='margin-top: 10px; margin-left:10px; margin-bottom:10px; margin-right:10px'>$status</div></td>
                            </tr>
                        </table><br>";
            }
            echo ' <br><a href="logout.php">Выйти</a>';
        }
        ?>
    </div>
    <div id="fancyCountdown"></div>
</div>
</body>
</html>