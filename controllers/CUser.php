<?php
require_once './vendor/autoload.php';

class CUser
{
	public function registration()
	{
		//include './templates/registration.php';
		$loader = new Twig_Loader_Filesystem('./templates');
		$twig = new Twig_Environment($loader);
		$template = $twig->loadTemplate('registration.php');
		$params = array();
		$template->display($params);
	}
	
	public function add()
	{
		if ((isset($_GET['login'])) && (isset($_GET['pass']))) {
			$login = clearInput($_GET['login']);
			$password = clearInput($_GET['pass']);
			$user = new User();
			if (!$user->getUserByLogin($login)) {
				if (checkPass($password)) {
					if ($user->addUser($login,$password)) {
						header('Location: index.php');
					}
					else {
						die ('Ошибка регистрации пользователя');
					}
				}
				else {
					die('Пароль не достаточно сложный<br>Пароль должен состоять минимум из 8 символов, содержать большие и маленькие буквы латинского алфавита и цифры');
				}
			}
			else {
				die('Пользователь с таким именем уже зарегистрирован');
			}
		}	
	}
	
	public function login()
	{
		//include './templates/login.php';
		$loader = new Twig_Loader_Filesystem('./templates');
		$twig = new Twig_Environment($loader);
		$template = $twig->loadTemplate('login.php');
		$params = array();
		$template->display($params);
	}
	
	public function auth()
	{
		if ((isset($_GET['login'])) && (isset($_GET['pass']))) {
			$login = clearInput($_GET['login']);
			$password = clearInput($_GET['pass']);
			$user = new User();
			if ($user->loginUser($login,$password)) {
				header('Location: index.php');
			}
			else {
				die('Неверное имя пользователя или пароль');
			}
		}
	}

	public function logout()
	{
		session_start();
		session_destroy();
		header('Location: index.php');
	}
}	
?>
