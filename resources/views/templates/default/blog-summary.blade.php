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

<section class="special-offer-box-one main-content-section">
	<div class="container">
		<div class="filter-tab-sec">
			<div class="filter-tab-inner">
				<div class="d-flex-custom filter-tab-column">
					<div class="thirty-col filter-tab-col-left-shop-by">
						<div class="btn btn-gridview">Grid View:</div>
						<ul class="tabsfilter-on-shop-by">
							<li class="tab-link current" data-tab="filtertab-1">
								<span><i class="fa-solid fa-list"></i></span>
							</li>
							<li class="tab-link" data-tab="filtertab-2">
								<span><i class="fa-solid fa-table"></i></span>
							</li>
						</ul>
					</div>

					<div class="seventy-col filter-tab-right-col-shop-by">
						<div class="form-group short-by">
							<label class="control-label" for="input-sort">Sort By:</label>
							<select id="input-sort" class="form-control">
								<option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured
								</option>
								<option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest
								</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="input-limit">Show:</label>
							<select id="input-limit" class="form-control">
								<option value="10" {{ request('limit') == '10' ? 'selected' : '' }}>10</option>
								<option value="15" {{ request('limit') == '15' ? 'selected' : '' }}>15</option>
								<option value="25" {{ request('limit') == '25' ? 'selected' : '' }}>25</option>
								<option value="50" {{ request('limit') == '50' ? 'selected' : '' }}>50</option>
								<option value="75" {{ request('limit') == '75' ? 'selected' : '' }}>75</option>
								<option value="100" {{ request('limit') == '100' ? 'selected' : '' }}>100</option>
							</select>
						</div>
					</div>
				</div>

				<div class="filter-content-tab">
					{{-- List View Tab --}}
					<div id="filtertab-1" class="tab-content">
						<div id="portfolio-list">
							@include('partials.portfolio-items', ['portfolios' => $portfolios])
						</div>
					</div>

					{{-- Grid View Tab --}}
					<div id="filtertab-2" class="tab-content">
						<div class="d-flex-custom tab-two-col-inner" id="portfolio-grid">
							@include('partials.portfolio-grid-items', ['portfolios' => $portfolios])
						</div>
					</div>

					{{-- Load More Button --}}
					<div class="text-center">
						@if ($portfolios->hasMorePages())
							<button id="load-more" class="btn btn-primary"
								data-next-url="{{ $portfolios->nextPageUrl() }}">
								Load More
							</button>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



@endsection


@push('styles')
@endpush
@push('scripts')
<script>
	document.addEventListener("DOMContentLoaded", function() {
		let loadMoreButton = document.getElementById("load-more");

		if (loadMoreButton) {
			loadMoreButton.addEventListener("click", function() {
				let nextUrl = loadMoreButton.getAttribute("data-next-url");

				if (!nextUrl) {
					loadMoreButton.style.display = "none";
					return;
				}

				// Store original state and disable button
				const originalText = loadMoreButton.textContent;
				loadMoreButton.disabled = true;
				loadMoreButton.textContent = "Loading...";

				fetch(nextUrl, {
						headers: {
							"X-Requested-With": "XMLHttpRequest"
						}
					})
					.then(response => response.json())
					.then(data => {
						if (data.listView) {
							document.getElementById("portfolio-list").insertAdjacentHTML(
								"beforeend", data.listView);
						}
						if (data.gridView) {
							document.getElementById("portfolio-grid").insertAdjacentHTML(
								"beforeend", data.gridView);
						}

						if (data.nextPageUrl) {
							loadMoreButton.setAttribute("data-next-url", data.nextPageUrl);
						} else {
							loadMoreButton.style.display = "none";
						}
					})
					.catch(error => {
						console.error("Error loading more portfolios:", error);
						// Optional: Show error message to user
						loadMoreButton.textContent = "Error - Click to retry";
					})
					.finally(() => {
						// Only reset if button still exists and is visible
						if (loadMoreButton.style.display !== "none") {
							loadMoreButton.disabled = false;
							loadMoreButton.textContent = originalText;
						}
					});
			});
		}

		// Handle Sorting and Limit Change
		document.getElementById("input-sort").addEventListener("change", updateUrl);
		document.getElementById("input-limit").addEventListener("change", updateUrl);

		function updateUrl() {
			const url = new URL(window.location.href);
			url.searchParams.set("sort", document.getElementById("input-sort").value);
			url.searchParams.set("limit", document.getElementById("input-limit").value);
			window.location.href = url.toString();
		}
	});
</script>
@endpush
