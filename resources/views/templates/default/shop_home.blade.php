@extends($templatePath.'.shop_layout')


@section('center')
<section class="about-us">
  <div class="container">
    <div class="about-us-inner">
      <div class="about-us-content">
        <div class="left-section about-img">
          <img src="{{ asset( $homedata->aboutus_img1 ) }}" alt="<?php echo $homedata->aboutus_img1_alt; ?>">
          <img src="{{ asset( $homedata->aboutus_img2 ) }}" alt="<?php echo $homedata->aboutus_img2_alt; ?>">
        </div>
        <div class="right-section about-text">
          <?php echo $homedata->aboutus; ?>
        </div>
      </div>
    </div>
  </div>
</section>  
          
<section class="about-banner" style="background-image: url('{{ asset( $homedata->savejob_bg ) }}');">
  <div class="container">
    <div class="about-banner-inner">
      <div class="about-banner-content">
        <?php echo $homedata->savejob; ?>
      </div>
    </div>
  </div>
</section>  
          
<section class="image-gallery">
  <div class="container">
    <div class="image-gallery-inner">
      <div class="gallery">
        <div class="img-left">
          <div class="imgl-col-1">
            <img src="{{ asset( $homedata->gallary_img1 ) }}" alt="{{ $homedata->gallary_img1_alt }}">
          </div>
          <div class="imgl-col-2">
            <img src="{{ asset( $homedata->gallary_img2 ) }}" alt="{{ $homedata->gallary_img2_alt }}">
            <img src="{{ asset( $homedata->gallary_img3 ) }}" alt="{{ $homedata->gallary_img3_alt }}">
          </div>
        </div>
        <div class="img-right">
          <div class="imgr-col-1">
            <img src="{{ asset( $homedata->gallary_img4 ) }}" alt="{{ $homedata->gallary_img4_alt }}">
            <img src="{{ asset( $homedata->gallary_img5 ) }}" alt="{{ $homedata->gallary_img5_alt }}">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  


<section class="testimonial-sec" style="background-image: url('{{ asset($testtitle->image) }}');">
   <div class="container">
     <div class="happy-client">
      
      <?php if($testtitle->name)  echo '<p>'.$testtitle->name.'</p>'; 
       if($testtitle->subtitle)  echo '<h2>'.$testtitle->subtitle.'</h2>'; 
      ?>
	     
    
	 </div>
      <div class="testimonial-slide testimonial-slider">
        <?php $slid=0; foreach($testimonial as $slide) {
          $slid++;
        $position = App\Models\TestimonialPosition::GetPosition($slide->position);  ?>
	      <div class="t-content">
		      <p class="text-area" data-controller="#readMore{{ $slid }}">
            <?php echo $slide->content; ?></p>
          <a href="javascript:void(0);" id="readMore{{ $slid }}">Read More</a>
			  <div class="t-image">
			     <div class="tc-img"> 
				    <img src="{{ asset( $slide->image ) }}" alt="{{ $slide->image_alt }}">
				 </div>
				 <div class="tc-title">
				    <h3>{{ $slide->name }}</h3>
					 <span>{{ $position->name }}</span>
				 </div>
			   </div>
		  </div>
    <?php } ?>
		  
		  
	   </div>
   </div>
</section>

<?php if($homedata->testimonial) { ?>
<section class="meet-team-sec" >
   <div class="container">   
      
       <h2> Meet the Team</h2>
      <div class="meet-team-slide team-slider">
        <?php  foreach($team as $user) {
          $role = App\Admin\Models\AdminUser::getRole($user->id);
        $position = App\Admin\Models\AdminUser::getPosition($role->role_id); ?>
        
         
        <div class="team-content">
          
        <div class="team-image">
           <div class="tc-img"> 
            <img src="<?php if($user->avatar) echo asset($user['avatar']); else echo asset('images/index.jpg'); ?>">
         </div>
         <div class="tc-title">
            <h3>{{ $user->salutation }}  {{ $user->name }} <?php echo " ".$user->last_name; ?></h3>
           <span><?php if($position) echo $position->name; ?></span>
         </div>
         <div class="brief">
          <p><?php echo $user->brief; ?></p>
         </div>
         </div>
      </div>
    <?php } ?>
      
      
     </div>
   </div>
</section>
<?php } ?>
      <?php if(count($footerNews) >=1) { 
         $newsData = App\Models\HeaderMenu::getMenu(2);
         if($newsData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $homedata->norder }} <span>{{ $newsData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerNews as $news) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('news') }}/{{$news->alias }}"><img src="{{ asset($news->image) }}" alt="accommodation"></a>
          </div>
          <div class="news-details">
            <h5>{{ $news->name }}</h5>
            <p> <?php echo $news->introduction; ?> </p>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<?php } }?>

<?php if(count($footerProduct) >=1) {
 $prodData = App\Models\HeaderMenu::getMenu(1);
  if($prodData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $homedata->proorder }} <span>{{ $prodData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerProduct as $news) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('product') }}/{{$news->alias }}.php"><img src="{{ asset($news->image) }}" alt="accommodation"></a>
          </div>
          <div class="news-details">
            <h5>{{ $news->name }}</h5>
            <p> <?php echo $news->introduction; ?> </p>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<?php } }?>

<?php if(count($footerProperty) >=1) {
$proData = App\Models\HeaderMenu::getMenu(4); 
 if($proData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $homedata->porder }} <span>{{ $proData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerProperty as $news) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('property') }}/{{$news->alias }}"><img src="{{ asset($news->image) }}" alt="accommodation"></a>
          </div>
          <div class="news-details">
            <h5>{{ $news->name }}</h5>
            <p> <?php echo $news->introduction; ?> </p>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<?php } }?>

<?php if(count($footerAccommmo) >=1) {
$accData = App\Models\HeaderMenu::getMenu(5); 
 if($accData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $homedata->accorder }} <span>{{ $accData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerAccommmo as $news) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('accommodation') }}/{{$news->alias }}"><img src="{{ asset($news->image) }}" alt="accommodation"></a>
          </div>
          <div class="news-details">
            <h5>{{ $news->name }}</h5>
            <p> <?php echo $news->introduction; ?> </p>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<?php } }?>


<?php if(count($footerService) >=1) { 
  $servData = App\Models\HeaderMenu::getMenu(3);
   if($servData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $homedata->sorder }} <span>{{ $servData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerService as $news) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('services') }}/{{$news->alias }}"><img src="{{ asset($news->image) }}" alt="accommodation"></a>
          </div>
          <div class="news-details">
            <h5>{{ $news->name }}</h5>
            <p> <?php echo $news->introduction; ?> </p>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<?php } }?>

<?php if(count($footerPort) >=1) { 
  $portData = App\Models\HeaderMenu::getMenu(12);
   if($portData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $homedata->portorder }} <span>{{ $portData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerPort as $port) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('portfolio') }}/{{$port->alias }}"><img src="{{ asset($port->image) }}" alt="portfolio"></a>
          </div>
          <div class="news-details">
            <h5>{{ $port->name }}</h5>
            <p> <?php echo $port->introduction; ?> </p>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<?php } }?>

<?php if(count($footerBlog) >=1) { 
  $blogData = App\Models\HeaderMenu::getMenu(13);
   if($blogData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $homedata->blogorder }} <span>{{ $blogData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerBlog as $blg) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('blog') }}/{{$blg->alias }}"><img src="{{ asset($blg->image) }}" alt="{{ $blg->imagealt }}"></a>
          </div>
          <div class="news-details">
            <h5>{{ $blg->name }}</h5>
            <p> <?php echo $blg->introduction; ?> </p>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<?php } }?>
 
          


<?php /*
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">{{ trans('front.features_items') }}</h2>
                @foreach ($products_new as  $key => $product_new)
                  <div class="col-sm-4">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products product-box-{{ $product_new->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_new->getUrl() }}"><img src="{{ asset($product_new->getThumb()) }}" alt="{{ $product_new->name }}" /></a>
                            {!! $product_new->showPrice() !!}
                            <a href="{{ $product_new->getUrl() }}"><p>{{ $product_new->name }}</p></a>

                            @if ($product_new->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product_new->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif

                          </div>
                      @if ($product_new->price != $product_new->getFinalPrice() && $product_new->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product_new->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product_new->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a onClick="addToCartAjax('{{ $product_new->id }}','wishlist')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_wishlist')}}</a></li>
                          <li><a onClick="addToCartAjax('{{ $product_new->id }}','compare')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_compare')}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
               @endforeach
          </div><!--features_items-->

          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">{{ trans('front.products_hot') }}</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                @foreach ($products_hot as  $key => $product_hot)
                @if ($key % 3 == 0)
                  <div class="item {{  ($key ==0)?'active':'' }}">
                @endif
                  <div class="col-sm-4">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products   product-box-{{ $product_hot->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_hot->getUrl() }}"><img src="{{ asset($product_hot->getThumb()) }}" alt="{{ $product_hot->name }}" /></a>
                            {!! $product_hot->showPrice() !!}
                            <a href="{{ $product_hot->getUrl() }}"><p>{{ $product_hot->name }}</p></a>
                            @if ($product_hot->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product_hot->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product_hot->price != $product_hot->getFinalPrice() && $product_hot->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif

                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','wishlist')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_wishlist')}}</a></li>
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','compare')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_compare')}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                @if ($key % 3 == 2 || $key+1 == $products_hot->count())
                  </div>
                @endif
               @endforeach

              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
            </div>
          </div><!--/recommended_items-->

          <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#cate1" data-toggle="tab">{{ trans('front.products_build') }}</a></li>
                  <li><a href="#cate2" data-toggle="tab">{{ trans('front.products_group') }}</a></li>
              </ul>
            </div>
            <div class="tab-content">

                <div class="tab-pane fade active in" id="cate1" >
                  @foreach ($products_build as $product)
                    <div class="col-sm-3">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
              </div>
                <div class="tab-pane fade" id="cate2" >
                  @foreach ($products_group as $product)
                    <div class="col-sm-3">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
                </div>
          </div><!--/category-tab-->
*/?>
 <?php
 $newsData = App\Models\HeaderMenu::getMenu(2);
 if($newsData->status){     
  if(count($footerNews) >=1) {
 $sa_news = App\Models\Blog::getSANews();  

   ?>

<?php  if(count($sa_news) >=1) { ?> 
          
<section class="blog">
  <div class="container">
    <div class="blog-inner">
      <h2><span>{{ $newsData->name }}<br></span>Latest {{ $newsData->name }} &amp; Updates from {{sc_store('title')}} </h2>
      
      <div class="blog-content">
        <?php $snc=0;
        foreach($sa_news as $news) {
          $snc++; ?>
        <div class="blogs blog-1">
          <div class="blog-img">
           <a href="{{ url('news') }}/{{$news->alias}}"><img src="{{ asset($news->image) }}" alt="{{ $news->imagealt }}"></a>
            <div class="date-tag">
              <p><?php echo date('M d Y',strtotime($news->startdate)); ?></p>
            </div>
          </div>
          <div class="blog-details">
            <h6>{{ $news->name }}</h6>
            <p><?php echo $news->introduction; ?></p>
            <a href="{{ url('news') }}/{{$news->alias}}">read more</a>
          </div>
        </div>
      <?php } ?>

      </div>
    </div>
     
  </div>
</section> 
<?php } } }
if(!empty($admin)) {
      if($admin->role==1) { ?>
        <div class="edit-post-link">
          <a target="_blank" href="{{ route('admin_homecontent.edit', ['id' => $homedata->id]) }}">Edit post</a>
        </div>
        
      <?php } } ?>

@endsection



@push('styles')
@endpush

@push('scripts')
<!--
<script>
  $('.testimonial-slider').slick({
          dots: true,
          infinite: true,
          slidesToShow: 3,
          adaptiveHeight: true,
          autoplay: true,
          slidesToScroll: 1, 
        }); 
</script>
-->
  
<script>
  
$('.testimonial-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
   adaptiveHeight: true,
   autoplay: true,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>
@endpush
