<!--кнопка навигации "Владелец" если владелец не авторизован-->
<?php
	if($_COOKIE['owner'] != $data_owner['login']):
?>
	<div class="nav__column owner_auth">
		<a class="nav__link" href="#">Владелец</a>
	</div>
<!--кнопка навигации "ЛОГИН ВЛАДЕЛЬЦА" если владелец авторизован-->
<?php else: ?>
	<div class="nav__column owner_exit">
		<a class="nav__link" href="#"><?php echo $data_owner['login'] ?></a>
	</div>
<?php endif; ?>