$(document).ready(function(){
	$('.owner_auth').click(function(event){
		$('.modal_auth').toggleClass('active');
		$('body').toggleClass('lock');
	});
	$('.owner_exit').click(function(event){
		$('.modal_exit').toggleClass('active');
		$('body').toggleClass('lock');
	});
	$('.modal-close-btn').click(function(event){
		$('.modal').removeClass('active');
		$('body').removeClass('lock');
	});
	$('.modal__overlay').click(function(event){
		$('.modal').removeClass('active');
		$('body').removeClass('lock');
	});
});
