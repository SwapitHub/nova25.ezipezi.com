@extends($templatePath . '.shop_layout')

@section('center')
    <?php $pageData = App\Models\HeaderMenu::getMenu(12);
    if ($pageData->image) {
        $image = $pageData->image;
    } else {
        $image = $templateFile . '/images/home/product-listing-bg.png';
    } ?>
    <section class="banner_product-listing" style="background-image: url('{{ asset($image) }}');">
        <div class="container">
            <div class="banner-inner">
                <div class="banner-innerpage-content">

                </div>
            </div>
        </div>
    </section>


    <section class="listing-form-search">
        <div class="container">
            <div class="left-column">
                <p><b>{{ $pageData->name }} |</b> | Latest {{ $pageData->name }}</p>
                <div class="wine-list-type">
                    <?php $stypes = App\Models\Portfolio::getHeaderCats();
           if(count($stypes) >=1) {
           	foreach($stypes as $dd) {
           		$count = App\Models\Portfolio::catCount($dd->portfoliotype);
                     $type = App\Models\PortfolioType::getSingleCat($dd->portfoliotype) ?>
                    <a href="{{ url('portfolio/search') }}?portfoliotype={{ $dd->portfoliotype }}"><b>{{ $type->name }}
                        </b>({{ $count }})</a>
                    <?php } } ?>

                </div>
            </div>
            <div class="right-column">

                <div class="form-2">
                    <h4>{{ $pageData->name }} search</h4>
                    <form id="searchbox" method="get" action="{{ url('portfolio/search') }}" class="search-product">
                        <div class="product-type">
                            <label for="type">{{ $pageData->name }} type</label>
                            <select name="portfoliotype" class="portfoliotype">
                                <option value="">Choose type</option>
                                <?php $stypes = App\Models\Portfolio::getHeaderCats();
                            if(count($stypes) >=1) { 
                           foreach($stypes as $dd) {
                            $type = App\Models\PortfolioType::getSingleCat($dd->portfoliotype) ?>
                                <option value="{{ $type->id }}" <?php if (isset($_GET['portfoliotype'])) {
                                    if ($_GET['portfoliotype'] == $type->id) {
                                        echo 'selected';
                                    }
                                } ?>>
                                    {{ $type->name }}</option>
                                <?php }  } ?>
                            </select>
                        </div>
                        <div class="product-category">
                            <label for="category">{{ $pageData->name }} Name</label>
                            <input type="text" name="name" value="">
                        </div>
                        <div class="search-input-btn">
                            <label for="">&nbsp;</label>
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="special-offer-box-one main-content-section">
        <div class="container">
            <div class="filter-tab-sec">
                <div class="filter-tab-inner">
                    <div class="d-flex-custom filter-tab-column">
                        <div class="thirty-col filter-tab-col-left-shop-by">
                            <div class="btn btn-gridview">Grid View:</div>
                            <ul class="tabsfilter-on-shop-by">
                                <li class="tab-link" data-tab="filtertab-1"><span><i class="fa-solid fa-list"></i></span>
                                </li>
                                <li class="tab-link" data-tab="filtertab-2"><span><i class="fa-solid fa-table"></i></span>
                                </li>
                            </ul>
                        </div>

                        <div class="seventy-col filter-tab-right-col-shop-by">
                            <div class="form-group short-by">
                                <label class="control-label" for="input-sort">Sort By:</label>
                                <select id="input-sort" class="form-control" onchange="location = this.value;">
                                    <option selected="selected">Featured</option>
                                    <option>Latest</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-limit">Show:</label>
                                <select id="input-limit" class="form-control" onchange="location = this.value;">
                                    <option>15</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>75</option>
                                    <option>100</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="filter-content-tab">
                        {{-- list tab start --}}
                        <div id="filtertab-1" class="tab-content">
							@foreach ($feturedList as $fetured)
							<div class="filter-list-design-inner">
                                <div class="filter-list-left-col">
                                    <div class="inner-all-shop-new-arrivals-box">
                                        <div class="shop-new-arrivals-image">
                                            <a href="#" title="Drumstick bresao">
                                                <img src="{{ $fetured->image }}" alt="{{ $fetured->imagealt }}">
                                            </a>
                                            <div class="box-label">
                                                <span class="label-product label-sale">-8%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-list-right-column">
                                    <h4><a href="#">{{ $fetured->name }}</a></h4>
                                    <div class="rate-history">
                                        <div class="ratings">
                                            <div class="rating-box">
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                        class="fa fa-star-o fa-stack-1x"></i></span>
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                        class="fa fa-star-o fa-stack-1x"></i></span>
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                        class="fa fa-star-o fa-stack-1x"></i></span>
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                        class="fa fa-star-o fa-stack-1x"></i></span>
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                        class="fa fa-star-o fa-stack-1x"></i></span>
                                                <a class="rating-num" href="#">(1)</a>
                                            </div>
                                        </div>
                                        {{-- <div class="price">
                                            <span class="price">$87.00 </span>
                                        </div> --}}
                                        <p>
											{!! \Illuminate\Support\Str::words($fetured->introduction, 30, '...') !!}
                                        </p>
                                    </div>
                                    <div class="drumstick-cart-sec  drumstick-cart-sec-on-filter">
                                        <ul class="ctm-flex-row">
                                            <button class="addToCart" type="button" title="Add to Cart"
                                                onclick="cart.add('110', '1');"><span>Add to Cart</span></button>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-heart"></i></button></li>
                                            <li><button type="button" class="ctm-white-color"><i
                                                        class="fa fa-refresh"></i></button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
							@endforeach
                        </div>
                        {{-- grid tab start --}}
                        <div id="filtertab-2" class="tab-content current">
                            <div class="d-flex-custom tab-two-col-inner">
								@foreach ($feturedList as $fetured)
								<div class="four-col tab-two-col">
                                    <div class="inner-all-shop-new-arrivals-box">
                                        <div class="shop-new-arrivals-image">
                                            <a href="#" title="Drumstick bresao">
                                                <img src="{{ $fetured->image }}" alt="{{ $fetured->imagealt }}">
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
                                            </a>
                                            {{-- <div class="box-label">
                                                <span class="label-product label-sale">-8%</span>
                                            </div> --}}
                                        </div>
                                        <div class="shop-new-arrivals-content">
                                            <h5 class="ctm-mt-20"><a href="#" title="Drumstick bresao">{{ $fetured->name }}</a></h5>
                                            <div class="product-price-sec ctm-mt-10">
                                                <span class="price-text ctm-secondary-color">$60.00</span>
                                                <span class="old-price-del">$65.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								@endforeach        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('styles')
@endpush
@push('scripts')
@endpush
