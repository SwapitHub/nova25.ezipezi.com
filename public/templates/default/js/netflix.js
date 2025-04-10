$(".slider-single-custom-bg").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    useTransform: true,
    asNavFor: ".custom-slider-nav-sec",
    dots: false,
});



$(".custom-slider-nav-sec").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: ".slider-single-custom-bg",
    dots: false,
    focusOnSelect: true,
    arrows: false,
});


// 



function closeOpenDropdowns(e) {
    let openDropdownEls = document.querySelectorAll("details.dropdown[open]");

    if (openDropdownEls.length > 0) {
        // If we're clicking anywhere but the summary element, close dropdowns
        if (e.target.parentElement.nodeName.toUpperCase() !== "SUMMARY") {
            openDropdownEls.forEach((dropdown) => {
                dropdown.removeAttribute("open");
            });
        }
    }
}

document.addEventListener("click", closeOpenDropdowns);