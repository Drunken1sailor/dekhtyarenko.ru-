document.addEventListener("DOMContentLoaded", function() {
	// let _width = window.getComputedStyle("column__pic").getPropertyValue('width');
	// let _width = $("column__pic").getPropertyValue("width");
	let _firstPicture = document.getElementById('img_example');
	let _width = window.getComputedStyle(_firstPicture).getPropertyValue('width');

	let _value = '0 1 ' + _width;
	// _picture.style.flex = _value;
	// console.log(window.getComputedStyle(_picture));

	let _picture = document.querySelectorAll('.column__pic');
	_picture.forEach(function(element){
		element.style.flex = _value;
	});

});