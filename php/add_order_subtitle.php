<?php
	//переменные
	$order_subtitle = strtolower(filter_var(trim($_POST['order_subtitle']), FILTER_SANITIZE_STRING));


	//установка соединения с БД
	require "connect.php";

	//SQL запрос 
	$link->query("UPDATE `orderPage` SET `subtitle` = '$order_subtitle' WHERE `id` = '1' ");

	//закрытие соединения и возвращение на исходную страницу
	$link->close();
	

	header('Location: /');
?>