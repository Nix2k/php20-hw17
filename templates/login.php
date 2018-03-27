<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Вход на сайт</title>
</head>
<body style="text-align: center;">
	<h1>Вход на сайт</h1>
	<form action="index.php" method="GET">
		<input type="hidden" name="contr" value="user">
		<input type="hidden" name="act" value="auth">
		<input type="text" name="login" placeholder="Имя пользователя"><br>
		<input type="password" name="pass" placeholder="Пароль"><br>
		<input type="submit" name="submit" value="Вход"><br>
	</form>
	<a href="index.php?contr=user&act=reg">Регистрация нового пользователя</a>
</body>
</html>