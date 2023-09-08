<?php
	//установка соединения с БД
	require "php/connectPDO.php";

	//SQL запрос 
	if($query = $db->query("SELECT * FROM `owner`")){
		//преобразование в массив
		$data_owner = $query->fetchAll(PDO::FETCH_ASSOC);
	}
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
					<div class="nav__column">
						<a class="nav__link" href="contacts.php">Контакты</a>
					</div>
					<!--кнопка навигации "Владелец" если владелец не авторизован-->
					<?php foreach ($data_owner as $owner): ?>
						<?php
							if($_COOKIE['owner'] != $owner['login']):
						?>
							<div class="nav__column owner_auth">
								<a class="nav__link" href="#">Владелец</a>
							</div>
					<!--кнопка навигации "ЛОГИН ВЛАДЕЛЬЦА" если владелец авторизован-->
						<?php else: ?>
							<div class="nav__column owner_exit">
								<a class="nav__link" href="#"><?php echo $owner['login']; ?></a>
							</div>
					<?php endif;endforeach; ?>
				</nav>
			</div>
		</header>
		<section class="gallery">
			<div class="gallery__bg bg">
				<img src="img/all/bg.png" alt="">
			</div>
			<div class="form">
				<form action="php/add_genre.php" method="POST" enctype="multipart/form-data" id="form" class="form__body">
					<h1 class="form__title">Добавить жанр</h1>

					<div class="row">
						<div class="column">
							<div class="form__item">
								<label for="formGenreName" class="form__label">Название Жанра:</label>
								<input id="formGenreName" name="genreName" type="text" class="form__input _req _genreName">
							</div>
						</div>
					</div>
					<button type="submit" class="form__button">
						<img src="img/all/btn.png" alt="">
						<p>Отправить</p>
					</button>
				</form>
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
	<script src="js/add_genre_validation.js"></script>
</body>
</html>
<?php
	//закрытие соединения
	$db = null;
	$query = null;
?>