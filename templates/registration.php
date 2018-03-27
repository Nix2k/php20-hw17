<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Регистрация нового пользователя</title>
</head>
<body style="text-align: center;">
	<h1>Регистрация нового пользователя</h1>
	<form action="index.php" method="GET">
		<input type="hidden" name="contr" value="user">
		<input type="hidden" name="act" value="add">
		<input type="text" name="login" placeholder="Имя пользователя"><br>
		<input type="password" name="pass" placeholder="Пароль"><br>
		<input type="submit" name="submit" value="Зарегистрироваться"><br>
	</form>
	<a href="index.php?contr=user&act=login">Вход для зарегистрированных пользователей</a>
</body>
</html>