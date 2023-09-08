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
	if($query = $db->query("SELECT * FROM `orderPage`")){
		$data_order = $query->fetchAll(PDO::FETCH_ASSOC);
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
				<!-- для авторизованного -->
				<?php foreach ($data_owner as $owner): ?>
					<?php
					if($_COOKIE['owner'] == $owner['login']):
					?>
					<form action="php/add_order_subtitle.php" method="POST" id="addSubtitleForm">
						<div class="textarea__subtitle" id="bio_text">
							<textarea name="order_subtitle" class="form__input _message">
							<?php foreach($data_order as $order_subtitle):?>
							<?php echo $order_subtitle['subtitle'];?>
							<?php endforeach;?>	
							</textarea>
						</div>
						<button type="submit" class="modal__btn form__button" id="subtitleButton">
							<img src="img/all/btn.png" alt="">
							<p>Сохранить</p>
						</button>
					</form>
				<?php endif; endforeach;?>
				<form action="#" id="form" class="form__body">
					<h1 class="form__title">Заказать картину</h1>
					<!-- для неавторизованного пользователя -->
					<div class="form__subtitle">
						<?php foreach($data_order as $order_subtitle):?>
						<?php echo $order_subtitle['subtitle'];?>
						<?php endforeach;?>
					</div>
					<div class="row">
						<div class="column">
							<div class="form__item">
								<label for="formName" class="form__label">ФИО<span>*</span> :</label>
								<input id="formName" name="name" type="text" class="form__input _req">
							</div>
							<div class="form__item">
								<label for="formEmail" class="form__label">E-mail<span>*</span> :</label>
								<input id="formEmail" name="email" type="text" class="form__input _req _email">
							</div>
							<div class="form__item">
								<label for="formPhone" class="form__label">Контактный телефон<span>*</span> :</label>
								<input id="formPhone" name="phone" type="text" class="form__input _req _phone">
							</div>
							<div class="form__row">
								<div class="form__item form__column">
									<div class="form__label">Жанр:</div>
									<select name="genre" class="select">
										<?php foreach ($data_genre as $genre): ?>
										<option><?php echo $genre['name']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="form__item form__column">
									<div class="form__label">Техника:</div>
									<select name="tech" class="select">
										<option value="oil" selected="selected">масло</option>
										<option value="aquarel">акварель</option>
										<option value="mastihin">мастихин</option>
										<option value="mastihin">акрил</option>
										<option value="mastihin">пастель</option>
										<option value="mastihin">графика</option>
									</select>
								</div>
								<div class="form__item form__column">
									<label for="formSize" class="form__label">Размер (см):</label>
									<input id="formSize" name="size" type="text" class="form__input _size" placeholder="100*70">
								</div>
							</div>
							<div class="form__item">
								<div class="checkbox">
									<input id="formAgreement" type="checkbox" name="agreement" class="checkbox__input _req">
									<label for="formAgreement" class="checkbox__label"><span>Я даю своё согласие на обработку персональных данных в соответствии с <a href="#">Условиями</a>.<span>*</span></span></label>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="form__item">
								<label for="formMessage" class="form__label">Требования к картине:</label>
								<textarea name="message" id="formMessage" class="form__input _message"></textarea>
							</div>
						</div>
					</div>
					<button type="submit" class="form__button">
						<img src="img/all/btn.png" alt="">
						<p>Сделать заказ</p>
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
	<script src="js/orderForm.js"></script>
</body>
</html>
<?php
	//закрытие соединения
	$db = null;
	$query = null;
?>