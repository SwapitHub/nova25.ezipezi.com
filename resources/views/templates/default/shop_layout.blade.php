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
    <link href="{{ asset($templateFile . '/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset($templateFile . '/css/cookit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <!--[if lt IE 9]>
   <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/html5shiv.js') }}"></script>
   <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/respond.min.js') }}"></script>
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
    @include($templatePath . '.footer')

    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/jquery.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/main.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/custom.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/cookit.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}{{ asset($templateFile . '/js/jquery-read-more.js') }}"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="{{ asset($templateFile . '/images/theme-images/') }}https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
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
    $('body').bind('copy paste', function(e) {
        e.preventDefault();
        return false;
    });
    const box = document.getElementById('web-body');
    box.addEventListener('dragstart', event => {
        event.preventDefault();
    });

    box.addEventListener('drop', event => {
        event.preventDefault();
    });
    document.addEventListener("keydown", function(event) {
        if (event.ctrlKey) {
            event.preventDefault();
        }
        if (event.keyCode == 123) {
            event.preventDefault();
        }
    });
</script> --}}

</html>
