<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Редактирование задачи</title>
</head>
<body>

<h1>Редактирование задачи</h1>
<table>
	<tr>
		<th>id</th>
		<th>Описание</th>
		<th>Статус</th>
		<th>Дата добавления</th>
		<th>Автор</th>
		<th>Исполнитель</th>
		<th>Действия</th>
	</tr>
	<!--?php $task->printTaskForEdit() ?-->
	{{ task.printTaskForEdit() }}
</table>
<a href="index.php">Главная</a>

</body>
</html>
