@foreach ($portfolios as $portfolio)
    <div class="four-col tab-two-col">
        <div class="inner-all-shop-new-arrivals-box">
            <div class="shop-new-arrivals-image">
                <a href="#" title="{{ $portfolio->name }}">
                    <img src="{{ $portfolio->image }}" alt="{{ $portfolio->imagealt }}">
                    <div class="drumstick-cart-sec">
                        <ul class="ctm-flex-row">
                            <li><button type="button" class="ctm-white-color"><i class="fa fa-shopping-cart"></i></button></li>
                            <li><button type="button" class="ctm-white-color"><i class="fa fa-heart"></i></button></li>
                            <li><button type="button" class="ctm-white-color"><i class="fa fa-search"></i></button></li>
                            <li><button type="button" class="ctm-white-color"><i class="fa fa-refresh"></i></button></li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="shop-new-arrivals-content">
                <h5 class="ctm-mt-20"><a href="#" title="{{ $portfolio->name }}">{{ $portfolio->name }}</a></h5>
            </div>
        </div>
    </div>
@endforeach
