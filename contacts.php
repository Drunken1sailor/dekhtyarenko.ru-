<?php
	//установка соединения с БД
	require "php/connect.php";
	
	//SQL запрос (получение данных)
	$data_owner = $link->query("SELECT * FROM `owner`");

	//преобразование в массив
	$data_owner = $data_owner->fetch_assoc();
?>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Художник Нина Дехтяренко</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<meta name="viewport" content="width=device-width">
	<!-- 
	<meta name="description" content="Заказать картины художника">
	<meta name="keywords" content="plart, заказать картину, картины маслом, купить картину, Лена Прокопьева"> -->

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
	<main>
		<header class="header">
			<div class="header__bg bg">
				<img src="img/index/header/bg.png">
			</div>	
			<nav class="header__burger">
					<span>	</span>
			</nav>
			<div class="header__inner">
				<nav class="nav">
					<div class="nav__column">
						<a class="nav__link" href="index.php">Главная</a>
					</div>
					<div class="nav__column">
						<a class="nav__link" href="gallery.php">Галерея</a>
					</div>
					<div class="nav__column">
						<a class="nav__link" href="biography.php">Биография</a>
					</div>
					<div class="nav__column active">
						<a class="nav__link" href="contacts.php">Контакты</a>
					</div>
					<?php require "php/nav_owner.php"; ?>
				</nav>
			</div>
		</header>
		
		<section class="gallery">
			<div class="gallery__bg bg">
				<img src="img/all/bg.png" alt="">
			</div>

			<div class="contact__content">
				<div class="contact__tel">Телефон: <span>+7 921 764 4382 (+whatsapp, viber, telegram)</span></div>
				<div class="contact__mail">E-Mail: <span>dunbaknd@rambler.ru</span></div>
				
				<div class="contact__row">
					<div class="contact__column">
						<div class="contact__img contact__vk">
							<a target="_blank" href="https://vk.com/ninadekhtyarenko">
								<img src="img/contacts/vk.png" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="copyrightTxt">
				<p>
					
				</p>
			</div>
		</footer>
	</main>

	<?php 
		require "php/modals.php";
	?>

	<script src="js/modal.js"></script>
	<script src="js/burger.js"></script>
</body>
</html>

<?php
	//закрытие соединения
	$link->close();
?>