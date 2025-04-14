@php
    $banners = \App\Models\ShopBanner::where('status', 1)->where('type', 0)->sort()->get();
    $textslider = \App\Models\TextSlider::where('status', 1)->get();
@endphp
<?php $slides = App\Models\Slider::getSlider(6);

?>
@if (!empty($slides))
    {{-- <section class="banner-outer">
    <div class="banner-slider">
        <?php $slcnt = 1; ?>
        @foreach ($slides as $banner)
            <div class="banner slider-{{ $slcnt }}"
                style="background-image: url('{{ asset($banner->image) }}');">
                <div class="container">
                    <div class="banner-inner">
                        <div class="banner-content">
                            <?php echo $banner->description; ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php $slcnt++; ?>
        @endforeach
    </div>
</section> --}}


    <section class="banner-bg">
        <div class="container">
            <div class="banner-slider-main">
                @php
                    $currentDate = now();
                @endphp

                @foreach ($slides as $banner)
                    @php
                        $currentDate = now();
                        $isActive =
                            $banner->startdate <= $currentDate &&
                            (empty($banner->expity) || $banner->expity >= $currentDate);
                    @endphp
                    <div class="inner-banner-slider">
                        @if ($isActive)
                            <div class="animated-banner-content">
                                {!! $banner->description !!}
                            </div>
                        @endif
                        <div class="banner-img banner-img-one">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->image_alt }}">
                        </div>
                    </div>
                @endforeach

            </div>
            {{--  second banner slider start  --}}
            @if (count($textslider) > 0)
                @php
                    $currentDate = now();
                @endphp
                <div class="banner-list-slider ctm-mt-30">
                    @foreach ($textslider as $text)
                        @php
                            $currentDate = now();
                            $isActive =
                                $text->startdate <= $currentDate &&
                                (empty($text->expity) || $text->expity >= $currentDate);
                        @endphp
                        @if ($isActive)
                            <div class="inner-banner-list-slider">
                                <ul>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> {!! $text['description'] !!}</li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            {{-- second banner slider end  --}}
        </div>
    </section>
@endif
