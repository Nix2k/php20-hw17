<?php
require_once './routines.php';

class Task 
{
	private $id;
	private $description;
	private $userId;
	private $assignieId;
	private $status;
	private $createdDate;

	public function __construct ($id = null, $description = null, $reporter = null, $assignie = null, $status = null, $date = null)
	{
		$this->id = $id;
		$this->description = $description;
		$this->reporter = $reporter;
		$this->assignie = $assignie;
		$this->status = $status;
		$this->createdDate = $date;
	}

	public function getById ($id)
	{
		$user = new User();
		if ($user->isLogedin()) { #если пользователь уже залогинен
			$sql = "SELECT task.*, reporter.login AS rlogin, assignie.login AS alogin FROM task INNER JOIN user AS reporter ON task.user_id=reporter.id INNER JOIN user AS assignie ON task.assigned_user_id=assignie.id WHERE task.id=".$id;
			require './db.php';
			$data = $pdo->query($sql);
			if ($data) {
				foreach ($data as $row) {
					$this->id = $row['id'];
					$this->description = $row['description'];
					$this->reporter = $row['rlogin'];
					$this->assignie = $row['alogin'];
					$this->status = $row['is_done'];
					$this->createdDate = $row['date_added'];
				}
			}
		}
	}

	public function printTaskForDashboard()
	{
		if ($this->status==0) {
			$status = '<span style="color: red;">Не выполнено</span>';
			$workflow = "<a href='index.php?contr=task&act=workflow&transition_id=1&id=$this->id'>Выполнено</a>";
		}
		else {
			$status = '<span style="color: green;">Выполнено</span>';
			$workflow = "<a href='index.php?contr=task&act=workflow&transition_id=0&id=$this->id'>Открыть заново</a>";
		}
		echo "<tr>
				<td>$this->id</td>
				<td>$this->description</td>
				<td>$status</td>
				<td>$this->createdDate</td>
				<td>$this->reporter</td>
				<td>$this->assignie</td>
				<td>$workflow</td>
				<td><a href='index.php?contr=task&act=edit&id=$this->id'>Редактировать</a></td>
				<td><a href='index.php?contr=task&act=assign&id=$this->id'>Назначить</a></td>
				<td><a href='index.php?contr=task&act=del&id=$this->id'>Удалить</a></td>
			</tr>";
	}

	public function printTaskForEdit()
	{
		if ($this->status==0) {
			$status = '<span style="color: red;">Не выполнено</span>';
		}
		else {
			$status = '<span style="color: green;">Выполнено</span>';
		}
		echo "<tr>
				<form action='index.php'>
					<input type='hidden' name='id' value='$this->id'>
					<input type='hidden' name='contr' value='task'>
					<input type='hidden' name='act' value='update'>
					<td>$this->id</td>
					<td><input type='text' name='desc' value='$this->description'></td>
					<td>$status</td>
					<td>$this->createdDate</td>
					<td>$this->reporter</td>
					<td>$this->assignie</td>
					<td><input type='submit' name='submit' value='Готово'></td>
				</form>
			</tr>";
	}

	public function printTaskForAssign()
	{
		$user = new User();
		if ($user->isLogedin()) {
			if ($this->status==0) {
				$status = '<span style="color: red;">Не выполнено</span>';
			}
			else {
				$status = '<span style="color: green;">Выполнено</span>';
			}
			require './db.php';
			$sql1 = "SELECT * FROM user WHERE id!=".$user->getId( );
			$data1= $pdo->query($sql1);

			echo "<tr>
					<form action='index.php'>
						<input type='hidden' name='id' value='$this->id'>
						<input type='hidden' name='contr' value='task'>
						<input type='hidden' name='act' value='upd_assignie'>
						<td>$this->id</td>
						<td>$this->description</td>
						<td>$status</td>
						<td>$this->createdDate</td>
						<td>$this->reporter</td>
						<td>
							<select name='assignie'>";
							foreach ($data1 as $row1) {
								if ($row1['login']==$this->assignie) {
									$sel = 'selected';
								}
								else {
									$sel ='';
								}
								echo "<option ".$sel.">".$row1['login']."</option>";
							}
							echo "</select>
						</td>
						<td><input type='submit' name='submit' value='Готово'></td>
					</form>
				</tr>";
		}
	}

	public function addTask($description = null)
	{
		$user = new User();
		if ($user->isLogedin()) {
			require './db.php';
			$uId = $user->getId();
			$sql = "INSERT INTO `task` (`description`, `user_id`, `assigned_user_id`) VALUES ('".$description."', $uId, $uId)";
			$data = $pdo->query($sql);
			if (!$data) {
				die ('Ошибка!');
			}
		}
	}

	public function deleteTask($id)
	{
		$user = new User();
		if ($user->isLogedin()) {
			require './db.php';
			$sql = "DELETE FROM `task` WHERE `id`=".$id;
			$data = $pdo->query($sql);
			if (!$data) {
				die ('Ошибка!');
			}
		}
	}

	public function transitionTask($id, $transition_id)
	{
		$user = new User();
		if ($user->isLogedin()) {
			require './db.php';
			$sql = "UPDATE `task` SET `is_done`=".$transition_id." WHERE `id`=".$id;
			$data = $pdo->query($sql);
			if (!$data) {
				die ('Ошибка!');
			}
		}
	}

	public function updateTask($id, $description)
	{
		$user = new User();
		if ($user->isLogedin()) {
			require './db.php';
			$sql = "UPDATE `task` SET `description`='".$description."' WHERE `id`=".$id;
			$data = $pdo->query($sql);
			if (!$data) {
				die ('Ошибка!');
			}
		}
	}

	public function assignTask($id, $assignie)
	{
		$user = new User();
		if ($user->isLogedin()) {
			require './db.php';
			$sql = "SELECT * FROM `user` WHERE `login`='".$assignie."'";
			$data = $pdo->query($sql);
			foreach ($data as $row) {
				$sql = "UPDATE `task` SET `assigned_user_id`=".$row['id']." WHERE `id`=".$id;
				$data1 = $pdo->query($sql);
				header('Location: index.php');
			}
			if (!$data) {
				die ('Ошибка!');
			}
		}
	}
}
?>
