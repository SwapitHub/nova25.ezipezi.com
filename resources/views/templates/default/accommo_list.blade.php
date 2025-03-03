@extends($templatePath.'.shop_layout')

@section('center')
<?php $pageData = App\Models\HeaderMenu::getMenu(5);
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

             
                <form id="searchbox" method="get" action="{{ route('accommodation.search') }}" class="search-product">
                    <div class="product-type">
                        <label for="type">{{ $pageData->name }} type</label>
                        <select name="acctype"  class="acctype">
                            <option value="">Choose type</option>
                          <?php $acctype = App\Models\Accommodation::getHeaderCats();
                            if(count($acctype) >=1) { 
                                foreach($acctype as $dd) {
                                $type = App\Models\AccommodationType::getSingleCat($dd->accommodationtype); ?>
                              <option value="{{ $type->id }}" <?php if(isset($_GET['acctype'])) { if($_GET['acctype']==$type->id) echo "selected"; }  ?> >
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

<section class="accomo_listing">
    <div class="container">
        <div class="accomo_listing-inner">
            <div class="accomo_listing-box">
            @if (count($accommodation) ==0)
                {{ trans('No accommodation') }}
              @else
                  @foreach ($accommodation as  $acc )
               <a href="{{ url('accommodation') }}/{{$acc->alias}}" class="single-accomo-main col-md-4 col-sm-6 col-xs-12">
                <div class="single-accomo">
                    <div class="accomo-img">
                        <img src="{{ asset($acc->image) }}" alt="{{$acc->imagealt}}">
                    </div>
                    <div class="accomo-title">
                        <p>{{ $acc->name }}</p>
                    </div>
                   
                 </div>
                </a>
                @endforeach
            @endif
            <div style="clear: both; ">
                <ul class="pagination pagination-outer">
                  {{ $accommodation->appends(request()->except(['page','_token']))->links() }}
                </ul>
            </div>
                
            </div>
        </div>
    </div>
</section> 
 
 
 <!--
@endsection


@push('styles')
@endpush
@push('scripts')

@endpush
