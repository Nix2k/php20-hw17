<?php
	require_once './routines.php';
	
	try {
    	$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
	} catch (PDOException $e) {
    	echo 'Подключение не удалось: ' . $e->getMessage();
	}

	if (isset($_GET['id'])) {
		if (is_numeric($_GET['id'])){
			$sql = "DELETE FROM `task` WHERE `id`=".$_GET['id'];
			$data = $pdo->query($sql);
			if (!$data) {
				die ('Ошибка!');
			}
		}
		else {
			die ('Ошибка. Нверный идентификатор задачи.');
		}
	}
	header('Location: index.php');
?>
