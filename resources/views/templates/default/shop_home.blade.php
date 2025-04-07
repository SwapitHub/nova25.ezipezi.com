@extends($templatePath . '.shop_layout')


@section('center')

    <!-- ================== TALK OF THE SHOW START HERE  ================== -->
    {{-- @if (count($carouselItems) > 0)
        <section class="recommended-bg ctm-section-margin">
            <div class="container">
                <div class="inner-recommended custom-justify-align-items custom_fixed_margin_bottom ctm-text-center">
                    <h2>TALK OF THE TOWN</h2>
                    <p class="ctm-mt-20">ADVERTISING SPOTS MUST HAVE START AND EXPIRY DATE</p>
                </div>
                <!-- Carousel Wrapper -->
                <div class="barber-shop-recommended custom-justify-space-between ctm-mt-50">
                    @foreach ($carouselItems as $item)
                        @php
                            $url = url("/{$item->type}/{$item->alias}");
                        @endphp
                        <div class="inner-barber-shop-recommended">

                            <div class="inner-barber-shop-img">
                                <a href="{{ $url }}"><img src="{{ asset($item->image ?? 'images/default.jpg') }}"
                                        alt="{{ $item->image_alt }}" style="height:260;width:357px"></a>
                            <div class="ribben-box">
							<h5>{{ $item->type }}</h5>
							</div>
							
							</div>

                            <div class="barber-shop-box-main">
                                <a href="{{ $url }}">
                                    <h5>{{ ucfirst($item->title ?? $item->name) }}</h5>
                                </a>
                                <div class="location-section">
                                    <ul class="custom-justify-start">
                                        <li>
                                            <p>{{ $item->introduction ?? 'Location not available' }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif --}}

    @php
        // Filter out expired items
        $filteredItems = $carouselItems->filter(function ($item) {
            return is_null($item->expire) || \Carbon\Carbon::now()->lt($item->expire);
        });
    @endphp

    @if ($filteredItems->count() > 0)
        <section class="recommended-bg ctm-section-margin">
            <div class="container">
                <div class="inner-recommended custom-justify-align-items custom_fixed_margin_bottom ctm-text-center">
                    <h2>TALK OF THE TOWN</h2>
                    <p class="ctm-mt-20">ADVERTISING SPOTS MUST HAVE START AND EXPIRY DATE</p>
                </div>
                <!-- Carousel Wrapper -->
                <div class="barber-shop-recommended custom-justify-space-between ctm-mt-50">
                    @foreach ($filteredItems as $item)
                        @php
                            $url = url("/{$item->type}/{$item->alias}");
                        @endphp
                        <div class="inner-barber-shop-recommended">
                            <div class="inner-barber-shop-img">
                                <a href="{{ $url }}">
                                    <img src="{{ asset($item->image ?? 'images/default.jpg') }}" alt="{{ $item->image_alt }}"
                                        style="height:260px;width:357px">
                                </a>
                                <div class="ribben-box">
                                    <h5>{{ $item->type }}</h5>
                                </div>
                            </div>
                            <div class="barber-shop-box-main">
                                <a href="{{ $url }}">
                                    <h5>{{ ucfirst($item->title ?? $item->name) }}</h5>
                                </a>
                                <div class="location-section">
                                    <ul class="custom-justify-start">
                                        @php
                                            $intro = strip_tags($item->introduction ?? 'Location not available');
                                            $words = str_word_count($intro, 1);
                                            $limitedIntro =
                                                count($words) > 150
                                                    ? implode(' ', array_slice($words, 0, 150)) . '...'
                                                    : $intro;
                                        @endphp
                                        <li>
                                            <p>{!! $limitedIntro !!}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    <!-- ================== TAKL OF SHOW SECTION END HERE ================== -->

    @if (count($products_new) > 0)
        <!-- ================== Shop New Arrivals Section Start Here ================== -->
        <section class="shop-new-arrivals-bg ctm-section-margin">
            <div class="container">
                <div class="inner-shop-new-arrivals ctm-text-center">
                    <h2>Shop New Arrivals</h2>
                    <p class="ctm-mt-20">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div class="all-shop-new-arrivals ctm-flex-row ctm-mt-50">
                    @foreach ($products_new as $new)
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                {{-- <a href="#" title="Drumstick bresao"> --}}
                                <img src="{{ $new->image }}" alt="{{ $new->alt }}" style="height:350px">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-eye"></i></button></li>
                                        <li><button type="button" onClick="addToCartAjax('{{ $new->id }}','default')"
                                                class="ctm-white-color"><i class="fa fa-shopping-cart"></i></button></li>
                                        {{-- <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button>
                                            </li> --}}
                                        {{-- <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button>
                                            </li> --}}

                                    </ul>
                                </div>
                                {{-- </a> --}}
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20">
                                    {{-- <a href="#" title="Drumstick bresao">{{ $new->name }}</a> --}}
                                    <a href="{{ $new->getUrl() }}">
                                        <p>{{ ucfirst($new->name) }}</p>
                                    </a>

                                </h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">${{ $new->price }}</span>
                                    {{-- <span class="old-price-del">$65.00</span> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
        <!-- ================== Shop New Arrivals Section End Here ================== -->
    @endif


    <!-- ================== SHOP BY CATEGORIES Section Start Here ================== -->
    {{-- <section class="shop-by-categoried-bg ctm-section-margin">
        <div class="container">
            <div class="inner-shop-by-categories ctm-text-center">
                <h2>SHOP BY CATEGORIES</h2>
                <p class="ctm-mt-20">Every pair of jeans needs something great to go with them. And we've got it all.
                </p>
            </div>
            <div class="categories-products ctm-flex-row ctm-justify-content-between ctm-mt-50">
                <div class="women-man-collection-sec ctm-flex-row ctm-justify-content-between">
                    <div class="women-man-collection-sec-left">
                        <div class="women-man-collection-img">
                            <a href="#" title="">
                                <img src="{{ asset('images/theme-images') }}/women-collection-image1.jpg"
                                    alt="women-collection">
                                <div class="women-man-collection-content">
                                    <h5 class="reddish-pink-color">WOMEN <br> COLLECTIONS</h5>
                                    <button type="button" class="common-secondary-button ctm-mt-10 reddish-pink-color">Shop
                                        Now</button>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="women-man-collection-sec-right">
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="CLOTHERS">
                                    <img src="{{ asset('images/theme-images') }}/cloth-img.jpg" alt="cloth-img">
                                    <div class="clothers-content-link">
                                        <span>CLOTHERS</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="ACCESSORIES">
                                    <img src="{{ asset('images/theme-images') }}/accessories-img.jpg" alt="ACCESSORIES">
                                    <div class="clothers-content-link">
                                        <span>ACCESSORIES</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="women-man-collection-sec women-man-collection-sec-two ctm-flex-row ctm-justify-content-between">
                    <div class="women-man-collection-sec-left">
                        <div class="women-man-collection-img">
                            <a href="#" title="">
                                <img src="{{ asset('images/theme-images') }}/women-collection-image2.jpg"
                                    alt="women-collection">
                                <div class="women-man-collection-content">
                                    <h5 class="soft-muted-blue-color">
                                        MEN'S
                                        <div> PICKS</div>
                                        <button type="button"
                                            class="common-secondary-button ctm-mt-10 soft-muted-blue-color">Shop
                                            Now</button>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="women-man-collection-sec-right">
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="CLOTHERS">
                                    <img src="{{ asset('images/theme-images') }}/cloth-img2.jpg" alt="cloth-img">
                                    <div class="clothers-content-link">
                                        <span>CLOTHERS</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="SHOES">
                                    <img src="{{ asset('images/theme-images') }}/shoes-img.jpg" alt="SHOES">
                                    <div class="clothers-content-link">
                                        <span>SHOES</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="women-man-collection-sec women-man-collection-sec-three ctm-flex-row ctm-justify-content-between">
                    <div class="women-man-collection-sec-left">
                        <div class="women-man-collection-img">
                            <a href="#" title="KID'S COLLECTIONS">
                                <img src="{{ asset('images/theme-images') }}/women-collection-image3.jpg"
                                    alt="KID'S COLLECTIONS">
                                <div class="women-man-collection-content">
                                    <h5 class="rusty-orange-color">
                                        KID'S
                                        <div> COLLECTIONS</div>
                                    </h5>
                                    <button type="button"
                                        class="common-secondary-button ctm-mt-10 rusty-orange-color">Shop
                                        Now</button>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="women-man-collection-sec-right">
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="CLOTHERS">
                                    <img src="{{ asset('images/theme-images') }}/kids-collection-img.jpg"
                                        alt="KID'S WEAR">
                                    <div class="clothers-content-link">
                                        <span>KID'S WEAR</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="ACCESSORIES">
                                    <img src="{{ asset('images/theme-images') }}/kids-ass.jpg" alt="ACCESSORIES">
                                    <div class="clothers-content-link">
                                        <span>ACCESSORIES</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="women-man-collection-sec women-man-collection-sec-four ctm-flex-row ctm-justify-content-between">
                    <div class="women-man-collection-sec-left">
                        <div class="women-man-collection-img">
                            <a href="#" title="STORES HOMEWARE">
                                <img src="{{ asset('images/theme-images') }}/women-collection-image1.jpg"
                                    alt="STORES HOMEWARE">
                                <div class="women-man-collection-content">
                                    <h5 class="grayish-brown-color">
                                        STORES
                                        <div>HOMEWARE</div>
                                    </h5>
                                    <button type="button"
                                        class="common-secondary-button ctm-mt-10 grayish-brown-color">Shop Now</button>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="women-man-collection-sec-right">
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="DECOR">
                                    <img src="{{ asset('images/theme-images') }}/decor-img.jpg" alt="DECOR">
                                    <div class="clothers-content-link">
                                        <span>DECOR</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="women-man-clothers-sec">
                            <div class="women-man-collection-img">
                                <a href="#" title="BED & BATH">
                                    <img src="{{ asset('images/theme-images') }}/bad-bath-img.jpg" alt="BED & BATH">
                                    <div class="clothers-content-link">
                                        <span>BED & BATH</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> --}}
    <!-- ================== SHOP BY CATEGORIES Section End Here ================== -->
    <!-- ================== Product Furniture Section Start Here ================== -->
    {{-- <section class="product-fruniture-bg ctm-section-margin">
        <div class="container">
            <div class="inner-product-fruniture"
                style=" background-image: url({{ asset('images/theme-images') }}/product-future-bg.jpg);background-repeat: no-repeat;background-size: cover;padding: 50px 140px;">
                <div class="product-fruniture-slider">
                    <div class="inner-product-fruniture-slider"
                        style="background-image: url({{ asset('images/theme-images') }}/inner-product-fruniture-bg1.jpg);background-repeat: no-repeat;background-size: cover;padding: 100px 80px;">
                        <h1 class="ctm-white-color">
                            Bedroom
                            <div>Furniture</div>
                        </h1>
                        <p class="ctm-white-color ctm-mt-20">Transform your space</p>
                        <p class="ctm-white-color ctm-mt-10">with bedroom essentials</p>
                        <div class="futute-shop-now-btn ctm-mt-30">
                            <a href="#" title="Shop now !" class="common-primary-button ctm-white-color">Shop now
                                !</a>
                        </div>
                    </div>
                    <div class="inner-product-fruniture-slider inner-product-fruniture-slider-two"
                        style="background-image: url({{ asset('images/theme-images') }}/inner-product-fruniture-bg1.jpg);background-repeat: no-repeat;background-size: cover;padding: 100px 80px;">
                        <h1 class="ctm-white-color">
                            Bedroom
                            <div>Furniture</div>
                        </h1>
                        <p class="ctm-white-color ctm-mt-20">Transform your space</p>
                        <p class="ctm-white-color ctm-mt-10">with bedroom essentials</p>
                        <div class="futute-shop-now-btn ctm-mt-30">
                            <a href="#" title="Shop now !" class="common-primary-button ctm-white-color">Shop now
                                !</a>
                        </div>
                    </div>
                    <div class="inner-product-fruniture-slider inner-product-fruniture-slider-three"
                        style="background-image: url({{ asset('images/theme-images') }}/inner-product-fruniture-bg1.jpg);background-repeat: no-repeat;background-size: cover;padding: 100px 80px;">
                        <h1 class="ctm-white-color">
                            Bedroom
                            <div>Furniture</div>
                        </h1>
                        <p class="ctm-white-color ctm-mt-20">Transform your space</p>
                        <p class="ctm-white-color ctm-mt-10">with bedroom essentials</p>
                        <div class="futute-shop-now-btn ctm-mt-30">
                            <a href="#" title="Shop now !" class="common-primary-button ctm-white-color">Shop now
                                !</a>
                        </div>
                    </div>
                </div>
                <div class="extra-finalsale-styles ctm-text-center">
                    <ul>
                        <li>
                            <h5>Extra 50% off some final sale styles * </h5>
                        </li>
                        <li><a href="#" title="Shop neutrals">Shop neutrals</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ================== Product Furniture Section End Here ================== -->
    <!-- ================== Events  Section Start Here ================== -->
    @if (count($events) > 0)
        <section class="deals-zene-bg ctm-section-margin">
            <div class="container">
                <div class="inner-deals-zene ctm-text-center">
                    <h2>Events</h2>
                    <p class="ctm-mt-20">Stay Updated on the Latest Events</p>
                </div>
                <div class="deals-zene-slider ctm-mt-50">
                    @foreach ($events as $event)
                        <div class="deals-zene-counter-bg  ">
                            <div class="deals-zene-counter-left">
                                <div class="inner-all-shop-new-arrivals-box">
                                    <div class="shop-new-arrivals-image">
                                        <a href="{{ url('event') }}/{{ $event->alias }}" title="Benderloin officia">
                                            <img src="{{ $event->image }}" alt="{{ $event->imagealt }}">
                                            <div class="drumstick-cart-sec">
                                                {{-- <ul class="ctm-flex-row">
                                                    <li><button type="button" class="ctm-white-color"><i
                                                                class="fa fa-heart"></i></button></li>
                                                    <li><button type="button" class="ctm-white-color"><i
                                                                class="fa fa-search"></i></button></li>
                                                </ul> --}}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="deals-zene-counter-right">
                                <h5><a href="#" title="Benderloin officia">{{ $event->name }}</a></h5>
                                <p class="ctm-mt-10">
                                    {!! \Illuminate\Support\Str::words($event->introduction, 30, '...') !!}</p>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">Ticket available :
                                        {{ $event->tickets_available }}</span>
                                    {{-- <span class="old-price-del">$65.00</span> --}}
                                </div>
                                <div class="five-star ctm-mt-10">
                                    <p>Audience Type : {{ $event->audience_type }}</p>
                                </div>
                                @php
                                    $eventDateTime = $event->startdate . ' ' . $event->eventtime;
                                @endphp
                                <div class="countdown-section ctm-mt-30">
                                    <div class="cound-doun-time">
                                        <div id="timer" class="inner-cound-doun-time">
                                            <div class="days"></div>
                                            <div class="hours"></div>
                                            <div class="minutes"></div>
                                            <div class="seconds"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-button">
                                    @if (!empty($event->read_more_link))
                                        <a class="btn-gray-custom-bg common-primary-button "
                                            href="{{ $event->read_more_link }}">Read More</a>
                                    @endif
                                    @if (!empty($event->read_more_link))
                                        <a class=" btn-gray-custom-bg common-primary-button" href="#">Book Now</a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- ================== Events Section End Here ================== -->
    <!-- ================== feature products Section Start Here ================== -->
    {{-- <section class="future-product-tabs-bg ctm-section-margin">
        <div class="container">
            <div class="inner-future-product-tabs ctm-text-center">
                <h2>feature products</h2>
                <p class="ctm-mt-20">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="clothers-tabs-bg ctm-mt-50">
                <div class="future-clothers-tab-menu">
                    <ul class="ctm-flex-row ctm-justify-content-center custom-tabs">
                        <li class="tab-link current" data-id="tab-1"><a href="#!"
                                class="future-clothers-tab-a">Clothers</a></li>
                        <li class="tab-link" data-id="tab-2"><a href="#!" class="future-clothers-tab-a">Kids</a>
                        </li>
                        <li class="tab-link" data-id="tab-3"><a href="#!" class="future-clothers-tab-a">Mens</a>
                        </li>
                        <li class="tab-link" data-id="tab-4"><a href="#!" class="future-clothers-tab-a">Womens</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content current" id="tab-1" data-id="tab-1">
                    <div class="all-shop-new-arrivals future-product-tabs-slider">
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Drum stick tempo">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                        alt="Drum stick tempo">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -21% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo1</a>
                                </h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$60.00</span>
                                    <span class="old-price-del">$65.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Boudin porkbell">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                        alt="Boudin porkbell">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -28% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell </a></h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$60.00</span>
                                    <span class="old-price-del">$65.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Benderloin officia">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                        alt="Benderloin officia">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -42% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                                </h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$55.00</span>
                                    <span class="old-price-del">$60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Balltip nullaelit">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                        alt="Balltip nullaelit">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -20% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a>
                                </h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$60.00</span>
                                    <span class="old-price-del">$65.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Drum stick tempo">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                        alt="Drum stick tempo">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -27% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo</a>
                                </h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$60.00</span>
                                    <span class="old-price-del">$65.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Boudin porkbell">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                        alt="Boudin porkbell">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -17% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell</a></h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$60.00</span>
                                    <span class="old-price-del">$65.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Benderloin officia">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                        alt="Benderloin officia">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -4% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                                </h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$55.00</span>
                                    <span class="old-price-del">$60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner-all-shop-new-arrivals-box">
                            <div class="shop-new-arrivals-image">
                                <a href="#" title="Balltip nullaelit">
                                    <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                        alt="Balltip nullaelit">
                                    <div class="drumstick-cart-sec">
                                        <ul class="ctm-flex-row">
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-shopping-cart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-search"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="label-product-sale">
                                        <span> -28% </span>
                                    </div>
                                </a>
                            </div>
                            <div class="shop-new-arrivals-content">
                                <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a>
                                </h5>
                                <div class="product-price-sec ctm-mt-10">
                                    <span class="price-text ctm-secondary-color">$60.00</span>
                                    <span class="old-price-del">$65.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="tab-2" data-id="tab-2">
                <div class="all-shop-new-arrivals future-product-tabs-slider">
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Drum stick tempo">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                    alt="Drum stick tempo">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -21% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo2</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Boudin porkbell">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                    alt="Boudin porkbell">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -28% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Benderloin officia">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                    alt="Benderloin officia">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -42% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$55.00</span>
                                <span class="old-price-del">$60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Balltip nullaelit">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                    alt="Balltip nullaelit">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -20% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Drum stick tempo">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                    alt="Drum stick tempo">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -27% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Boudin porkbell">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                    alt="Boudin porkbell">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -17% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Benderloin officia">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                    alt="Benderloin officia">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -4% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$55.00</span>
                                <span class="old-price-del">$60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Balltip nullaelit">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                    alt="Balltip nullaelit">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -28% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="tab-3" data-id="tab-3">
                <div class="all-shop-new-arrivals future-product-tabs-slider">
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Drum stick tempo">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                    alt="Drum stick tempo">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -21% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo3</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Boudin porkbell">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                    alt="Boudin porkbell">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -28% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Benderloin officia">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                    alt="Benderloin officia">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -42% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$55.00</span>
                                <span class="old-price-del">$60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Balltip nullaelit">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                    alt="Balltip nullaelit">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -20% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Drum stick tempo">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                    alt="Drum stick tempo">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -27% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Boudin porkbell">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                    alt="Boudin porkbell">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -17% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Benderloin officia">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                    alt="Benderloin officia">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -4% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$55.00</span>
                                <span class="old-price-del">$60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Balltip nullaelit">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                    alt="Balltip nullaelit">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -28% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="tab-4" data-id="tab-4">
                <div class="all-shop-new-arrivals future-product-tabs-slider">
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Drum stick tempo">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                    alt="Drum stick tempo">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -21% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo4</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Boudin porkbell">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                    alt="Boudin porkbell">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -28% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Benderloin officia">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                    alt="Benderloin officia">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -42% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$55.00</span>
                                <span class="old-price-del">$60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Balltip nullaelit">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                    alt="Balltip nullaelit">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -20% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Drum stick tempo">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs1.jpg"
                                    alt="Drum stick tempo">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -27% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Drum stick tempo">Drum stick tempo</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Boudin porkbell">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs2.jpg"
                                    alt="Boudin porkbell">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -17% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Boudin porkbell">Boudin porkbell</a></h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Benderloin officia">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs3.jpg"
                                    alt="Benderloin officia">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -4% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Benderloin officia">Benderloin officia</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$55.00</span>
                                <span class="old-price-del">$60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="inner-all-shop-new-arrivals-box">
                        <div class="shop-new-arrivals-image">
                            <a href="#" title="Balltip nullaelit">
                                <img src="{{ asset('images/theme-images') }}/future-product-tabs4.jpg"
                                    alt="Balltip nullaelit">
                                <div class="drumstick-cart-sec">
                                    <ul class="ctm-flex-row">
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-shopping-cart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-heart"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-search"></i></button></li>
                                        <li><button type="button" class="ctm-white-color"><i
                                                    class="fa fa-refresh"></i></button></li>
                                    </ul>
                                </div>
                                <div class="label-product-sale">
                                    <span> -28% </span>
                                </div>
                            </a>
                        </div>
                        <div class="shop-new-arrivals-content">
                            <h5 class="ctm-mt-20"><a href="#" title="Balltip nullaelit ">Balltip nullaelit</a>
                            </h5>
                            <div class="product-price-sec ctm-mt-10">
                                <span class="price-text ctm-secondary-color">$60.00</span>
                                <span class="old-price-del">$65.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section> --}}
    <!-- ================== feature products Section End Here ================== -->
    <!-- ================== Main Section End Here ================== -->
    <!-- ================== Aside Section Start Here ================== -->
    <!-- ================== From the blog Section Start Here ================== -->
    @if (count($blogs) > 0)
        <section class="social-media-post-bg ctm-section-margin">
            <div class="container">
                <div class="inner-social-media-post ctm-flex-row ctm-justify-content-between ">
                    @if (count($featured_blogs) > 0)
                        <div class="social-media-post-left ctm-text-center">
                            <div class="social-media-post-content">
                                <h2>Featured</h2>
                                <p class="ctm-mt-20">Use <a href="#"
                                        title="Nova">#{{ $title ?? sc_store('title') }}</a> for a chance to be
                                    featured.</p>
                            </div>
                            <div class="social-media-post-slider ctm-mt-40">
                                @foreach ($featured_blogs as $featured_blog)
                                    <div class="inner-social-media-post-slider">
                                        <a href="#" title="Instagram Post">
                                            <div class="social-media-post-slider-image">
                                                {{-- <img src="{{ asset('images/theme-images') }}/social-media-post-slider1.jpg" alt="Instagram Post"> --}}
                                                <img src="{{ $featured_blog->image }}"
                                                    alt="{{ $featured_blog->imagealt }}">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="social-media-post-content-para ctm-mt-30 ctm-text-center">
                                <p>Every pair of jeans needs something great to go with them. And wr’ve got it all.</p>
                                <div class="view-gallery-btn ctm-mt-20">
                                    <a href="{{ url('blog') }}" title="View gallery">View All</a>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if (count($blogs) > 0)
                        <div class="social-media-post-right">
                            <div class="social-media-post-content ctm-text-center">
                                <h2>From the blog</h2>
                                <p class="ctm-mt-20">Explore popular blogs that inspire, educate, and entertain.</p>
                            </div>
                            <div class="inner-social-media-post-right ctm-mt-40">
                                <div class="social-media-post-slider">
                                    @foreach ($blogs as $blog)
                                        <div class="inner-social-media-post-slider">
                                            <a href="#" title="Instagram Post">
                                                <div class="social-media-post-slider-image">
                                                    <img src="{{ $blog->image }}" alt="{{ $blog->imagealt }}">
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="media-date-added-post">
                                    <div class="date-added">{{ date('d', strtotime($blog->created_at)) }}</div>
                                    <div class="moth-added">{{ date('M', strtotime($blog->created_at)) }}</div>
                                </div>
                            </div>
                            <div class="social-media-post-content-para ctm-mt-30 ctm-text-center">
                                <p>Every pair of jeans needs something great to go with them. And wr’ve got it all.</p>
                                <div class="view-gallery-btn ctm-mt-20">
                                    <a href="{{ url('blog') }}" title="View gallery">View all</a>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </section>
    @endif

    <!-- ================== From the blog Section End Here ================== -->
    <section class="about-us">
        <div class="container">
            <div class="about-us-inner">
                <div class="about-us-content">
                    <div class="left-section about-img">
                        <img src="{{ asset($homedata->aboutus_img1) }}" alt="<?php echo $homedata->aboutus_img1_alt; ?>">
                        <img src="{{ asset($homedata->aboutus_img2) }}" alt="<?php echo $homedata->aboutus_img2_alt; ?>">
                    </div>
                    <div class="right-section about-text">
                        <?php echo $homedata->aboutus; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-banner" style="background-image: url('{{ asset($homedata->savejob_bg) }}');">
        <div class="container">
            <div class="about-banner-inner">
                <div class="about-banner-content">
                    <?php echo $homedata->savejob; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="image-gallery">
        <div class="container">
            <div class="image-gallery-inner">
                <div class="gallery">
                    <div class="img-left">
                        <div class="imgl-col-1">
                            <img src="{{ asset($homedata->gallary_img1) }}" alt="{{ $homedata->gallary_img1_alt }}">
                        </div>
                        <div class="imgl-col-2">
                            <img src="{{ asset($homedata->gallary_img2) }}" alt="{{ $homedata->gallary_img2_alt }}">
                            <img src="{{ asset($homedata->gallary_img3) }}" alt="{{ $homedata->gallary_img3_alt }}">
                        </div>
                    </div>
                    <div class="img-right">
                        <div class="imgr-col-1">
                            <img src="{{ asset($homedata->gallary_img4) }}" alt="{{ $homedata->gallary_img4_alt }}">
                            <img src="{{ asset($homedata->gallary_img5) }}" alt="{{ $homedata->gallary_img5_alt }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="testimonial-sec" style="background-image: url('{{ asset($testtitle->image) }}');">
        <div class="container">
            <div class="happy-client">

                <?php if ($testtitle->name) {
                    echo '<p>' . $testtitle->name . '</p>';
                }
                if ($testtitle->subtitle) {
                    echo '<h2>' . $testtitle->subtitle . '</h2>';
                }
                ?>


            </div>
            <div class="testimonial-slide testimonial-slider">
                <?php $slid=0; foreach($testimonial as $slide) {
          $slid++;
        $position = App\Models\TestimonialPosition::GetPosition($slide->position);  ?>
                <div class="t-content">
                    <p class="text-area" data-controller="#readMore{{ $slid }}">
                        <?php echo $slide->content; ?></p>
                    <a href="javascript:void(0);" id="readMore{{ $slid }}">Read More</a>
                    <div class="t-image">
                        <div class="tc-img">
                            <img src="{{ asset($slide->image) }}" alt="{{ $slide->image_alt }}">
                        </div>
                        <div class="tc-title">
                            <h3>{{ $slide->name }}</h3>
                            <span>{{ $position->name }}</span>
                        </div>
                    </div>
                </div>
                <?php } ?>


            </div>
        </div>
    </section>

    <?php if($homedata->testimonial) { ?>
    <section class="meet-team-sec">
        <div class="container">

            <h2> Meet the Team</h2>
            <div class="meet-team-slide team-slider">
                <?php  foreach($team as $user) {
          $role = App\Admin\Models\AdminUser::getRole($user->id);
        $position = App\Admin\Models\AdminUser::getPosition($role->role_id); ?>


                <div class="team-content">

                    <div class="team-image">
                        <div class="tc-img">
                            <img src="<?php if ($user->avatar) {
                                echo asset($user['avatar']);
                            } else {
                                echo asset('images/index.jpg');
                            } ?>">
                        </div>
                        <div class="tc-title">
                            <h3>{{ $user->salutation }} {{ $user->name }} <?php echo ' ' . $user->last_name; ?></h3>
                            <span><?php if ($position) {
                                echo $position->name;
                            } ?></span>
                        </div>
                        <div class="brief">
                            <p><?php echo $user->brief; ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>


            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(count($footerNews) >=1) { 
         $newsData = App\Models\HeaderMenu::getMenu(2);
         if($newsData->status) { ?>

    <section class="news">
        <div class="container">
            <div class="news-inner">
                <h2>{{ $homedata->norder }} <span>{{ $newsData->name }}</span></h2>
                <div class="news-content">
                    <?php $ncnt =0; foreach($footerNews as $news) { 
          $ncnt++;?>
                    <div class="featured-news news-{{ $ncnt }}">
                        <div class="news-img">
                            <a href="{{ url('news') }}/{{ $news->alias }}"><img src="{{ asset($news->image) }}"
                                    alt="accommodation"></a>
                        </div>
                        <div class="news-details">
                            <h5>{{ $news->name }}</h5>
                            <p> <?php echo $news->introduction; ?> </p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } }?>

    <?php if(count($footerProduct) >=1) {
 $prodData = App\Models\HeaderMenu::getMenu(1);
  if($prodData->status) { ?>

    <section class="news">
        <div class="container">
            <div class="news-inner">
                <h2>{{ $homedata->proorder }} <span>{{ $prodData->name }}</span></h2>
                <div class="news-content">
                    <?php $ncnt =0; foreach($footerProduct as $news) { 
          $ncnt++;?>
                    <div class="featured-news news-{{ $ncnt }}">
                        <div class="news-img">
                            <a href="{{ url('product') }}/{{ $news->alias }}.php"><img src="{{ asset($news->image) }}"
                                    alt="accommodation"></a>
                        </div>
                        <div class="news-details">
                            <h5>{{ $news->name }}</h5>
                            <p> <?php echo $news->introduction; ?> </p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } }?>

    <?php if(count($footerProperty) >=1) {
$proData = App\Models\HeaderMenu::getMenu(4); 
 if($proData->status) {?>

    <section class="news">
        <div class="container">
            <div class="news-inner">
                <h2>{{ $homedata->porder }} <span>{{ $proData->name }}</span></h2>
                <div class="news-content">
                    <?php $ncnt =0; foreach($footerProperty as $news) { 
          $ncnt++;?>
                    <div class="featured-news news-{{ $ncnt }}">
                        <div class="news-img">
                            <a href="{{ url('property') }}/{{ $news->alias }}"><img src="{{ asset($news->image) }}"
                                    alt="accommodation"></a>
                        </div>
                        <div class="news-details">
                            <h5>{{ $news->name }}</h5>
                            <p> <?php echo $news->introduction; ?> </p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } }?>

    <?php if(count($footerAccommmo) >=1) {
$accData = App\Models\HeaderMenu::getMenu(5); 
 if($accData->status) {?>

    <section class="news">
        <div class="container">
            <div class="news-inner">
                <h2>{{ $homedata->accorder }} <span>{{ $accData->name }}</span></h2>
                <div class="news-content">
                    <?php $ncnt =0; foreach($footerAccommmo as $news) { 
          $ncnt++;?>
                    <div class="featured-news news-{{ $ncnt }}">
                        <div class="news-img">
                            <a href="{{ url('accommodation') }}/{{ $news->alias }}"><img
                                    src="{{ asset($news->image) }}" alt="accommodation"></a>
                        </div>
                        <div class="news-details">
                            <h5>{{ $news->name }}</h5>
                            <p> <?php echo $news->introduction; ?> </p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } }?>


    <?php if(count($footerService) >=1) { 
  $servData = App\Models\HeaderMenu::getMenu(3);
   if($servData->status) {?>

    <section class="news">
        <div class="container">
            <div class="news-inner">
                <h2>{{ $homedata->sorder }} <span>{{ $servData->name }}</span></h2>
                <div class="news-content">
                    <?php $ncnt =0; foreach($footerService as $news) { 
          $ncnt++;?>
                    <div class="featured-news news-{{ $ncnt }}">
                        <div class="news-img">
                            <a href="{{ url('services') }}/{{ $news->alias }}"><img src="{{ asset($news->image) }}"
                                    alt="accommodation"></a>
                        </div>
                        <div class="news-details">
                            <h5>{{ $news->name }}</h5>
                            <p> <?php echo $news->introduction; ?> </p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } }?>

    <?php if(count($footerPort) >=1) { 
  $portData = App\Models\HeaderMenu::getMenu(12);
   if($portData->status) {?>

    <section class="news">
        <div class="container">
            <div class="news-inner">
                <h2>{{ $homedata->portorder }} <span>{{ $portData->name }}</span></h2>
                <div class="news-content">
                    <?php $ncnt =0; foreach($footerPort as $port) { 
          $ncnt++;?>
                    <div class="featured-news news-{{ $ncnt }}">
                        <div class="news-img">
                            <a href="{{ url('portfolio') }}/{{ $port->alias }}"><img src="{{ asset($port->image) }}"
                                    alt="portfolio"></a>
                        </div>
                        <div class="news-details">
                            <h5>{{ $port->name }}</h5>
                            <p> <?php echo $port->introduction; ?> </p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } }?>

    <?php if(count($footerBlog) >=1) { 
  $blogData = App\Models\HeaderMenu::getMenu(13);
   if($blogData->status) {?>

    <section class="news">
        <div class="container">
            <div class="news-inner">
                <h2>{{ $homedata->blogorder }} <span>{{ $blogData->name }}</span></h2>
                <div class="news-content">
                    <?php $ncnt =0; foreach($footerBlog as $blg) { 
          $ncnt++;?>
                    <div class="featured-news news-{{ $ncnt }}">
                        <div class="news-img">
                            <a href="{{ url('blog') }}/{{ $blg->alias }}"><img src="{{ asset($blg->image) }}"
                                    alt="{{ $blg->imagealt }}"></a>
                        </div>
                        <div class="news-details">
                            <h5>{{ $blg->name }}</h5>
                            <p> <?php echo $blg->introduction; ?> </p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } }?>




    <?php /*
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">{{ trans('front.features_items') }}</h2>
                @foreach ($products_new as  $key => $product_new)
                  <div class="col-sm-4">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products product-box-{{ $product_new->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_new->getUrl() }}"><img src="{{ asset($product_new->getThumb()) }}" alt="{{ $product_new->name }}" /></a>
                            {!! $product_new->showPrice() !!}
                            <a href="{{ $product_new->getUrl() }}"><p>{{ $product_new->name }}</p></a>

                            @if ($product_new->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product_new->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif

                          </div>
                      @if ($product_new->price != $product_new->getFinalPrice() && $product_new->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product_new->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product_new->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a onClick="addToCartAjax('{{ $product_new->id }}','wishlist')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_wishlist')}}</a></li>
                          <li><a onClick="addToCartAjax('{{ $product_new->id }}','compare')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_compare')}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
               @endforeach
          </div><!--features_items-->

          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">{{ trans('front.products_hot') }}</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                @foreach ($products_hot as  $key => $product_hot)
                @if ($key % 3 == 0)
                  <div class="item {{  ($key ==0)?'active':'' }}">
                @endif
                  <div class="col-sm-4">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products   product-box-{{ $product_hot->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_hot->getUrl() }}"><img src="{{ asset($product_hot->getThumb()) }}" alt="{{ $product_hot->name }}" /></a>
                            {!! $product_hot->showPrice() !!}
                            <a href="{{ $product_hot->getUrl() }}"><p>{{ $product_hot->name }}</p></a>
                            @if ($product_hot->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product_hot->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product_hot->price != $product_hot->getFinalPrice() && $product_hot->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif

                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','wishlist')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_wishlist')}}</a></li>
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','compare')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_compare')}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                @if ($key % 3 == 2 || $key+1 == $products_hot->count())
                  </div>
                @endif
               @endforeach

              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
            </div>
          </div><!--/recommended_items-->

          <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#cate1" data-toggle="tab">{{ trans('front.products_build') }}</a></li>
                  <li><a href="#cate2" data-toggle="tab">{{ trans('front.products_group') }}</a></li>
              </ul>
            </div>
            <div class="tab-content">

                <div class="tab-pane fade active in" id="cate1" >
                  @foreach ($products_build as $product)
                    <div class="col-sm-3">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
              </div>
                <div class="tab-pane fade" id="cate2" >
                  @foreach ($products_group as $product)
                    <div class="col-sm-3">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
                </div>
          </div><!--/category-tab-->
*/
    ?>
    <?php
 $newsData = App\Models\HeaderMenu::getMenu(2);
 if($newsData->status){     
  if(count($footerNews) >=1) {
 $sa_news = App\Models\Blog::getSANews();  

   ?>

    <?php  if(count($sa_news) >=1) { ?>

    <section class="blog">
        <div class="container">
            <div class="blog-inner">
                <h2><span>{{ $newsData->name }}<br></span>Latest {{ $newsData->name }} &amp; Updates from
                    {{ sc_store('title') }} </h2>

                <div class="blog-content">
                    <?php $snc=0;
        foreach($sa_news as $news) {
          $snc++; ?>
                    <div class="blogs blog-1">
                        <div class="blog-img">
                            <a href="{{ url('news') }}/{{ $news->alias }}"><img src="{{ asset($news->image) }}"
                                    alt="{{ $news->imagealt }}"></a>
                            <div class="date-tag">
                                <p><?php echo date('M d Y', strtotime($news->startdate)); ?></p>
                            </div>
                        </div>
                        <div class="blog-details">
                            <h6>{{ $news->name }}</h6>
                            <p><?php echo $news->introduction; ?></p>
                            <a href="{{ url('news') }}/{{ $news->alias }}">read more</a>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>

        </div>
    </section>
    <?php } } }
if(!empty($admin)) {
      if($admin->role==1) { ?>
    <div class="edit-post-link">
        <a target="_blank" href="{{ route('admin_homecontent.edit', ['id' => $homedata->id]) }}">Edit post</a>
    </div>

    <?php } } ?>
@endsection



@push('styles')
@endpush

@push('scripts')
    <script>
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
    </script>
    <script>
        $('.testimonial-slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            adaptiveHeight: true,
            autoplay: true,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
    <script>
        // Get event date-time from PHP and convert it to JavaScript Date object
        let eventDateTime = new Date("{{ $eventDateTime }}").getTime();

        function updateCountdown() {
            let now = new Date().getTime();
            let timeLeft = eventDateTime - now;

            if (timeLeft > 0) {
                let days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                let hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                document.querySelector(".days").innerText = days + "d";
                document.querySelector(".hours").innerText = hours + "h";
                document.querySelector(".minutes").innerText = minutes + "m";
                document.querySelector(".seconds").innerText = seconds + "s";
            } else {
                document.getElementById("timer").innerHTML = "<p>Event Started</p>";
                clearInterval(countdownInterval);
            }
        }

        // Run the function every second
        let countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
@endpush
