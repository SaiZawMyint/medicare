
function _(argument) {
	return document.getElementById(argument);
}
function __(argument) {
	return document.querySelector(argument);
}
function Dark() {
	// body...
	var dark_mood=localStorage.getItem('mood');
	console.log(dark_mood);
	if (dark_mood != null) {
		document.body.style.backgroundColor='#343434';
		document.body.style.color='#ffffff';
		 dark=true;

		

		__('.alert-in-box').style.backgroundColor='#343434';
		__('.alert-in-box').style.border='2px solid';
		__('.alert-in-box-header').style.backgroundColor='#ffffff9b';

		_('dark').classList.toggle('active');

	}else{

		document.body.style.backgroundColor='#ffffff';
		document.body.style.color='#343434';
		dark=false;

		__('.alert-in-box').style.backgroundColor='#ffffff';
		__('.alert-in-box').style.border='none';
		
	}
}
//dark mood
window.onload=function() {
	Dark()	;
}