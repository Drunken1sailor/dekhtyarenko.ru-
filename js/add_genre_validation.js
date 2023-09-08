$(document).ready(function(){
	const form = document.getElementById('form');
	form.addEventListener('submit', formSend);
	$('._price').on('input', function() {
	    $(this).val($(this).val().replace(/[A-Za-zА-Яа-яЁё]/, ''));
	    $(this).val($(this).val().replace(/[.,'"]/, ''));
	});

	async function formSend(e){
		e.preventDefault();
		let error = formValidate(form),
			formData = new FormData(form);

		if(error === 0){
			form.classList.add('_sending');
			let response = await fetch('php/add_genre.php', {
				method:'POST',
				body: formData
			});
			if(response.ok){
				let result = await response.json();
				alert(result.message);
				form.reset();
				form.classList.remove('_sending');
			}else{
				alert("Ошибка");
				form.classList.remove('_sending');
			}
		}else{
			alert('Заполните обязательные поля!')
		}
		

	}
	function formValidate(form){
		let error =  0;
		let formInputs = document.querySelectorAll('._req');

		formInputs.forEach(function(input){
			input.classList.remove('_error');

			if(input.value === ''){
				input.classList.add('_error');
				error++;
			}
		});
		return error;
	}

});


	
