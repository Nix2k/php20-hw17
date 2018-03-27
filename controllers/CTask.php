<?php
class CTask 
{
	public function add()
	{
		if (isset($_GET['desc'])) {
			$description = clearInput($_GET['desc']);
			$task = new Task();
			$task->addTask($description);
			header('Location: index.php');
		}
	}

	public function delete()
	{
		if (isset($_GET['id'])) {
			$id = clearInput($_GET['id']);
			$task = new Task();
			$task->deleteTask($id);
			header('Location: index.php');
		}
	}

	public function workflow()
	{
		if ((isset($_GET['id'])) && (isset($_GET['transition_id']))) {
			$id = clearInput($_GET['id']);
			$transition_id = clearInput($_GET['transition_id']);
			$task = new Task();
			$task->transitionTask($id, $transition_id);
			header('Location: index.php');
		}
	}

	public function edit()
	{
		if (isset($_GET['id'])) {
			$id = clearInput($_GET['id']);
			$task = new Task();
			$task->getById($id);
			include './templates/edit_task.php';
		}
	}

	public function update()
	{
		if ((isset($_GET['id'])) && (isset($_GET['desc']))) {
			$id = clearInput($_GET['id']);
			$description = clearInput($_GET['desc']);
			$task = new Task();
			$task->updateTask($id, $description);
			header('Location: index.php');
		}
	}

	public function assign()
	{
		if (isset($_GET['id'])) {
			$id = clearInput($_GET['id']);
			$task = new Task();
			$task->getById($id);
			include './templates/assign_task.php';
		}
	}

	public function updAssignie()
	{
		if ((isset($_GET['id'])) && (isset($_GET['assignie']))) {
			$id = clearInput($_GET['id']);
			$assignie = clearInput($_GET['assignie']);
			$task = new Task();
			$task->assignTask($id, $assignie);
			header('Location: index.php');
		}
	}
}
?>
