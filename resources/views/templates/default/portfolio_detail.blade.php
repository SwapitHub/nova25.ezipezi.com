@extends($templatePath.'.shop_layout')  

@section('center')  
<?php $pageData = App\Models\HeaderMenu::getMenu(12); ?>
          <div class="product-details container">

            <div class="portfolio-header">
              <h2>{{ $pageData->name }}   </h2>
              <span class="portfolio-breadcrumb">{{ $portcat->name }} - {{ $portfolio->name }}</span>
             
            </div>
            <div class="row">
            <div class="col-sm-6 left-slider">


              <div id="product-detail-image" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      <div class="view-product item active"  data-slide-number="0">
                        <img src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->imagealt}}">
                        <p class="caption">{{$portfolio->imagealt}}</p>
                      </div>
                   <?php if(count($portfolioimgs) >=1) {
                    $key=0;
                      foreach ($portfolioimgs as $img) {
                       $key++; ?>

                       <div class="view-product item"  data-slide-number="{{ $key + 1 }}">
                          <img src="{{ asset($img->image) }}" alt="{{$img->imagealt}}">
                          <p class="caption">{{$img->imagealt}}</p>
                        </div>
                       <?php } } ?>
                    </div>
                   </div> 
                  <?php if(count($portfolioimgs) >=1) { ?>
                    <!-- Controls -->
                    <a class="left item-control" style="display: inherit;" href="#product-detail-image" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#product-detail-image" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                    </a>
                <?php } ?>
              </div>
              <div class="col-sm-6 right-content">
                 <div class="portfolio-content">
                {!! sc_html_render($portfolio->embedcode) !!}
                <h3>{{$portfolio->name}}</h3>
                {!! sc_html_render($portfolio->introduction) !!}
               
              </div>
              </div>
            </div>
            </div>
           <section class="prev-next-sec">
            <div class="container">
              <div class="next-prev-btn">
                <?php if($previous) { ?><a class="prev-btn" href="{{ url('portfolio/'.$previous->alias) }}"><span><i class="fa fa-chevron-left" aria-hidden="true"></i></span> previous</a>
                <?php } if($next) { ?><a class="next-btn" href="{{ url('portfolio/'.$next->alias) }}">next <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
              <?php } ?>
              </div>
            </div>
          </section>

          <div class="category-tab shop-details-tab container"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <?php $tab1 = App\Models\PortfolioTab::GetPortfolioTabs(1); 
              $tab2 = App\Models\PortfolioTab::GetPortfolioTabs(2); 
                 $tab3 = App\Models\PortfolioTab::GetPortfolioTabs(3); ?>
                
                <li class="active"><a href="#author" data-toggle="tab">{{ $tab1->name }} </a></li>                
                <li><a href="#details" data-toggle="tab">{{ $tab2->name }}</a></li>
                <li><a href="#tags" data-toggle="tab">{{ $tab3->name }}</a></li>                
              </ul>
                <div class="right-bottom-btn">
                  <a href="javascript:void(0);" class="add-fav" data-src="portfolio"><span><i class="fa fa-heart" aria-hidden="true"></i></span>Add to Favourites</a>                  
                   <a href="mailto:{{ sc_store('admin_email') }}?subject={{ url('portfolio/'.$portfolio->alias) }}"><span><i class="fa fa-envelope"></i></span>Email Enquiry</a>
                   <p class="fav-success"></p>
                </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade  active in" id="author" >
                <div class="right-contact-section">
                        <h3>contact details</h3>
                        
                            
                            <?php if($portfolio->author)
                            { $authors = explode (",", $portfolio->author);  
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

                                <p><span>Email Enquiry:</span> <a href="mailto:{{ $author->email }}?subject={{ url('portfolio') }}/{{$portfolio->alias}} "> {{ $author->email }}</a></p>

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

                             <?php if(!empty($admin)) {
                              if($admin->role==1) { ?>
                                <div class="edit-post-link">
                                  <a href="{{ route('admin_portfolio.edit', ['id' => $portfolio->id]) }}">Edit post</a>
                                </div>
                                 <button id="generate_pdf_btn">Download PDF</button> 
                              <?php } } ?>
                          
                    </div>
              </div>
              
              <div class="tab-pane fade" id="details" >
                {!! sc_html_render($portfolio->content) !!}
              </div>
              <div class="tab-pane fade" id="tags" >
               
                    
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <?php $extag = explode (",", $portfolio->tags); 
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
        <?php $exst=0; $tags = App\Models\PortfolioTag::getTags($type->id); 
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
              
            </div>
          </div>
        
      </div>
    </div>
  </div>
</div>
</div>
</div>



<?php if($portfolio->testimonial) { ?>
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
    <h2>{{ $portfolio->norder }} <span>{{ $newsData->name }}</span></h2>
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
<?php } } ?>

<?php if(count($footerProduct) >=1) { 
  $prodData = App\Models\HeaderMenu::getMenu(1);
  if($prodData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $portfolio->proorder }} <span>{{ $prodData->name }}</span></h2>
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
    <h2>{{ $portfolio->porder }} <span>{{ $proData->name }}</span></h2>
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
<?php } } ?>

<?php if(count($footerAccommmo) >=1) {  
$accData = App\Models\HeaderMenu::getMenu(5);
if($accData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $portfolio->accorder }} <span>{{ $accData->name }}</span></h2>
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
<?php } } ?>


<?php if(count($footerService) >=1) { 
  $servData = App\Models\HeaderMenu::getMenu(3);
  if($servData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $portfolio->sorder }} <span>{{ $servData->name }}</span></h2>
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
    <h2>{{ $portfolio->portorder }} <span>{{ $portData->name }}</span></h2>
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
    <h2>{{ $portfolio->blogorder }} <span>{{ $blogData->name }}</span></h2>
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

<div class="pdf-generate" id="pdddd" style="display: none;">
  <section class="acco-detail service-detail">

    <div class="container">
      <img src="{{ asset(sc_store('logo')) }}" alt="logo">
      <h2>{{ $portfolio->name }}</h2>
        <div class="acco-detail-inner">
           <div class="acco-detail-content">            
            <h3>{{$portfolio->name}}</h3>
            {!! sc_html_render($portfolio->introduction) !!}
            {!! sc_html_render($portfolio->content) !!}
        </div>
        </div>
    
    </div>
   
</section> 

      
<section class="acco-gallery news-gallery">
    <div class="acco-gallery-inner">
        <div class="acco-gallery-box">
          <div class="gallery-item">
                <img src="{{ asset($portfolio->image) }}" alt="{{$portfolio->imagealt}}">
            </div>
          <?php foreach ($portfolioimgs as $img) { ?>
            <div class="gallery-item">
                <img src="{{ asset($img->image) }}" alt="{{$img->imagealt}}">
            </div>
          <?php } ?>
            

        </div>
    </div>
</section>

 
<section class="acco-contact service-contact" id="">
    <div class="container">
        <div class="acco-contact-inner">
            <div class="contact-content">
                <div class="left-contact-section-main col-md-6">
                    <div class="left-contact-section">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <?php $extag = explode (",", $portfolio->tags); 
  $i=0;  foreach($tagtype as $type) { $i++; ?>                 
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingnew{{ $type->id }}">
      <h4 class="panel-title <?php if($i==1) echo 'active'; ?>">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $type->id }}" aria-expanded="true" aria-controls="collapse{{ $type->id }}">
          {{ $type->name }}
        </a>
      </h4>
    </div>
    <div id="collapse{{ $type->id }}" class="panel-collapse collapse <?php if($i==1) echo 'in'; ?>" role="tabpanel" aria-labelledby="heading1{{ $type->id }}">
      <div class="panel-body">
       <ul>
        <?php $exst=0; $tags = App\Models\NewsTag::getTags($type->id); 
        foreach ($tags as $tag) {
         if (in_array($tag->id, $extag)) {
          $exst=1; ?>
           <li>{{ $tag->name }}</li>
         <?php } } if($exst==0) { ?>
          <script>
           
            var element = 'headingnew'+{{$type->id}};
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
                </div>
                <div class="right-contact-section-main col-md-6">
                   <div class="right-contact-section">
                        <h3>contact details</h3>
                        
                            <?php if($portfolio->author)
                            { $authors = explode (",", $portfolio->author);  
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

                                <p><span>Email Enquiry:</span> {{ $author->email }}</p>

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

        </div>
        <p class="address">{{ route('home') }}</p>
    </div>
</section>


  </div>


@endsection

@section('breadcrumb')
@endsection

@push('styles')

@endpush

@push('scripts')
<script type="text/javascript">
  
  $('.panel-heading .panel-title > a').click(function(){
    $(this).parents('.panel.panel-default').siblings().find('.panel-title').removeClass('active');
    $(this).parent().toggleClass('active');

  });
  $('.removeDiv').parent().remove();

    $('body').addClass('portfolio-detail');
    $('body').addClass('blog-detail');
    $('.add-fav').click(function(){
    var tbl = 'portfolio';
    var page = 'portfolio';
    var id = '{{ $portfolio->id }}';
    $.ajax({
                method: 'post',
                url: '{{ route('addtofav') }}',
                data: {tbl:tbl,id:id,page:page,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('.fav-success').html(data);
                   setTimeout(function() {
                     $('.fav-success span').fadeOut('slow');
                  }, 1500);
                }
            });
  });
</script>
@endpush
