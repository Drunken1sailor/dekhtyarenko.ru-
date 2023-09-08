<?php
	setcookie('owner', $owner['login'], time() - 86400, "/");
	header('Location: /');
?>