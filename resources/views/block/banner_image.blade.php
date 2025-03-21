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

            @foreach ($slides as $banner)
                <div class="inner-banner-slider">
                    <div class="animated-banner-content">
                        <h2 class="animate fade-down3"><span class="ctm-gray-light-color">introducing</span></h2>
                        <h1 class="ctm-dark-black animate fade-down2">Peace, Love & Prints</h1>
                        <p class="ctm-mt-10 animate fade-down">Welcome long days at the beach with our collection
                            of
                            effortlessly
                        </p>
                        <div class="explore-now-btn ctm-mt-20">
                            <ul>
                                <li><a href="#" title="explore now" class="common-secondary-button"> explore
                                        now
                                    </a>
                                </li>
                                <li><a href="#" title=" hop the collab" class="common-secondary-button">hop
                                        the
                                        collab
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="banner-img banner-img-one">
                        {{-- <img src="{{ asset($templateFile . '/images/theme-images') }}/banner-image1.png"> --}}
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