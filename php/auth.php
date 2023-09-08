<?php

	//переменные
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

	//хэширование пароля
	$password = md5($password);

	//установка соединения с БД
	require "connect.php";

	//SQL запрос 
	$result = $link->query("SELECT * FROM `owner` WHERE `login` = '$login' AND `password` = '$password'");


	//преобразование в массив
	$owner = $result->fetch_assoc();
	//если нет элементов в массиве то произошла ошибка авторизации
	if(!is_countable($owner)){
		echo "Логин или пароль неверен";
		exit();
	}
	
	//создание cookie с названием "owner" и значением ввеленного логина
	setcookie('owner', $owner['login'], time() + 86400, "/");
	
	//закрытие соединения и возвращение на исходную страницу
	$link->close();
	header('Location: /');
?>