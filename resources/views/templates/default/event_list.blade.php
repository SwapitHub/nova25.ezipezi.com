@extends($templatePath.'.shop_layout')

@section('center')

<?php $pageData = App\Models\HeaderMenu::getMenu(14);
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
                <form id="searchbox" method="get" action="{{ url('event/search') }}" class="search-product">
                    <div class="product-type">
                        <label for="type">{{ $pageData->name }} type</label>
                        <select name="eventtype"  class="eventtype">
                            <option value="">Choose type</option>
                           <?php 
                           $stypes = App\Models\Event::getHeaderCats();
                            if(count($stypes) >=1) { 
                           foreach($eventtype as $dd) {
                            $type = App\Models\EventType::getSingleCat($dd->eventtype) ?>
                    
                              <option value="{{ $type->id }}" <?php if(isset($_GET['eventtype'])) { if($_GET['eventtype']==$type->id) echo "selected"; }  ?> >
                                  {{ $type->name  }}</option>
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
 </div>


 <section class="accomo_listing portfolio-page">
    <div class="container">
        <div class="accomo_listing-inner">
            <div class="accomo_listing-box">
            @if (count($event) ==0)
                {{ trans('No Events') }}
              @else
                  @foreach ($event as  $service )
               <a href="{{ url('event') }}/{{$service->alias}}" class="single-accomo-main col-md-4 col-sm-6 col-xs-12">
                <div class="single-accomo">
                    <div class="accomo-img">
                        <img src="{{ asset($service->image) }}" alt="{{$service->imagealt}}">
                    </div>
                    <div class="accomo-title">
                        <p>{{ $service->name }}</p>
                    </div>
                 </div>
                </a>
                @endforeach
            
            <div style="clear: both; ">
                <ul class="pagination pagination-outer">
                  {{ $event->appends(request()->except(['page','_token']))->links() }}
                </ul>
            </div>
            @endif
            </div>
        </div>
    </div>
</section>

@endsection


@push('styles')
@endpush
@push('scripts')

@endpush
