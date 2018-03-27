<?php
require_once __DIR__.'/routines.php';
require __DIR__.'/controllers/CUser.php';
require __DIR__.'/controllers/CTask.php';

$user = new User();

if ((isset($_GET['contr'])) && ($_GET['contr']!='') && (isset($_GET['act'])) && ($_GET['act']!='')){
	$contr = clearInput($_GET['contr']);
	$act = clearInput($_GET['act']);
	switch ($contr) {
		case 'user':
			switch ($act) {
				case 'reg':
					# регистрация пользователя - форма
					CUser::registration();
					break;
				case 'add':
					# добавление пользователя
					CUser::add();
					break;
				case 'login':
					# вход пользователя - форма
					CUser::login();
					break;
				case 'auth':
					# авторизация пользователя
					CUser::auth();
					break;
				case 'logout':
					# выход пользователя
					CUser::logout();
					break;
			}
			break;

		case 'task':
			if ($user->isLogedin()){ #если пользователь уже залогинен
				switch ($act) {
					case 'add':
						# добавление задачи
						CTask::add();
						break;
					case 'del':
						# удаление задачи
						CTask::delete();
						break;
					case 'workflow':
						# изменение статуса задачи
						CTask::workflow();
						break;
					case 'edit':
						# редактирование задачи - форма
						CTask::edit();
						break;
					case 'update':
						# редактирование задачи - обработка формы
						CTask::update();
						break;
					case 'assign':
						# назначение задачи - форма
						CTask::assign();
						break;
					case 'upd_assignie':
						# смена исполнителя
						CTask::updAssignie();
						break;
				}
			}
			break;	
	}
}
else { # если контроллер не передан - основная страница
	if ($user->isLogedin()) { #если пользователь уже залогинен
		$iamReporterTasks = new Dashboard('iamReporter');
		$myTasks = new Dashboard('myTasks');
		//include './templates/main.php';
		$template = $twig ->loadTemplate('main.php');
		$params = array(
			'iamReporterTasks' => $iamReporterTasks,
			'myTasks' => $myTasks
		);
		$template->display($params);
	}
	else {
		CUser::login();
	}
}
?>
