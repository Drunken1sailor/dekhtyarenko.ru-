$(document).ready(function(){
	const subtitleForm = document.getElementById('addSubtitlesubtitleForm');
	subtitleForm.addEventListener('submit', subtitleFormSend);

	async function subtitleFormSend(e){
		e.preventDefault();
		let error = subtitleFormValidate(subtitleForm),
			subtitleFormData = new subtitleFormData(subtitleForm);

		if(error === 0){
			subtitleForm.classList.add('_sending');
			let response = await fetch('php/add_order_subtitle.php', {
				method:'POST',
				body: subtitleFormData
			});
			if(response.ok){
				let result = await response.json();
				alert(result.message);
				subtitleForm.reset();
				subtitleForm.classList.remove('_sending');
			}else{
				alert("Ошибка");
				subtitleForm.classList.remove('_sending');
			}
		}
	}
});


	
