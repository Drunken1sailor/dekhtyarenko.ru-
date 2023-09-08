<?php
	//переменные
	$genreName = strtolower(filter_var(trim($_POST['genreName']), FILTER_SANITIZE_STRING));


	//установка соединения с БД
	require "connect.php";

	//SQL запрос 
	$link->query("INSERT INTO `genre` (`name`) VALUES('$genreName')");

	//закрытие соединения и возвращение на исходную страницу
	$link->close();
	
	// header('Location: /');
	$message = 'Жанр добавлен!';
	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);

	header('Location: /');
?>