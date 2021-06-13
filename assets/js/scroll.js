function lockScroll() {
	if (window.matchMedia("(max-width: 1024px)").matches) {

		if (document.querySelector('body').classList.contains('fixed')) {

			document.querySelector('body').removeEventListener('touchmove', preventDefault);
            document.querySelector('body').classList.remove('fixed');
        } else {
 			document.querySelector('body').addEventListener('touchmove', preventDefault, { passive: false });
            document.querySelector('body').classList.add('fixed');
        }

	}
}

function preventDefault(e){
    e.preventDefault();
}