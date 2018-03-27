<?php
	require_once __DIR__.'/autoload.php';
	require_once __DIR__.'/db.php';

	require_once __DIR__ . '/vendor/autoload.php';
	$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
	$twig = new Twig_Environment($loader);

	session_start();

	function clearInput($input) 
	{
		return htmlspecialchars(strip_tags($input));
	}

	function checkPass($password) 
	{
		if ((strlen($password)>=8) && ((preg_match('/[a-z]/',$password))*(preg_match('/[A-Z]/',$password))*(preg_match('/[0-9]/',$password))==1)){
			return true;
		}
		return false;
	}

	function sort2order ($sort)
	{
		switch ($sort) {
			case 'desc':
				return ' ORDER BY description';
			case 'status':
				return ' ORDER BY is_done';
			case 'date':
				return ' ORDER BY date_added';
		}
		return '';
	}
?>