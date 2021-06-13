if (document.querySelector('.jacket') != null) {

    const class_syntax = '.jacket';
    
    setWidth();

    function setWidth() {
        if (window.matchMedia("(min-width: 1024px)").matches) {
            let cards_width = 0;
            const card_style =  window.getComputedStyle(document.querySelector('.jacket'));

            if (document.querySelectorAll('.gallery .jacket').length == 1) document.querySelector('.box').classList.add('justify-content-center');

            for (let card in document.querySelector(class_syntax)) {

                if (cards_width > document.querySelector('.main').offsetWidth) {
                    cards_width -= document.querySelector(class_syntax).offsetWidth + parseFloat(card_style.marginLeft) + parseFloat(card_style.marginRight);
                    break;
                }

                cards_width += document.querySelector(class_syntax).offsetWidth + parseFloat(card_style.marginLeft) + parseFloat(card_style.marginRight);

            }

            document.querySelector('.box').style.width = cards_width + "px";
        }
    }

    window.addEventListener('load', setWidth, false);
    window.addEventListener('resize', setWidth, false);
}