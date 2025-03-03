@extends($templatePath.'.shop_layout')

@section('center')

<?php $pageData = App\Models\HeaderMenu::getMenu(3);
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
                <form id="searchbox" method="get" action="{{ url('services/search') }}" class="search-product">
                    <div class="product-type">
                        <label for="type">{{ $pageData->name }} type</label>
                        <select name="servicetype"  class="servicetype">
                            <option value="">Choose type</option>
                           <?php $stypes = App\Models\Service::getHeaderCats();
                            if(count($stypes) >=1) { 
                           foreach($stypes as $dd) {
                            $type = App\Models\ServiceType::getSingleCat($dd->servicetype) ?>
                              <option value="{{ $type->id }}" <?php if(isset($_GET['servicetype'])) { if($_GET['servicetype']==$type->id) echo "selected"; }  ?> >
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


 <section class="accomo_listing service-page">
    <div class="container">
        <div class="accomo_listing-inner">
            <div class="accomo_listing-box">
            @if (count($services) ==0)
                {{ trans('No service') }}
              @else
                  @foreach ($services as  $service )
               <a href="{{ url('services') }}/{{$service->alias}}" class="single-accomo-main col-md-4 col-sm-6 col-xs-12">
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
                  {{ $services->appends(request()->except(['page','_token']))->links() }}
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
