@extends($templatePath.'.shop_layout')

@section('center')
          <div class="product-details container"><!--product-details-->
            <div class="col-sm-6">


              <div id="product-detail-image" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      <div class="view-product item active"  data-slide-number="0">
                        <img src="{{ asset($product->getImage()) }}" alt="{{ $product->image_alt}}">
                        <p class="caption">{{$product->image_alt}}</p>
                      </div>
                    @if ($product->images->count())
                       @foreach ($product->images as $key=>$image)

                       <div class="view-product item"  data-slide-number="{{ $key + 1 }}">
                          <img src="{{ asset($image->getImage()) }}" alt="{{ $image->imagealt }}">
                           <p class="caption">{{$image->imagealt}}</p>
                        </div>
                        @endforeach
                    @endif
                    </div>
                  {{-- </div> --}}
              </div>
              @if ($product->images->count())
                    <!-- Controls -->
                    <a class="left item-control" style="display: inherit;" href="#product-detail-image" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#product-detail-image" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                    </a>
                @endif
            </div>

        <form id="buy_block" action="{{ route('cart.add') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="product_id" id="product-detail-id" value="{{ $product->id }}" />
            <div class="col-sm-6">
              <div class="product-information"><!--/product-information-->
                @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                <img src="{{ asset($templateFile.'/images/home/sale2.png') }}" class="newarrival" alt="" />
                @elseif($product->type == SC_PRODUCT_NEW)
                <img src="{{ asset($templateFile.'/images/home/new2.png') }}" class="newarrival" alt="" />
                @elseif($product->type == SC_PRODUCT_HOT)
                <img src="{{ asset($templateFile.'/images/home/hot2.png') }}" class="newarrival" alt="" />
                @elseif($product->kind == SC_PRODUCT_BUILD)
                <img src="{{ asset($templateFile.'/images/home/bundle2.png') }}" class="newarrival" alt="" />
                @elseif($product->kind == SC_PRODUCT_GROUP)
                <img src="{{ asset($templateFile.'/images/home/group2.png') }}" class="newarrival" alt="" />
                @endif
                <?php if(!empty($admin)) {
                  if($admin->role==1) { ?>
                    <div class="edit-post-link">
                      <a  href="{{ route('admin_product.edit', ['id' => $product->id]) }}">Edit post</a>
                    </div>
                 <?php }
                    elseif ($admin->id==$product->userid) { ?>
                    <div class="edit-post-link">
                                    <a  href="{{ route('admin_product.edit', ['id' => $product->id]) }}">Edit post</a>
                                  </div>
                  <?php   }
                  } ?>

                <h2  id="product-detail-name">{{ $product->name }}</h2>
                <div class="description">
                {{ $product->description }}
              </div>
                <p>SKU: <span  id="product-detail-model">{{ $product->sku }}</span></p>

                <div id="product-detail-price">
                  {!! $product->showPriceDetail() !!}
                </div>

                @if ($product->kind == SC_PRODUCT_GROUP)
                <span id="product-detail-cart-group" style="display:none">
                  <label>{{ trans('product.quantity') }}:</label>
                  <input type="number" name="qty" value="1" min="1" />
                  <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    {{trans('front.add_to_cart')}}
                  </button>

                  <a href="mailto:{{ sc_store('admin_email') }}?subject={{ $product->getUrl() }}" class="btn btn-fefault email-enquiry">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    Email Enquiry
                  </a>
                </span>                      
                @else ($product->allowSale())
                <span>
                  <label>{{ trans('product.quantity') }}:</label>
                  <input type="number" name="qty" value="1" min="1" />
                  <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    {{trans('front.add_to_cart')}}
                  </button>

                  <a href="mailto:{{ sc_store('admin_email') }}?subject={{ $product->getUrl() }}" class="btn btn-fefault email-enquiry">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    Email Enquiry
                  </a>
                </span>  
                @endif


                <div  id="product-detail-attr">
                  @if ($product->attributes())
                  {!! $product->renderAttributeDetails() !!}
                  @endif
                </div>

                @if (sc_config('product_stock'))
                <b>{{ trans('product.stock_status') }}:</b>
                <span id="stock_status">
                    @if($product->stock <=0 && !sc_config('product_buy_out_of_stock'))
                    {{ trans('product.out_stock') }}
                    @else
                    {{ trans('product.in_stock') }}
                    @endif
                </span>
                <br>
                @endif


                @if (sc_config('product_available') && $product->date_available >= date('Y-m-d H:i:s'))
                  <b>{{ trans('product.date_available') }}:</b>
                  <span id="product-detail-available">
                    {{ $product->date_available }}
                  </span>
                  <br>
                @endif
                
              

                @if (sc_config('product_brand') && !empty($product->brand->name))
                  <b>{{ trans('product.brand') }}:</b> <span id="product-detail-brand">{{ empty($product->brand->name)?'None':$product->brand->name }}</span><br>
                @endif


              @if ($product->kind == SC_PRODUCT_GROUP)
              <div class="products-group">
                @php
                  $groups = $product->groups
                @endphp
                <b>{{ trans('product.groups') }}</b>:<br>
                @foreach ($groups as $group)
                  <span class="sc-product-group" data-id="{{ $group->product_id }}">{!! sc_image_render($group->product->image) !!}</span>
                @endforeach
              </div>
              @endif

              @if ($product->kind == SC_PRODUCT_BUILD)
              <div class="products-group">
                @php
                  $builds = $product->builds
                @endphp
                <b>{{ trans('product.builds') }}</b>:<br>
                <span class="sc-product-build">{!! sc_image_render($product->image) !!} = </span>
                @foreach ($builds as $k => $build)
                  {!! ($k)?'<i class="fa fa-plus" aria-hidden="true"></i>':'' !!} <span class="sc-product-build">{{ $build->quantity }} x <a target="_new" href="{{ $build->product->getUrl() }}">{!! sc_image_render($build->product->image) !!}</a></span>
                @endforeach
              </div>
              @endif


              </div><!--/product-information-->
            </div>
          </div><!--/product-details-->
        </form>
        <section class="prev-next-sec">
  <div class="container">
     <div class="next-prev-btn">
                <?php if($previous) { ?><a class="prev-btn" href="{{ $previous->getUrl() }}"><span><i class="fa fa-chevron-left" aria-hidden="true"></i></span> previous</a>
                <?php } if($next) { ?><a class="next-btn" href="{{ $next->getUrl() }}">next <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
              <?php } ?>
              </div>
  </div>
</section>
        <div class="container">
        <div class="share-module">
            <a href="http://www.facebook.com/sharer.php?u={{ $product->getUrl() }}" target="_blank" title="{{$product->name}}">
          <i class="fab fa-facebook-f"></i></a>
        </div>
      </div>

          <div class="category-tab shop-details-tab container"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#intro" data-toggle="tab">Introduction</a></li>
                <li><a href="#details" data-toggle="tab">{{ trans('product.description') }}</a></li>
                <li><a href="#tags" data-toggle="tab">Additional Information</a></li>
                <li><a href="#author" data-toggle="tab">Contact Details </a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade active in" id="intro" >
                {!! sc_html_render($product->introduction) !!}
              </div>
              <div class="tab-pane fade" id="details" >
                {!! sc_html_render($product->content) !!}
              </div>
              <div class="tab-pane fade" id="tags" >
               
                    
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <?php $extag = explode (",", $product->tags); 
  $i=0;  foreach($tagtype as $type) { $i++; ?>                 
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading{{ $type->id }}">
      <h4 class="panel-title <?php if($i==1) echo 'active'; ?>">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $type->id }}" aria-expanded="true" aria-controls="collapse{{ $type->id }}">
          {{ $type->name }}
        </a>
      </h4>
    </div>
    <div id="collapse{{ $type->id }}" class="panel-collapse collapse <?php if($i==1) echo 'in'; ?>" role="tabpanel" aria-labelledby="heading{{ $type->id }}">
      <div class="panel-body">
       <ul>
        <?php $exst=0; $tags = App\Models\ProTag::getTags($type->id); 
        foreach ($tags as $tag) {
         if (in_array($tag->id, $extag)) {
          $exst=1; ?>
           <li>{{ $tag->name }}</li>
         <?php } } if($exst==0) { ?>
          <script>
           
            var element = 'heading'+{{$type->id}};
            var element = document.getElementById(element);
           element.classList.add("removeDiv");
          </script>
         <?php } ?>

           
       </ul>
      </div>
    </div>
  </div>
<?php } ?>



</div>
                  
                
              </div>
              <div class="tab-pane fade" id="author" >
                <div class="right-contact-section custom-author-sec">
                        <h3>contact details</h3>
                        
                            
                            <?php if($product->author)
                            { $authors = explode (",", $product->author);  
                          foreach ($authors as $id ) {
                           $author = App\Admin\Models\AdminUser::GetAdminUser($id);

                           ?>
                           <div class="contact-box">
                            <div class="user-image">
                            <img src="<?php if($author->avatar) echo asset($author['avatar']); else echo asset('images/index.jpg'); ?> " class="img-thumbnail">
                           </div>
                           <div class="auther-details">
                            <p><span>Name:</span> {{ $author->salutation }}  {{ $author->name }} <?php echo " ".$author->last_name; ?></p>
                                <p><span>Business phone:</span> {{ $author->business_phone }}</p>
                              <p><span>Mobile:</span> {{ $author->cell_number }}</p>                               

                                <p><span>Email Enquiry:</span><a href="mailto:{{ $author->email }}?subject={{ $product->getUrl() }} "> {{ $author->email }}</a></p>
                                <div class="social-items">
                                <p><span>Social:</span>
                                <div class="social-icon">
                                       <a href="{{ $author->skype_name }}" target="_blank">{{ $author->skype_name }}</a> 
                                        <br>       
                                        <a href="{{ $author->facebook }}" target="_blank">{{ $author->facebook }}</a>
                                        <br>
                                       <a href="{{ $author->twitter }}" target="_blank">{{ $author->twitter }}</a>
                                        <br>
                                      <a href="{{ $author->bbm }}" target="_blank">{{ $author->bbm }}</a>
                                 </div>
                                </div>
                                </div>

                                
                                <br>
                                 </div>
                                
                            <?php } } ?>
                           
                    </div>
              </div>
            </div>
          </div><!--/category-tab-->

<?php if($product->testimonial) { ?>
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
          if($newsData->status) {  ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $product->norder }} <span>{{ $newsData->name }}</span></h2>
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
 if($prodData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $product->proorder }} <span>{{ $prodData->name }}</span></h2>
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
if($proData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $product->porder }} <span>{{ $proData->name }}</span></h2>
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
    <h2>{{ $product->accorder }} <span>{{ $accData->name }}</span></h2>
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
if($servData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $product->sorder }} <span>{{ $servData->name }}</span></h2>
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
<?php } } ?>

<?php if(count($footerPort) >=1) { 
  $portData = App\Models\HeaderMenu::getMenu(12);
   if($portData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $product->portorder }} <span>{{ $portData->name }}</span></h2>
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
    <h2>{{ $product->blogorder }} <span>{{ $blogData->name }}</span></h2>
      <div class="news-content">
        <?php $ncnt =0; foreach($footerBlog as $blg) { 
          $ncnt++;?>
        <div class="featured-news news-{{ $ncnt }}">
          <div class="news-img">
            <a href="{{ url('blog') }}/{{$blg->alias }}"><img src="{{ asset($blg->image) }}" alt="blog"></a>
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
@if ($productsToCategory->count())
          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">{{ trans('front.recommended_items') }}</h2>

            <div id="recommended-item-carousel" class="carousel slide">
              <div class="carousel-inner">
               @foreach ($productsToCategory as  $key => $product_rel)
                @if ($key % 4 == 0)
                  <div class="item {{  ($key ==0)?'active':'' }}">
                @endif
                  <div class="col-sm-3">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products   product-box-{{ $product_rel->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_rel->getUrl() }}"><img src="{{ asset($product_rel->getThumb()) }}" alt="{{ $product_rel->name }}" /></a>
                        {!! $product_rel->showPrice() !!}
                            <a href="{{ $product_rel->getUrl() }}"><p>{{ $product_rel->name }}</p></a>
                          </div>
                          @if ($product_rel->price != $product_rel->getFinalPrice())
                          <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                          @elseif($product_rel->type == 1)
                          <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                          @endif
                      </div>
                    </div>
                  </div>
                @if ($key % 4 == 3)
                  </div>
                @endif
               @endforeach
              </div>
            </div>
          </div><!--/recommended_items-->
@endif


@endsection

@section('breadcrumb')
@endsection

@push('styles')

@endpush

@push('scripts')
<script type="text/javascript">
  $('.addPrice').click(function(){
    var id = $(this).data('src');
    $.ajax({
          url:'{{ route("product.setprice") }}',
          type:'POST',
          data:{id:id,"_token": "{{ csrf_token() }}"},          
          success: function(data){
                  
          }
      });
  });
  $('.panel-heading .panel-title > a').click(function(){
    $(this).parents('.panel.panel-default').siblings().find('.panel-title').removeClass('active');
    $(this).parent().toggleClass('active');

  });
  $('.removeDiv').parent().remove();

    $('body').addClass('product-detail');
  $('.sc-product-group').click(function(event) {
    if($(this).hasClass('active')){
      return;
    }
    $('.sc-product-group').removeClass('active');
    $(this).addClass('active');
    var id = $(this).data("id");
      $.ajax({
          url:'{{ route("product.info") }}',
          type:'POST',
          dataType:'json',
          data:{id:id,"_token": "{{ csrf_token() }}"},
          beforeSend: function(){
              $('#loading').show();
          },
          success: function(data){
            //console.log(data);
            $('#product-detail-cart-group').show();
            $('#product-detail-name').html(data.name);
            $('#product-detail-model').html(data.sku);
            $('#product-detail-price').html(data.showPrice);
            $('#product-detail-brand').html(data.brand_name);
            $('#product-detail-image').html(data.showImages);
            $('#product-detail-available').html(data.availability);
            $('#product-detail-id').val(data.id);
            $('#product-detail-image').carousel();
            $('#loading').hide();
            window.history.pushState("", "", data.url);            
          }
      });

  });
</script>
@endpush
