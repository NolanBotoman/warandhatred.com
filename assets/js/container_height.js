window.onload = () => {
	function setHeight() {
		if (window.matchMedia("(min-width: 1024px)").matches) {
	  		document.querySelector('.main').style.height = document.querySelector('body').offsetHeight - document.querySelector('.nav').offsetHeight + "px";
		}
	}

	function resize() {
	  	if("matchMedia" in window) {
	  		setHeight();
	  	}
	}

	window.addEventListener('load', setHeight, false);
	window.addEventListener('resize', resize, false);
}