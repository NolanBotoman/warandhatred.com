setWidth();

function setWidth() {
	if (window.matchMedia("(min-width: 1024px)").matches) {
		let cards_width = 0;
		const card_style = document.querySelector('.card').currentStyle || window.getComputedStyle(document.querySelector('.card'));

		for (let card in document.querySelector('.card')) {

			if (cards_width > document.querySelector('.main').offsetWidth) {
				cards_width -= document.querySelector('.card').offsetWidth + parseFloat(card_style.marginLeft) + parseFloat(card_style.marginRight);
;
				break;
			}

			cards_width += document.querySelector('.card').offsetWidth + parseFloat(card_style.marginLeft) + parseFloat(card_style.marginRight);

		}

		document.querySelector('.centered').style.width = cards_width + "px";
	}
}

window.addEventListener('load', setWidth, false);
window.addEventListener('resize', setWidth, false);