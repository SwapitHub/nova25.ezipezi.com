@extends($templatePath.'.shop_layout')

@section('center')
<?php $pageData = App\Models\HeaderMenu::getMenu(1);
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

             
                <form id="searchbox" method="get" action="{{ route('search') }}" class="search-product">
                    <div class="product-type">
                        <label for="type">{{ $pageData->name }} type</label>
                        <select name="protype"  class="protype">
                            <option value="">Choose type</option>
                           <?php  $protypes = App\Models\ShopProduct::getHeaderCats();
                            if(count($protypes) >=1) {
                           foreach($protypes as $dd) { 
                            $type = App\Models\ProType::catByid($dd->protype);?>
                              <option value="{{ $type->id }}" <?php if(isset($_GET['protype'])) { if($_GET['protype']==$type->id) echo "selected"; }  ?> >
                                  {{ $type->name  }}</option>
                              <?php } } ?>
                        </select>
                    </div>
                    <div class="product-category">
                        <label for="category">{{ $pageData->name }} category</label>
                         <select name="procat"  class="procat">
                            <option value="">Choose Category</option>
                            <?php  if(isset($_GET['protype'])) {
                              $types = App\Models\ShopProduct::getSubCats($_GET['protype']);
                            if(count($types) >=1) {
                             foreach($types as $dd) {
                              $type = App\Models\ProCat::getProcat($dd->procat);?>
                              <option value="{{ $type->id }}" <?php if(isset($_GET['procat'])) { if($_GET['procat']==$type->id) echo "selected"; }  ?> >
                                  {{ $type->name  }}</option>
                              <?php } } } ?>
                        </select>
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
 
 <hr class="section-divider">
 
  <div class="features_items">
     <div class="container">
       <div class="product-listing-box">
      @if (count($products) ==0)
        {{ trans('front.empty_product') }}
      @else
          <?php foreach ($products as  $key => $product) {
          $protype = App\Models\ProType::catByid($product->protype);   ?>
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="product-image-wrapper product-single">
                <div class="single-products">
                  <div class="productinfo text-center product-box-{{ $product->id }}">
                   
                      <div class="pro-img">
                       <img src="{{ asset($product->getThumb()) }}" alt="{{ $product->image_alt}}" >
                        @if ($product->allowSale())
                      <div class="view-addcart">
                        <a href="{{ $product->getUrl() }}" class="view-btn">View</a>
                        <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')">
                         <i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}
                       </a>
                      </div>
                      @else
                        &nbsp;
                      @endif
                    </div>          
                   <div class="price-outer">
					           <a href="#" class="brand"><span>{{ $protype->name }}</span></a>
                      <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                      {!! $product->showPrice() !!}
                    </div>

                     
                  </div>
                    
                </div>
               
              </div>
          </div>
          <?php } ?>
      @endif
  </div>
    <div style="clear: both; ">
        <ul class="pagination pagination-outer">
          {{ $products->appends(request()->except(['page','_token']))->links() }}
      </ul>
    </div>
  
    </div>
</div>
@endsection


@section('breadcrumb')
  <!--   <div class="breadcrumbs pull-left">
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">{{ trans('front.home') }}</a></li>
          <li class="active">{{ $title }}</li>
        </ol>
      </div> -->
@endsection

@section('filter')
 <!--  <form action="" method="GET" id="filter_sort">
        <div class="pull-right"> 
        <div>
            @php
              $queries = request()->except(['filter_sort','page']);
            @endphp
            @foreach ($queries as $key => $query)
              <input type="hidden" name="{{ $key }}" value="{{ $query }}">
            @endforeach
          <select class="custom-select" name="filter_sort">
            <option value="">{{ trans('front.filters.sort') }}</option>
            <option value="price_asc" {{ ($filter_sort =='price_asc')?'selected':'' }}>{{ trans('front.filters.price_asc') }}</option>
            <option value="price_desc" {{ ($filter_sort =='price_desc')?'selected':'' }}>{{ trans('front.filters.price_desc') }}</option>
            <option value="sort_asc" {{ ($filter_sort =='sort_asc')?'selected':'' }}>{{ trans('front.filters.sort_asc') }}</option>
            <option value="sort_desc" {{ ($filter_sort =='sort_desc')?'selected':'' }}>{{ trans('front.filters.sort_desc') }}</option>
            <option value="id_asc" {{ ($filter_sort =='id_asc')?'selected':'' }}>{{ trans('front.filters.id_asc') }}</option>
            <option value="id_desc" {{ ($filter_sort =='id_desc')?'selected':'' }}>{{ trans('front.filters.id_desc') }}</option>
          </select>
        </div>
      </div>
  </form> -->

@endsection

@push('styles')
@endpush
@push('scripts')
  <script type="text/javascript">
    $('[name="filter_sort"]').change(function(event) {
      $('#filter_sort').submit();
    });
     $('select.protype').change(function(){
       var type = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ url('product/procats') }}',  
                data: {
                  type:type,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                  $('select.procat').html(data);
                }
            });
    });
  </script>
@endpush
