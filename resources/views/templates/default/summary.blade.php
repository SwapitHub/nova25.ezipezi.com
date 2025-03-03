@extends($templatePath.'.shop_layout')

@section('center')
<?php $pageData = App\Models\HeaderMenu::getMenu(1);
if($pageData->image) $image =  $pageData->image;
else $image = $templateFile.'/images/home/product-listing-bg.png';
 $newsData = App\Models\HeaderMenu::getMenu(2); ?>

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
	    <p><b>Our Collection</b> | {{ $pageData->name }}</p>
		 <div class="wine-list-type">
		 <?php $protypes = App\Models\ShopProduct::getHeaderCats();
		 if(count($protypes) >=1) {		
		 foreach($protypes as $dd) { 
		  $type = App\Models\ProType::catByid($dd->protype);
		   $types = App\Models\ShopProduct::getSubCats($dd->protype);
		   
		   foreach($types as $tt) {
            $subtype = App\Models\ProCat::getProcat($tt->procat);
            $count = App\Models\ShopProduct::SubCatCount($tt->procat);?>
		  <a href="{{ route('search') }}?protype={{ $dd->protype }}&procat={{ $tt->procat }}"><b>{{ $type->name }} : {{ $subtype->name  }}</b> ({{$count}})</a>
		<?php } } } ?>
		  
		 </div>
	  </div>
	  <div class="right-column">
		  <div class="form-1">
		  	<h4>{{ $pageData->name }} search</h4>
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
				  </select>
				 </div>
			  <div class="search-input-btn">
				<label for="">&nbsp;</label>
				<input type="submit" value="Submit">
			  </div>               
		 </form>
	 </div>
	 <div class="form-2">
	 	<h4>{{ $newsData->name }} search</h4>
		 <form id="searchbox" method="get" action="{{ url('news/search') }}"  class="search-product">
			 <div class="product-type">
			   <label for="type">{{ $newsData->name }} type</label>
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
			  <label for="category">{{ $newsData->name }} Name</label>
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
