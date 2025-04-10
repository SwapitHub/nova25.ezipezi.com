@extends($templatePath . '.shop_layout')
@section('center')
    {{-- main div section --}}
    <div class="slider-single-custom-bg">
        @foreach ($videos as $video)
            <div class="first-banner-image-slide">
                {{-- <img src="{{ asset('netflix') }}/slider-1-image.jpg" alt="slider-image"> --}}
                <img src="{{ $video->image }}" alt="{{ $video->imagealt }}">
                <div class="thumbnail-banner-container">
                    <div class="slider-banner-content">
                        <h1 class="ctm-color-white">{{ $video->name }}</h1>
                        @php
                            $intro = strip_tags($video->introduction ?? 'Location not available');
                            $words = str_word_count($intro, 1);
                            $limitedIntro =
                                count($words) > 150 ? implode(' ', array_slice($words, 0, 150)) . '...' : $intro;
                        @endphp
                        <p class="ctm-color-white">
                            {!! $limitedIntro !!}
                        </p>
                        <div class="slider-banner-content-button">
                            <a href="{{ $video->read_more_link }}" title="Read More" class="custom-primary-buttom">Read
                                More</a>
                            <a href="{{ $video->watch_now_link }}" title="watch videos"
                                class="custom-secontary-buttom">watch videos</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- main div section --}}

    {{-- slider section start --}}
    <div class="custom-slider-nav-sec">
        @foreach ($videos as $video)
            <div class="slider-nav-image-sec">
                {{-- <img class="custom-slide" src="{{ asset('netflix') }}/slider-1-image.jpg" alt="slider-image"> --}}
                <img class="custom-slide" src="{{ $video->image }}" alt="{{ $video->imagealt }}">
                <div class="slider-nav-image-content">
                    <h6 class="ctm-color-white">{{ $video->name }}</h6>
                    @php
                        $intro = strip_tags($video->introduction ?? 'Location not available');
                        $words = str_word_count($intro, 1);
                        $limitedIntro =
                            count($words) > 150 ? implode(' ', array_slice($words, 0, 150)) . '...' : $intro;
                    @endphp
                    <p class="ctm-color-white">{!! $limitedIntro !!}</p>
                    <div class="slider-nav-image-content-button">
                        <a href="{{ $video->read_more_link }}" title="Read More" class="custom-primary-buttom">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- slider section start --}}
@endsection
