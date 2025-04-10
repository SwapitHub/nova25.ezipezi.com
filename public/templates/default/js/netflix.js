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
	  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
	        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
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