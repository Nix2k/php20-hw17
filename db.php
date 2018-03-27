<?php
	$dbName = 'php20hw17';
	$dbHost = 'localhost';
	$dbUser = 'php20';
	$dbPass = 'php20pass';
	try {
		$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
	} catch (PDOException $e) {
		echo 'Подключение не удалось: ' . $e->getMessage();
	}
?>
