$(document).ready(function(){
	$('.header__burger').click(function(event){
		$('.header__burger,.nav').toggleClass('active');
		$('body').toggleClass('lock');
	});
	const mediaQuery = window.matchMedia('(min-width: 768px)');
	if(mediaQuery.matches){
		const navOffset = $('.nav').offset().top;
		$(window).scroll(function(){
			const scrolled = $(this).scrollTop();
			if(scrolled > navOffset){
				$('.nav').addClass('nav-fixed');
			} else if(scrolled < navOffset){
				$('.nav').removeClass('nav-fixed');
			}
		});
	}
});
