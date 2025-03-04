

/* ===========================  Banner Slider Js Start Here =========================== */

$(".deals-zene-slider").slick({
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
});



/* ===========================  Banner Slider Js End Here  =========================== */











/* ===========================  Deals zone Slider Js Start Here =========================== */

$(".banner-slider-main").slick({
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    autoplay: false,
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
    autoplay: false,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
});



/* ===========================  New Arrivals Slider Js End Here  =========================== */







/* ===========================  From the blog Slider Js Start Here =========================== */

$(".social-media-post-slider").slick({
    slidesToShow: 1,
    infinite: true,
    arrows: true,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
});



/* ===========================  From the blog Slider Js End Here  =========================== */






/* ===========================  Footer Logo Brand Slider Js Start Here =========================== */

$(".footer-logo-brand-slider").slick({
    slidesToShow: 6,
    infinite: true,
    arrows: true,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1000,
    dots: false,
    adaptiveHeight: true,
    speed: 600,
    easing: 'ease-in-out',
    cssEase: 'ease-in-out',
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
            autoplay: false,
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
