<?php
	//установка соединения с БД
	require "php/connectPDO.php";

	//Удаление картины по нажатию кнопки
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		$db->query("DELETE FROM product WHERE id = $id");
	}

	//Удаление жанра по нажатию кнопки
	if (isset($_GET['delGenre'])) {
		$id = $_GET['delGenre'];
		$db->query("DELETE FROM genre WHERE id = $id");
	}

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
					<div class="nav__column active">
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
		
		<section class="body gallery">
			<div class="gallery__bg bg">
				<img src="img/all/bg.png" alt="">
			</div>
			<section class="body__content">
				<!-- вывод кнопки добавления жанра для авторизованного пользователя -->
				<?php if($_COOKIE['owner'] == $owner['login']): ?>
							<div class="body__column column order addGenre">
								<a href="addGenre.php">
									<div class="column__pic order__pic">
										<img src="img/gallery/add_order.png" alt="">
									</div>
									<div class="column__description">
										Добавить жанр
									</div>
								</a>
							</div>
				<?php endif;?>
				<!-- вывод секций жанров из БД -->
				<?php foreach ($data_genre as $genre): ?>
				<?php
					$name = $genre['name'];
					if($query = $db->query("SELECT * FROM `product` WHERE `genre` = '$name'")){
						$data_product = $query->fetchAll(PDO::FETCH_ASSOC);
					}
				?>
				<!-- вывод секций -->
				<section class="body__section section" id="<?php echo $genre['name']?>">
					<?php foreach ($data_owner as $owner): ?>
						<?php if($_COOKIE['owner'] == $owner['login']): ?>
							<a href="?delGenre=<?php echo $genre['id'] ?>" class="btn-close delete-picture-btn">X</a>
						<?php endif;?>
					<?php endforeach; ?>
					<h2 class="section__title"><?php echo $genre['name'];?></h2>
					<div class="row">
						<?php foreach ($data_owner as $owner): ?>
							<!-- если не авторизован то ссылка на оформление заказа -->
							<?php //if($_COOKIE['owner'] != $owner['login']): ?>
							<div class="body__column column order">
								<a href="order.php">
									<div class="column__pic order__pic"id="img_example">
										<img src="img/gallery/add_order.png" alt="">
									</div>
									<div class="column__description">
										Сделать заказ
									</div>
								</a>
							</div>
							<!-- если авторизован то ссылка на добавление картины -->
							<?php if($_COOKIE['owner'] == $owner['login']):?>
							<div class="body__column column order">
								<a href="addPicture.php?genre=<?php echo $genre['name']; ?>">
									<div class="column__pic order__pic"id="img_example">
										<img src="img/gallery/add_order.png" alt="">
									</div>
									<div class="column__description">
										Добавить картину
									</div>
								</a>
							</div>
							<?php endif;?>
						<?php endforeach; ?>
						<!-- вывод имеющихся в данном жанре картин -->
						<?php foreach ($data_product as $picture): ?>
						<div class="body__column column reproduction">
							<?php foreach ($data_owner as $owner): ?>
								<?php if($_COOKIE['owner'] == $owner['login']): ?>
									<a href="?del=<?php echo $picture['id'] ?>" class="btn-close delete-picture-btn">X</a>
								<?php endif;?>
							<?php endforeach; ?>
							<a href="reproduction.php?picId=<?php echo $picture['id'];?>">
								<div class="column__pic">
									<img src="<?php echo $picture['image']; ?>" alt="">
								</div>
								<div class="column__description">
									<?php echo $picture['name']; ?>
								</div>
							</a>
						</div>
						<?php endforeach; ?>
					</div>
				</section>
				<?php endforeach; ?>
			</section>
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
	<script src="js/imgAdaptive.js"></script>
</body>
</html>
<?php
	//закрытие соединения
	$db = null;
	$query = null;
?>