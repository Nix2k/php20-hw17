<?php
require_once './vendor/autoload.php';

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
		if ((isset($_GET['id'])) && (isset($_GET['new_status']))) {
			$id = clearInput($_GET['id']);
			$newStatus = clearInput($_GET['new_status']);
			$task = new Task();
			$task->transitionTask($id, $newStatus);
			header('Location: index.php');
		}
	}

	public function edit()
	{
		if (isset($_GET['id'])) {
			$id = clearInput($_GET['id']);
			$task = new Task();
			$task->getById($id);
			//include './templates/edit_task.php';
			$loader = new Twig_Loader_Filesystem('./templates');
			$twig = new Twig_Environment($loader);
			$template = $twig ->loadTemplate('edit_task.php');
			$params = array('task' => $task);
			$template->display($params);
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
			//include './templates/assign_task.php';
			$loader = new Twig_Loader_Filesystem('./templates');
			$twig = new Twig_Environment($loader);
			$template = $twig ->loadTemplate('assign_task.php');
			$params = array('task' => $task);
			$template->display($params);
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
