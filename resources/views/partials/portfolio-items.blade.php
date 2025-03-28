@foreach ($portfolios as $portfolio)
    <div class="filter-list-design-inner">
        <div class="filter-list-left-col">
            <div class="inner-all-shop-new-arrivals-box">
                <div class="shop-new-arrivals-image">
                    <a href="#" title="{{ $portfolio->name }}">
                        <img src="{{ $portfolio->image }}" alt="{{ $portfolio->imagealt }}">
                    </a>
                </div>
            </div>
        </div>
        <div class="filter-list-right-column">
            <h4><a href="#">{{ $portfolio->name }}</a></h4>
            <p>{!! \Illuminate\Support\Str::words($portfolio->introduction, 30, '...') !!}</p>
        </div>
    </div>
@endforeach