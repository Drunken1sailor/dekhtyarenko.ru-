<?php
	//переменные
	$bio_text = filter_var(trim($_POST['bio_text']), FILTER_SANITIZE_STRING);
	$certificate_image_path = "img/certificates/" . $_FILES['certificate_image']['name'];

	//установка соединения с БД
	require "connect.php";

	//SQL запрос 
	$link->query("UPDATE `bio` SET `bio_text` = '$bio_text' WHERE `id` = '1' ");
	$data_certificate = $link->query("SELECT `image` FROM `certificate`");

	//валидация имени загружаемого файла
	$error = 0;
	while ($image = $data_certificate->fetch_assoc()) {
		if($certificate_image_path == $image['image']){
			$error++;
		}
	}

	if($_FILES['certificate_image']['name'] != null and $error == 0){
		$link->query("INSERT INTO `certificate` (`image`) VALUES('$certificate_image_path')");
	}
	//закрытие соединения
	$link->close();

	if($_FILES['bio_image']['name'] != null){
		if(strpos($_FILES['bio_image']['name'], "png") || strpos($_FILES['bio_image']['name'], "jpg")){
			if($_FILES['bio_image']['size'] < 5*1024*1024){	
				move_uploaded_file($_FILES['bio_image']['tmp_name'], '../img/biography/avatar.png');
			}else{
				echo "Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!";
			}
		}else{
			echo "Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!";
		}
	}

	if($_FILES['certificate_image']['name'] != null and $error == 0){
		if(strpos($_FILES['certificate_image']['name'], "png") || strpos($_FILES['certificate_image']['name'], "jpg")){
			if($_FILES['certificate_image']['size'] < 5*1024*1024){	
				move_uploaded_file($_FILES['certificate_image']['tmp_name'], '../img/certificates/' . $_FILES['certificate_image']['name']);
			}else{
				echo "Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!";
			}
		}else{
			echo "Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!";
		}
	}else if($error != 0){
		echo 'Файл с таким именем уже существует!';
	}
	
	
	header('Location: /');
?>