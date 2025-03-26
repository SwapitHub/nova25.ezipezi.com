@php
    $banners = \App\Models\ShopBanner::where('status', 1)->where('type', 0)->sort()->get();
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
                    <div class="inner-banner-slider">
                        @if ($banner->startdate <= $currentDate && $banner->expity >= $currentDate)
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
            <div class="banner-list-slider ctm-mt-30">
                <div class="inner-banner-list-slider">
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="#"
                                title="Official Cloves shop">Official Cloves shop</a></li>
                        <li class="ctm-gray-light-color ctm-primary-color">over 1100 products online</li>
                    </ul>
                </div>
                <div class="inner-banner-list-slider">
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="#"
                                title="Free shipping and returns">Free shipping and returns</a></li>
                        <li class="ctm-gray-light-color ctm-primary-color">for members</li>
                    </ul>
                </div>
                <div class="inner-banner-list-slider">
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="#"
                                title="Free Same-day dispatch">Same-day dispatch</a></li>
                        <li class="ctm-gray-light-color ctm-primary-color">before 8pm (Mon-Fri)</li>
                    </ul>
                </div>
                <div class="inner-banner-list-slider">
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="#"
                                title="Official Cloves shop">Official Cloves shop</a></li>
                        <li class="ctm-gray-light-color ctm-primary-color">over 1100 products online</li>
                    </ul>
                </div>
                <div class="inner-banner-list-slider">
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="#"
                                title="Free shipping and returns">Free shipping and returns</a></li>
                        <li class="ctm-gray-light-color ctm-primary-color">for members</li>
                    </ul>
                </div>
                <div class="inner-banner-list-slider">
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="#"
                                title="Free Same-day dispatch">Same-day dispatch</a></li>
                        <li class="ctm-gray-light-color ctm-primary-color">before 8pm (Mon-Fri)</li>
                    </ul>
                </div>
            </div>
            {{-- second banner slider end  --}}
        </div>
    </section>
@endif
