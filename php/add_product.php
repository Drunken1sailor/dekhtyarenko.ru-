<?php
	//переменные
	$productName = strtolower(filter_var(trim($_POST['productName']), FILTER_SANITIZE_STRING));
	$genre = filter_var(trim($_POST['genre']), FILTER_SANITIZE_STRING);
	$price = filter_var(trim($_POST['price']), FILTER_SANITIZE_STRING);
	$imagePath = "img/arts/" . $_FILES['loaded_image']['name'];
	$productDescription = strtolower(filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING));

	$price = (int)$price;

	//установка соединения с БД
	require "connect.php";

	//SQL запрос (получение данных)


	//SQL запрос 
	$link->query("INSERT INTO `product` (`name`, `genre`, `price`, `image`, `description`) VALUES('$productName', '$genre', '$price', '$imagePath', '$productDescription')");

	//закрытие соединения и возвращение на исходную страницу
	$link->close();

	if($_FILES['loaded_image']['name'] != null){
		if(strpos($_FILES['loaded_image']['name'], "png") || strpos($_FILES['loaded_image']['name'], "jpg")){
			if($_FILES['loaded_image']['size'] < 5*1024*1024){	
				move_uploaded_file($_FILES['loaded_image']['tmp_name'], '../img/arts/' . $_FILES['loaded_image']['name']);
			}else{
				echo "Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!";
			}
		}else{
			echo "Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!";
		}
	}
	
	$message = 'Картина добавлена!';
	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);

	header('Location: /');
?>