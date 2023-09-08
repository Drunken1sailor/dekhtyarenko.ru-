	<div class="modal modal_auth">
		<div class="modal__body">
			<form action="php/auth.php" method="POST" class="modal__form form__body form">
				<h2 class="modal__title">Авторизация владельца</h2>
				<div class="modal__column">
					<label for="formLogin" class="form__label">Логин<span>*</span> :</label>
					<input id="formLogin" name="login" type="text" class="form__input" placeholder="Ввелите логин">
				</div>
				<div class="modal__column">
					<label for="formPassword" class="form__label">Пароль<span>*</span> :</label>
					<input id="formPassword" name="password" type="password" class="form__input" placeholder="Введите пароль">
				</div>
				<button type="submit" class="modal__btn form__button">
					<img src="img/all/btn.png" alt="">
					<p>Войти</p>
				</button>
				<div class="btn-close modal-close-btn">X</div>
			</form>
		</div>
		<div class="modal__overlay"></div>
	</div>
	<div class="modal modal_exit">
		<div class="modal__body">
			<form action="#" class="modal__form form__body form">
				<h2 class="modal__title">Выйти из режима редактирования?</h2>
				<div class="row">
					<a href="php/exit.php">выйти</a>
					<a href="#" class="btn-close modal-close-btn">отмена</a>
				</div>
				<div class="btn-close modal-close-btn">X</div>
			</form>
		</div>
		<div class="modal__overlay"></div>
	</div>