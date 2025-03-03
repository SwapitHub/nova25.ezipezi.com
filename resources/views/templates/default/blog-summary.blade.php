@extends($templatePath.'.shop_layout')

@section('center')
<?php $pageData = App\Models\HeaderMenu::getMenu(13);
if($pageData->image) $image =  $pageData->image;
else $image = $templateFile.'/images/home/product-listing-bg.png'; ?>
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
		<?php $stypes = App\Models\NewBlog::getHeaderCats();
           if(count($stypes) >=1) {
           	foreach($stypes as $dd) {
           		$count = App\Models\NewBlog::catCount($dd->blogtype);
                     $type = App\Models\BlogType::getSingleCat($dd->blogtype) ?>
		 <a href="{{ url('blog/search') }}?blogtype={{$dd->blogtype}}"><b>{{ $type->name  }} </b>({{$count}})</a>
		 <?php } } ?>
		  
		 </div>
	  </div>
	  <div class="right-column">
		  
	 <div class="form-2">
	 	<h4>{{ $pageData->name }} search</h4>
		 <form id="searchbox" method="get" action="{{ url('blog/search') }}"  class="search-product">
			 <div class="product-type">
			   <label for="type">{{ $pageData->name }} type</label>
			    <select name="blogtype"  class="blogtype">
                            <option value="">Choose type</option>
                           <?php $stypes = App\Models\NewBlog::getHeaderCats();
                            if(count($stypes) >=1) { 
                           foreach($stypes as $dd) {
                            $type = App\Models\BlogType::getSingleCat($dd->blogtype) ?>
                              <option value="{{ $type->id }}" <?php if(isset($_GET['blogtype'])) { if($_GET['blogtype']==$type->id) echo "selected"; }  ?> >
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
</section>



@endsection


@push('styles')
@endpush
@push('scripts')
 
@endpush
