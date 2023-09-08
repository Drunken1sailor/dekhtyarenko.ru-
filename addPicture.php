<?php
	//установка соединения с БД
	require "php/connectPDO.php";

	//SQL запрос 
	if($query = $db->query("SELECT * FROM `owner`")){
		//преобразование в массив
		$data_owner = $query->fetchAll(PDO::FETCH_ASSOC);
	}
	if($query = $db->query("SELECT * FROM `genre`")){
		$data_genre = $query->fetchAll(PDO::FETCH_ASSOC);
	}
?>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Художник Нина Дехтяренко</title>

	<link rel="stylesheet" type="text/css" href="css/style.css?v=1.1">

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
				<form action="#" enctype="multipart/form-data" id="form" class="form__body">
					<h1 class="form__title">Добавить картину</h1>

					<div class="row">
						<div class="column">
							<div class="form__item">
								<label for="formProductName" class="form__label">Название картины:</label>
								<input id="formProductName" name="productName" type="text" class="form__input _req _productName">
							</div>
							<div class="form__row">
								<div class="form__item form__column">
									<div class="form__label">Жанр:</div>
									<select name="genre" class="select">
										<?php foreach ($data_genre as $genre): ?>
											<?php if($genre['name'] == $_GET['genre']):?>
											<option selected="selected"><?php echo $genre['name']; ?></option>
											<?php else: ?>
											<option><?php echo $genre['name']; ?></option>
											<?php endif;?>
										<?php endforeach;?>
									</select>
								</div>
								<div class="form__item form__column">
									<label for="formPrice" class="form__label">Цена:</label>
									<input id="formPrice" name="price" type="text" class="form__input _size _price _req">
								</div>
								<div class="form__item form__column">
									<label for="formImage" class="form__label">Изображение:</label>
									<input id="formImage" name="loaded_image" type="file" class="_size _loadedImage _req">
								</div>
							</div>
							
							<div class="column">
								<div class="form__item">
									<label for="formMessage" class="form__label">Описание картины:</label>
									<textarea name="message" id="formMessage" class="form__input _message"></textarea>
								</div>
							</div>
							<div class="fileLoad_description">
								<em>Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!</em>
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
	<script src="js/add_product_validation.js"></script>
</body>
</html>
<?php
	//закрытие соединения
	$db = null;
	$query = null;
?>