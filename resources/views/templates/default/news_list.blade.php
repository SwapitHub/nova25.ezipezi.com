@extends($templatePath.'.shop_layout')

@section('center')

<?php $pageData = App\Models\HeaderMenu::getMenu(2);
if($pageData->image) $image =  $pageData->image;
else $image = $templateFile.'/images/home/product-listing-bg.png'; ?>
 <section class="banner_product-listing" style="background-image: url('{{ asset($image) }}');">
    <div class="container">
        <div class="banner-inner">
            <div class="banner-innerpage-content">
                <h2>{{ $pageData->name }}</h2>
            </div>
        </div>
    </div>
</section> 
<div class="product-search">
    <div class="container">
        <div class="product-search-inner">
            <div class="product-search-box">
                <h4>{{ $pageData->name }} search</h4>
                <hr>

             
                <form id="searchbox" method="get" action="{{ url('news/search') }}" class="search-product">
                    <div class="product-type">
                        <label for="type">{{ $pageData->name }} type</label>
                        <select name="newstype"  class="newstype">
                            <option value="">Choose type</option>
                           <?php $vinetypes = App\Models\Blog::getHeaderCats(); 
                 if(count($vinetypes) >=1) { 
                    foreach($vinetypes as $dd) {
                    $type = App\Models\NewsType::getsingleCat($dd->newstype); ?>
                              <option value="{{ $type->id }}" <?php if(isset($_GET['newstype'])) { if($_GET['newstype']==$type->id) echo "selected"; }  ?> >
                                  {{ $type->name  }}</option>
                              <?php } } ?>
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
 </div>


 <section class="accomo_listing services">
    <div class="container">
        <div class="accomo_listing-inner">
            <div class="accomo_listing-box">
            @if (count($news) ==0)
                {{ trans('No news') }}
              @else
                  @foreach ($news as  $pro )
               <a href="{{ url('news') }}/{{$pro->alias}}" class="single-accomo-main col-md-4 col-sm-6 col-xs-12">
                <div class="single-accomo">
                    <div class="accomo-img">
                        <img src="{{ asset($pro->image) }}" alt="{{$pro->imagealt}}">
                    </div>
                    <div class="accomo-title">
                        <p>{{ $pro->name }}</p>
                    </div>
                 </div>
                </a>
                @endforeach
            @endif
            <div style="clear: both; ">
                <ul class="pagination pagination-outer">
                  {{ $news->appends(request()->except(['page','_token']))->links() }}
                </ul>
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
