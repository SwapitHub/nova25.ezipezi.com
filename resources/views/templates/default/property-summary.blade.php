@extends($templatePath.'.shop_layout')

@section('center')

<?php $pageData = App\Models\HeaderMenu::getMenu(4);
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
	    <p><b>{{ $pageData->name }}  |</b> | Latest {{ $pageData->name }}</p>
		<p>{{ $pageData->description }}</p>
		 <div class="wine-list-type">
		<?php $protype = App\Models\Property::getHeaderCats(); 
                 if(count($protype) >=1) { 
                    foreach($protype as $dd) {
                          $type = App\Models\PropertyType::getsingleCat($dd->propertytype); 
                          $count = App\Models\Property::catCount($dd->propertytype);?>
		 <a href="{{ url('property/search') }}?protype={{$dd->propertytype}}"><b>{{ $type->name  }} </b>({{$count}})</a>
		 <?php } } ?>
		  
		 </div>
	  </div>
	  <div class="right-column">
		  
	 <div class="form-2">
	 	<h4>{{ $pageData->name }} search</h4>
		 <form id="searchbox" method="get" action="{{ url('property/search') }}"  class="search-product">
			 <div class="product-type">
			   <label for="type">{{ $pageData->name }} type</label>
			      <select name="protype"  class="protype">
                            <option value="">Choose type</option>
                            <?php $protype = App\Models\Property::getHeaderCats(); 
                 if(count($protype) >=1) { 
                    foreach($protype as $dd) {
                          $type = App\Models\PropertyType::getsingleCat($dd->propertytype); ?>
                              <option value="{{ $type->id }}" <?php if(isset($_GET['protype'])) { if($_GET['protype']==$type->id) echo "selected"; }  ?> >
                                  {{ $type->name  }}</option>
                              <?php }  }?>
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
