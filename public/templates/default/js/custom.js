

/* ===========================  Banner Slider Js Start Here =========================== */

$(".deals-zene-slider").slick({
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
responsive: [
{
            breakpoint: 767, // Below 991px (Tablet)
            settings: {
                slidesToShow: 2,
                dots: true // Enable dots for smaller screens
            }
        },
        {
            breakpoint: 575, // Below 768px (Mobile)
            settings: {
                slidesToShow:1,
                centerPadding: "20px",
                dots: true,
                autoplay: true
            }
        }
		
		
    ]
});



/* ===========================  Banner Slider Js End Here  =========================== */











/* ===========================  Deals zone Slider Js Start Here =========================== */

$(".banner-slider-main").slick({
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    dots: true,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
    fade: true,
});



/* ===========================  Deals zone Slider Js End Here  =========================== */







/* ===========================  New Arrivals Slider Js Start Here =========================== */

$(".banner-list-slider").slick({
    slidesToShow: 3,
    infinite: true,
    arrows: false,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: "ease-in-out",
    cssEase: "ease-in-out",
    responsive: [
        {
            breakpoint: 1024, // Below 1200px
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 991, // Below 991px (Tablet)
            settings: {
                slidesToShow: 2,
                dots: true // Enable dots for smaller screens
            }
        },
        {
            breakpoint: 767, // Below 768px (Mobile)
            settings: {
                slidesToShow: 1,
                dots: true,
                autoplay: true // Enable autoplay on mobile
            }
        }
    ]
});


/* ===========================  New Arrivals Slider Js End Here  =========================== */







/* ===========================  From the blog Slider Js Start Here =========================== */

$(".social-media-post-slider").slick({
    slidesToShow: 1,
    infinite: true,
    arrows: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
	responsive: [
       
        {
            breakpoint: 767, // Below 991px (Tablet)
            settings: {
                slidesToShow: 1,
                dots: true // Enable dots for smaller screens
            }
        },
        {
            breakpoint: 575, // Below 768px (Mobile)
            settings: {
                slidesToShow: 1,
                dots: true,
                autoplay: true // Enable autoplay on mobile
            }
        }
    ]
});



/* ===========================  From the blog Slider Js End Here  =========================== */






/* ===========================  Footer Logo Brand Slider Js Start Here =========================== */

$(".footer-logo-brand-slider").slick({
    slidesToShow: 6,
    infinite: true,
    arrows: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
	responsive: [
       {
            breakpoint: 1024, // Below 991px (Tablet)
            settings: {
                slidesToShow: 4,
                dots: true // Enable dots for smaller screens
            }
        },
        {
            breakpoint: 767, // Below 991px (Tablet)
            settings: {
                slidesToShow: 3,
                dots: true // Enable dots for smaller screens
            }
        },
        {
            breakpoint: 575, // Below 768px (Mobile)
            settings: {
                slidesToShow: 2,
                dots: true,
                autoplay: true // Enable autoplay on mobile
            }
        }
    ]
});



/* ===========================  Footer Logo Brand Slider Js End Here  =========================== */








/* ===========================  feature products Slider Js Start Here =========================== */
$(document).ready(function () {
    // Initialize Slick for all tabs (only once)
    $(".tab-content .future-product-tabs-slider").each(function () {
        $(this).slick({
            slidesToShow: 4,
            infinite: true,
            arrows: false,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            dots: false,
            speed: 600,
            easing: "ease-in-out",
            cssEase: "ease-in-out",
            responsive: [
                {
                    breakpoint: 1024, // Screen width less than 1200px
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 991, // Screen width less than 992px
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 640, // Screen width less than 768px
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    });

    // Show the first tab content by default
    $(".custom-tabs li.tab-link").first().addClass("current");
    $(".tab-content").first().addClass("current").show();

    // Tab Switching Functionality
    $(".custom-tabs li.tab-link").click(function () {
        var tab_id = $(this).attr("data-id");

        // Remove 'current' class from all tabs and hide all tab content
        $(".custom-tabs li.tab-link").removeClass("current");
        $(".tab-content").removeClass("current").hide();

        // Add 'current' class to the clicked tab and show the corresponding content
        $(this).addClass("current");
        $("#" + tab_id).addClass("current").fadeIn(300);

        // Refresh the Slick slider to ensure proper width calculation
        $("#" + tab_id + " .future-product-tabs-slider").slick("setPosition");
    });
});




/* ===========================  feature products Slider Js End Here  =========================== */








/* ===========================  Product Furniture Slider Js End Here  =========================== */

$('.product-fruniture-slider').slick({

    slidesToScroll: 1,
    arrows: false,
    dots: true,
    vertical: true,
    verticalSwiping: true

});
/* ===========================  Product Furniture Slider Js End Here  =========================== */



/* =================== SALE And SPECIAL PRODUCTS Slider Start here =================== */
/* Cound-down */
function makeTimer() {

    //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");	
    var endTime = new Date("29 April 2025 9:56:00 GMT+01:00");
    endTime = (Date.parse(endTime) / 1000);

    var now = new Date();
    now = (Date.parse(now) / 1000);

    var timeLeft = endTime - now;

    var days = Math.floor(timeLeft / 86400);
    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

    if (hours < "10") { hours = "0" + hours; }
    if (minutes < "10") { minutes = "0" + minutes; }
    if (seconds < "10") { seconds = "0" + seconds; }

    $(".days").html(days + "<span>Days</span>");
    $(".hours").html(hours + "<span>Hours</span>");
    $(".minutes").html(minutes + "<span>Mins</span>");
    $(".seconds").html(seconds + "<span>Secs</span>");

}

setInterval(function () { makeTimer(); }, 1000);
/* =================== SALE And SPECIAL PRODUCTS Slider End here =================== */





/* ===========================  feature products Js Start Here  =========================== */
$(document).ready(function () {
    $('.future-clothers-tab-a').click(function () {
        $(".future-clothers-tab").removeClass('future-clothers-tab-active');
        $(".future-clothers-tab[data-id='" + $(this).attr('data-id') + "']").addClass("future-clothers-tab-active");
        $(".future-clothers-tab-a").removeClass('future-clothers-active-a');
        $(this).parent().find(".future-clothers-tab-a").addClass('future-clothers-active-a');
    });
});
/* ===========================  feature products Tabs Js End Here  =========================== */








/* ===========================  Scroll Animation Js Start Here  =========================== */

$(document).ready(function(){
  // Initialize the slider
  $('.banner-slider-main').slick({
    autoplay: true,
    dots: true,
    arrows: true,
    infinite: true,
    speed: 500,
	autoplay: true,
    fade: true,
    cssEase: 'linear'
  });

  // Function to animate out the current slide content
  function animateOut() {
    $('.slick-active .animated-banner-content').css({
      opacity: 0,
      transform: 'translateY(20px)'
    });
  }

  // Function to animate in the new slide content
  function animateIn() {
    $('.slick-active .animated-banner-content').css({
      opacity: 1,
      transform: 'translateY(0)'
    });
  }

  // Handle slide change event
  $('.banner-slider-main').on('beforeChange', function(event, slick, currentSlide, nextSlide){
    animateOut(); // Animate out the current slide content
  });

  $('.banner-slider-main').on('afterChange', function(event, slick, currentSlide){
    animateIn(); // Animate in the new slide content
  });

  // Trigger the animation on page load
  animateIn(); // Animate in the initial slide content
});
/* ===========================  Scroll Animation  Js End Here  =========================== */



/*================header-script===================*/

document.querySelectorAll(".dropdown-menu-list").forEach((menu) => {
    menu.addEventListener("mouseenter", function () {
        let submenu = this.querySelector(".sub-menu-header-list");
        if (submenu) {
            if (window.innerWidth <= 991) {
                submenu.style.display = "block";
            } else {
                submenu.style.display = "flex";
            }
            submenu.style.opacity = "1";
            submenu.style.visibility = "visible";
        }
    });

    menu.addEventListener("mouseleave", function () {
        let submenu = this.querySelector(".sub-menu-header-list");
        if (submenu) {
            submenu.style.display = "none";
            submenu.style.opacity = "0";
            submenu.style.visibility = "hidden";
        }
    });
});




$(document).ready(function () {
    $("#show-megamenu-mobile").click(function () {
        $(".main-header-menu").toggleClass("mobile-menu-custon");
    });
});

document.querySelector(".close-icon-for-mobile span").addEventListener("click", function () {
    document.querySelector(".main-header-menu").classList.remove("mobile-menu-custon");
});


document.addEventListener("DOMContentLoaded", function () {
    function toggleParentMenu() {
        if (window.innerWidth <= 991) {
            document.querySelectorAll("span.caret-icon").forEach((icon) => {
                icon.addEventListener("click", function (event) {
                    event.stopPropagation(); // Prevent event bubbling

                    let parentListItem = this.closest("li.dropdown-menu-list"); // Get the parent li
                    let allListItems = document.querySelectorAll("li.dropdown-menu-list"); // Get all li items

                    // Remove 'active-list-menu' class from all sibling li elements
                    allListItems.forEach((li) => {
                        if (li !== parentListItem) {
                            li.classList.remove("active-list-menu");
                        }
                    });

                    // Toggle class on the clicked parent li
                    if (parentListItem) {
                        parentListItem.classList.toggle("active-list-menu");
                    }
                });
            });
        }
    }

    toggleParentMenu(); // Run function on load

    // Re-run function on window resize
    window.addEventListener("resize", function () {
        toggleParentMenu();
    });
});


$(document).ready(function () {
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 800); // Smooth scroll to top in 800ms
    });
});
$(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $(".back-to-top").addClass("show");
    } else {
        $(".back-to-top").removeClass("show");
    }
});


/*================header-script===================*/



/*================about-page-slider===================*/

$(".about-us-inner-slider").slick({
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
    fade: false,
});
/*================about-page-slider===================*/


/*================photo-gallery-page-tab===================*/
 $(document).ready(function(){
	$('.gallery-tab a').click(function(){
		$('.gallery-tab a').removeClass('activelink');
		$(this).addClass('activelink');
		var tagid = $(this).data('tag');
		$('.list').removeClass('active').addClass('hide');
		$('#'+tagid).addClass('active').removeClass('hide');
	});
});
/*================photo-gallery-page-tab===================*/

/*================faq-page-accordion===================*/
$(function() {
    // Hide all panels except the one inside .is-active
    $(".accordion-custom .accordion-panel").hide();
    $(".accordion-custom > .accordion-item.is-active .accordion-panel").show(); 

    $(".accordion-custom > .accordion-item").click(function() {
        if (!$(this).hasClass("is-active")) {
            $(".accordion-custom > .accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
            $(this).addClass("is-active").children(".accordion-panel").slideDown();
        }
    });
});


$(function() {
    // Hide all panels except the one inside .is-active
    $(".accordion-custom-two .accordion-panel").hide();
    $(".accordion-custom-two > .accordion-item.is-active .accordion-panel").show(); 

    $(".accordion-custom-two > .accordion-item").click(function() {
        if (!$(this).hasClass("is-active")) {
            $(".accordion-custom-two > .accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
            $(this).addClass("is-active").children(".accordion-panel").slideDown();
        }
    });
});


$(function() {
    // Hide all panels except the one inside .is-active
    $(".accordion-custom-three .accordion-panel").hide();
    $(".accordion-custom-three > .accordion-item.is-active .accordion-panel").show(); 

    $(".accordion-custom-three > .accordion-item").click(function() {
        if (!$(this).hasClass("is-active")) {
            $(".accordion-custom-three > .accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
            $(this).addClass("is-active").children(".accordion-panel").slideDown();
        }
    });
});

/*================faq-page-accordion===================*/