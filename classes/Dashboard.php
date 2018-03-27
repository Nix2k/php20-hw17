<?php
require_once './routines.php';

class Dashboard
{
	private $sqlQuery;
	private $tasks;

	public function __construct($type)
	{
		$user = new User();
		if ($user->isLogedin()) { #если пользователь уже залогинен
			switch ($type) {
				case 'iamReporter':
					$sql = "SELECT task.*, reporter.login AS rlogin, assignie.login AS alogin FROM task INNER JOIN user AS reporter ON task.user_id=reporter.id INNER JOIN user AS assignie ON task.assigned_user_id=assignie.id WHERE task.user_id=".$user->getId( );
					break;
				case 'myTasks':
					$sql = 'SELECT task.*, reporter.login AS rlogin, assignie.login AS alogin FROM task INNER JOIN user AS reporter ON task.user_id=reporter.id INNER JOIN user AS assignie ON task.assigned_user_id=assignie.id WHERE task.assigned_user_id='.$user->getId( ).' AND reporter.id!='.$user->getId( );
					break;
			}
			$this->sqlQuery = $sql;
			require './db.php';
			$data = $pdo->query($sql);
			if ($data) {
				$this->tasks = array();
				foreach ($data as $row) {
					$this->tasks[] = new Task($row['id'], $row['description'], $row['rlogin'], $row['alogin'], $row['is_done'], $row['date_added']);
				}
			}
			return false;
		}
	}

	public function printDashboard()
	{
		echo '<table>
				<tr>
					<th>id</th>
					<th>Описание</th>
					<th>Статус</th>
					<th>Дата добавления</th>
					<th>Автор</th>
					<th>Исполнитель</th>
					<th colspan="4">Действия</th>
				</tr>';
		foreach ($this->tasks as $task) {
			$task->printTaskForDashboard();
		}
		echo '</table>';
	}
}
?>
