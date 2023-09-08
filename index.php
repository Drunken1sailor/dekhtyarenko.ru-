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
<html lang="ru">
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
					<div class="nav__column active">
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
			<div class="decor-up decor">
				<img src="img/all/decor_up.png" alt="">
			</div>
			<div class="gallery__content">
				<div class="row">
					<?php foreach($data_genre as $genre):?>
					<?php
						$name = $genre['name'];
						if($query = $db->query("SELECT * FROM `product` WHERE `genre` = '$name'")){
							$data_product = $query->fetchAll(PDO::FETCH_ASSOC);
						}
					?>
					<div class="gallery__column column">
						<a href="gallery.php#<?php echo $genre['name'];?>">
							<div class="column__pic" id="img_example">
								<?php foreach ($data_product as $picture): ?>
									<img src="<?php echo $picture['image']; ?>" alt="image from DB">
								<?php endforeach; ?>
							</div>
							<div class="column__description">
								<?php echo $genre['name'];?>
							</div>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="decor-bottom decor">
				<img src="img/all/decor_bottom.png" alt="">
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

	<script src="js/imgAdaptive.js"></script>
	<script src="js/burger.js"></script>
	<script src="js/modal.js"></script>
</body>
</html>
<?php
	//закрытие соединения
	$db = null;
	$query = null;
?>