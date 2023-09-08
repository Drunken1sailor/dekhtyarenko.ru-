<?php
	//установка соединения с БД
	require "php/connect.php";

	//Удаление сертификата по нажатию кнопки
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		$link->query("DELETE FROM certificate WHERE id = $id");
	}

	//SQL запрос (получение данных)
	$data_owner = $link->query("SELECT * FROM `owner`");
	$data_bio = $link->query("SELECT * FROM `bio`");
	$data_certificate = $link->query("SELECT * FROM `certificate`");

	//преобразование в массив
	$data_owner = $data_owner->fetch_assoc();
	$data_bio = $data_bio->fetch_assoc();
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
					<div class="nav__column active">
						<a class="nav__link" href="biography.php">Биография</a>
					</div>
					<div class="nav__column">
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
			<div class="biography__content" id="bio_content">
				<!-- страница не авторизованного пользователя -->
				<?php
					if($_COOKIE['owner'] != $data_owner['login']):
				?>
				<h1 class="biography__title">Дехтяренко Нина Васильевна</h1>
				<div class="biography__row">
					<div class="biography__pic biography__column" id="bio_image">
						<img src="<?php echo $data_bio['image']; ?>" alt="">
					</div>	
					<div class="biography__text biography__column bio_text" id="bio_text">
						<p><?php 
						$temp = str_replace(PHP_EOL, '<br>&nbsp&nbsp&nbsp&nbsp&nbsp',$data_bio['bio_text']);
						$bio_text = '&nbsp&nbsp'.$temp;
						echo $bio_text; 
						?>
						
						</p>
					</div>
				</div>
				<!-- страница авторизованного пользователя -->
				<?php else: ?>
				<form action="php/add_bio.php" method="POST" enctype="multipart/form-data" class="biography__form">
					<h1 class="biography__title">Дехтяренко Нина Васильевна</h1>
					<div class="biography__row">
						<div>
							<div class="biography__pic biography__column" id="bio_image">
								<img src="<?php echo $data_bio['image']; ?>" alt="">
							</div>
							<div>
								<div>Загрузить новое изображение </div>
								<input type="file" name="bio_image">
								<br>
								<div>Загрузить сертификат</div>
								<input type="file" name="certificate_image" >
								<br>
								<em>Загружать только файлы размером меньше 5 MB и с расширением 'jpg' или 'png'!</em>
							</div>
						</div>	
						<div class="biography__text biography__column bio_text" id="bio_text">
							<textarea name="bio_text" class="form__input _message"><?php echo $data_bio['bio_text']; ?></textarea>
						</div>
					</div>
					<button type="submit" class="modal__btn form__button">
						<img src="img/all/btn.png" alt="">
						<p>Сохранить</p>
					</button>
				</form>
				<?php endif; ?>
				<div class="row certificates">
					<?php while($certificate = $data_certificate->fetch_assoc()): ?>
					<div class="body__column column reproduction certificate">
						<?php if($_COOKIE['owner'] == $data_owner['login']): ?>
							<a href="?del=<?php echo $certificate['id'] ?>" class="btn-close delete-picture-btn">X</a>
						<?php endif;?>
						<a href="http://dunbak.beget.tech/<?php echo $certificate['image']; ?>" target="_blank">
							<div class="column__pic">
								<img width="250"src="<?php echo $certificate['image']; ?>" alt="">
							</div>
						</a>
					</div>
					<?php endwhile; ?>
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