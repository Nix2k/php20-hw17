<?php
class CUser
{
	public function registration()
	{
		include './templates/registration.php';
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
		include './templates/login.php';
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