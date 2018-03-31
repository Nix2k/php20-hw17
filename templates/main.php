<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Задачи</title>
</head>
<body>

	<form action="index.php" method="GET">
		<input type="hidden" name="contr" value="task">
		<input type="hidden" name="act" value="add">
		<input type="text" name="desc" placeholder="Описание" style="display: inline-block; min-width: 360px;">
		<input type="submit" name="submit" value="Добавить задачу">
	</form>
	<h2>Созданные мной задачи</h2>
	<!--?php $iamReporterTasks->printDashboard(); ?-->
	{{ iamReporterTasks.printDashboard() }}
	<h2>Назначенные мне</h2>
	<!--?php $myTasks->printDashboard(); ?-->
	{{ myTasks.printDashboard() }}
	<a href="index.php?contr=user&act=logout">Выйти</a>

</body>
</html>
