<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);

	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);


	$mail->setFrom('aleksite@aleksite.com', 'Заказчик на dunbak.beget.tech'); 

	$mail->addAddress('dunbakND@rambler.ru');
	$body = '<h1>Новый заказ!</h1>';

	if(trim(!empty($_POST['reprodName']))){
		$mail->Subject = 'Заказ репродукции';
		$body.='<p><strong>название репродукции:</strong> '.$_POST['reprodName'].'</p>';
	} else{
		$mail->Subject = 'Заказ новой картины';
	}
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['phone']))){
		$body.='<p><strong>Номер телефона:</strong> '.$_POST['phone'].'</p>';
	}
	if(trim(!empty($_POST['genre']))){
		$body.='<p><strong>Жанр:</strong> '.$_POST['genre'].'</p>';
	}
	if(trim(!empty($_POST['tech']))){
		$body.='<p><strong>Техника:</strong> '.$_POST['tech'].'</p>';
	}
	if(trim(!empty($_POST['size']))){
		$body.='<p><strong>Размер:</strong> '.$_POST['size'].'</p>';
	}
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Требования к картине:</strong> '.$_POST['message'].'</p>';
	}
	
	$mail->Body = $body;
	
	if(!$mail->send()){
		$message = 'ошибка';
	}else{
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>