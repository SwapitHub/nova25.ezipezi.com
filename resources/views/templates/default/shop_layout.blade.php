@if (sc_config('SITE_STATUS') == 'off')
    @include($templatePath . '.maintenance')
    @php
        exit();
    @endphp
@endif

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? sc_store('description') }}">
    <meta name="keyword" content="{{ $keyword ?? sc_store('keyword') }}">
    <title>{{ $title ?? sc_store('title') }}</title>
    <meta property="og:image" content="{{ !empty($og_image) ? asset($og_image) : asset('images/org.jpg') }}" />
    <meta property="og:url" content="{{ \Request::fullUrl() }}" />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="{{ $title ?? sc_store('title') }}" />
    <meta property="og:description" content="{{ $description ?? sc_store('description') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Module meta -->
    @isset($blocksContent['meta'])
        @foreach ($blocksContent['meta'] as $layout)
            @php
                $arrPage = explode(',', $layout->page);
            @endphp
            @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
                @if ($layout->type == 'html')
                    {!! $layout->text !!}
                @endif
            @endif
        @endforeach
    @endisset
    <!--//Module meta -->

    <!-- css default for item s-cart -->
    @include('common.css')
    <!--//end css defaut -->

    <link href="{{ asset($templateFile . '/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/cookit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <!--[if lt IE 9]>
   <script src="{{ asset($templateFile . '/js/html5shiv.js') }}"></script>
   <script src="{{ asset($templateFile . '/js/respond.min.js') }}"></script>
  <![endif]-->
    <link rel="shortcut icon" href="{{ asset(sc_store('favicon_icon')) }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset($templateFile . '/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset($templateFile . '/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset($templateFile . '/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset($templateFile . '/images/ico/apple-touch-icon-57-precomposed.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />


    <style>
        body {
            -moz-user-select: -moz-none;
            -khtml-user-select: none;
            -webkit-user-select: none;

            /*
   Introduced in IE 10.
   See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
   */
            -ms-user-select: none;
            user-select: none;
        }
    </style>

    <!--Module header -->
    @isset($blocksContent['header'])
        @foreach ($blocksContent['header'] as $layout)
            @php
                $arrPage = explode(',', $layout->page);
            @endphp
            @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
                @if ($layout->type == 'html')
                    {!! $layout->text !!}
                @endif
            @endif
        @endforeach
    @endisset
    <!--//Module header -->

</head>
<!--//head-->

<body oncopy="return false" oncut="return false" onpaste="return false" id="web-body" ondragstart="return false;"
    ondrop="return false;">

    @include($templatePath . '.header')

    <!--Module banner -->
    @isset($blocksContent['banner_top'])
        @foreach ($blocksContent['banner_top'] as $layout)
            @php
                $arrPage = explode(',', $layout->page);
            @endphp
            @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
                @if ($layout->type == 'html')
                    {!! $layout->text !!}
                @elseif($layout->type == 'view')
                    @if (view()->exists('block.' . $layout->text))
                        @include('block.' . $layout->text)
                    @endif
                @elseif($layout->type == 'module')
                    {!! sc_block_render($layout->text) !!}
                @endif
            @endif
        @endforeach
    @endisset
    <!--//Module banner -->


    <!--Module top -->
    @isset($blocksContent['top'])
        @foreach ($blocksContent['top'] as $layout)
            @php
                $arrPage = explode(',', $layout->page);
            @endphp
            @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
                @if ($layout->type == 'html')
                    {!! $layout->text !!}
                @elseif($layout->type == 'view')
                    @if (view()->exists('block.' . $layout->text))
                        @include('block.' . $layout->text)
                    @endif
                @elseif($layout->type == 'module')
                    {!! sc_block_render($layout->text) !!}
                @endif
            @endif
        @endforeach
    @endisset
    <!--//Module top -->

    @section('main')
        @include($templatePath . '.center')

    @show
    <?php
    /* <section>
				<div class="container">
				<div class="row">
				<div class="col-sm-12" id="breadcrumb">
				<!--breadcrumb-->
				@yield('breadcrumb')
				<!--//breadcrumb-->
				
				<!--fillter-->
				@yield('filter')
				<!--//fillter-->
				</div>
				
				<!--Notice -->
				@include($templatePath.'.notice')
				<!--//Notice -->
				
				<!--body-->
				@section('main')
				@include($templatePath.'.left')
				@include($templatePath.'.center')
				@include($templatePath.'.right')
				@show
				<!--//body-->
				
				</div>
				</div>
				</section>
			*/
    ?>

    @include($templatePath . '.footer')

    <script src="{{ asset($templateFile . '/js/jquery.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/main.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/custom.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/cookit.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/jquery-read-more.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

        jQuery(document).ready(function($) {
            if (!isMobile) {
                setTimeout(function() {
                    var url = $('.wa-chat-box-send .wa-chat-box-content-send-btn').attr('href');
                    var newURL = url.replace("api", "web");
                    $('.wa-chat-box-send .wa-chat-box-content-send-btn').attr('href', newURL);
                }, 500);
            }
        });
    </script>


    @stack('scripts')

    <!-- js default for item s-cart -->
    @include('common.js')
    <!--//end js defaut -->

    <!--Module bottom -->
    @isset($blocksContent['bottom'])
        @foreach ($blocksContent['bottom'] as $layout)
            @php
                $arrPage = explode(',', $layout->page);
            @endphp
            @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
                @if ($layout->type == 'html')
                    {!! $layout->text !!}
                @elseif($layout->type == 'view')
                    @if (view()->exists('block.' . $layout->text))
                        @include('block.' . $layout->text)
                    @endif
                @elseif($layout->type == 'module')
                    {!! sc_block_render($layout->text) !!}
                @endif
            @endif
        @endforeach
    @endisset
    <!--//Module bottom -->

</body>
{{-- <script>
		document.addEventListener('contextmenu', event => event.preventDefault());	
		$('body').bind('copy paste',function(e) {
			e.preventDefault(); return false; 
		});
		const box = document.getElementById('web-body');
		box.addEventListener('dragstart', event => {
			event.preventDefault();
		});
		
		box.addEventListener('drop', event => {
			event.preventDefault();
		});
		document.addEventListener("keydown", function (event){
			if (event.ctrlKey){
				event.preventDefault();
			}
			if(event.keyCode == 123){
				event.preventDefault();
			}
		});
	</script> --}}

{{-- script for nova slider --}}
<script>
    // - banner from custom js start---
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
        responsive: [{
                breakpoint: 767, // Below 991px (Tablet)
                settings: {
                    slidesToShow: 2,
                    dots: true // Enable dots for smaller screens
                }
            },
            {
                breakpoint: 575, // Below 768px (Mobile)
                settings: {
                    slidesToShow: 1,
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
        responsive: [{
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
        responsive: [{
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
    $(document).ready(function() {
        // Initialize Slick for all tabs (only once)
        $(".tab-content .future-product-tabs-slider").each(function() {
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
                responsive: [{
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
        $(".custom-tabs li.tab-link").click(function() {
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

        if (hours < "10") {
            hours = "0" + hours;
        }
        if (minutes < "10") {
            minutes = "0" + minutes;
        }
        if (seconds < "10") {
            seconds = "0" + seconds;
        }

        $(".days").html(days + "<span>Days</span>");
        $(".hours").html(hours + "<span>Hours</span>");
        $(".minutes").html(minutes + "<span>Mins</span>");
        $(".seconds").html(seconds + "<span>Secs</span>");

    }

    setInterval(function() {
        makeTimer();
    }, 1000);
    /* =================== SALE And SPECIAL PRODUCTS Slider End here =================== */





    /* ===========================  feature products Js Start Here  =========================== */
    $(document).ready(function() {
        $('.future-clothers-tab-a').click(function() {
            $(".future-clothers-tab").removeClass('future-clothers-tab-active');
            $(".future-clothers-tab[data-id='" + $(this).attr('data-id') + "']").addClass(
                "future-clothers-tab-active");
            $(".future-clothers-tab-a").removeClass('future-clothers-active-a');
            $(this).parent().find(".future-clothers-tab-a").addClass('future-clothers-active-a');
        });
    });
    /* ===========================  feature products Tabs Js End Here  =========================== */








    /* ===========================  Scroll Animation Js Start Here  =========================== */


    $(document).ready(function() {
        // Initialize the slider


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
        $('.banner-slider-main').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            animateOut(); // Animate out the current slide content
        });

        $('.banner-slider-main').on('afterChange', function(event, slick, currentSlide) {
            animateIn(); // Animate in the new slide content
        });

        // Trigger the animation on page load
        animateIn(); // Animate in the initial slide content
    });
    /* ===========================  Scroll Animation  Js End Here  =========================== */



    /*================header-script===================*/

    document.querySelectorAll(".dropdown-menu-list").forEach((menu) => {
        menu.addEventListener("mouseenter", function() {
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

        menu.addEventListener("mouseleave", function() {
            let submenu = this.querySelector(".sub-menu-header-list");
            if (submenu) {
                submenu.style.display = "none";
                submenu.style.opacity = "0";
                submenu.style.visibility = "hidden";
            }
        });
    });




    $(document).ready(function() {
        $("#show-megamenu-mobile").click(function() {
            $(".main-header-menu").toggleClass("mobile-menu-custon");
        });
    });

    document.querySelector(".close-icon-for-mobile span").addEventListener("click", function() {
        document.querySelector(".main-header-menu").classList.remove("mobile-menu-custon");
    });


    document.addEventListener("DOMContentLoaded", function() {
        function toggleParentMenu() {
            if (window.innerWidth <= 991) {
                document.querySelectorAll("span.caret-icon").forEach((icon) => {
                    icon.addEventListener("click", function(event) {
                        event.stopPropagation(); // Prevent event bubbling

                        let parentListItem = this.closest(
                            "li.dropdown-menu-list"); // Get the parent li
                        let allListItems = document.querySelectorAll(
                            "li.dropdown-menu-list"); // Get all li items

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
        window.addEventListener("resize", function() {
            toggleParentMenu();
        });
    });


    $(document).ready(function() {
        $(".back-to-top").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 800); // Smooth scroll to top in 800ms
        });
    });
    $(window).scroll(function() {
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
    $(document).ready(function() {
        $('.gallery-tab a').click(function() {
            $('.gallery-tab a').removeClass('activelink');
            $(this).addClass('activelink');
            var tagid = $(this).data('tag');
            $('.list').removeClass('active').addClass('hide');
            $('#' + tagid).addClass('active').removeClass('hide');
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
                $(".accordion-custom > .accordion-item").removeClass("is-active").children(
                    ".accordion-panel").slideUp();
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
                $(".accordion-custom-two > .accordion-item").removeClass("is-active").children(
                    ".accordion-panel").slideUp();
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
                $(".accordion-custom-three > .accordion-item").removeClass("is-active").children(
                    ".accordion-panel").slideUp();
                $(this).addClass("is-active").children(".accordion-panel").slideDown();
            }
        });
    });

    /*================faq-page-accordion===================*/
</script>

</html>
