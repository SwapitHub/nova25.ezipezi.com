@extends($templatePath.'.shop_layout')

@section('center')
 <section class="banner_product-listing inner-page-banner" >
	<div class="container">
		<div class="banner-inner">
      <div class="banner-image">
       <img src="{{ asset($newsD->image) }}">
      </div>
			<div class="banner-innerpage-content">
				<h2>{{ $newsD->name }}</h2>  
			</div>
		</div>
	</div>
</section> 

 
<?php if(count($newsimgs) >=1) { ?>
      
<section class="acco-gallery news-gallery">
    <div class="acco-gallery-inner">
        <div class="acco-gallery-box acc-slider">
          <?php foreach ($newsimgs as $img) { ?>
            <div class="gallery-item">
                <img src="{{ asset($img->image) }}" alt="{{$img->imagealt}}">
            </div>
          <?php } ?>
            

        </div>
    </div>
</section> 
<?php } ?>
 
<section class="acco-detail news-detail">
    <div class="container">
       <div class="share-module">
            <a href="http://www.facebook.com/sharer.php?u={{ url('news') }}/{{$newsD->alias}}" target="_blank" title="{{$newsD->name}}">
          <i class="fab fa-facebook-f"></i></a>
        </div>
        <div class="acco-detail-inner">
           <div class="acco-detail-content">
             <?php echo $newsD->introduction; ?><br>
             <?php echo $newsD->content; ?>
        </div>
        </div>
      <?php if(!empty($admin)) {
      if($admin->role==1) { ?>
        <div class="edit-post-link">
          <a  href="{{ route('admin_blog.edit', ['id' => $newsD->id]) }}">Edit post</a>
        </div>
         <button id="generate_pdf_btn">Download PDF</button> 
      <?php }
      elseif ($admin->id==$newsD->userid) { ?>
       <div class="edit-post-link">
          <a  href="{{ route('admin_blog.edit', ['id' => $newsD->id]) }}">Edit post</a>
        </div>
    <?php   }
    } ?>
    </div>
   
</section> 
 
<section class="acco-contact news-contact">
    <div class="container">
        <div class="acco-contact-inner">
            <div class="contact-content">
                <div class="left-contact-section-main col-md-6">
                    <div class="left-contact-section">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <?php $extag = explode (",", $newsD->tags); 
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
        <?php $exst=0; $tags = App\Models\NewsTag::getTags($type->id); 
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
                <div class="right-contact-section-main col-md-6">
                  <div class="right-contact-section custom-author-sec">
                        <h3>contact details</h3>
                        
                            
                            <?php if($newsD->author)
                            { $authors = explode (",", $newsD->author);  
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

                               <p><span>Email Enquiry:</span><a href="mailto:{{ $author->email }}?subject={{ url('news') }}/{{$newsD->alias}}"> {{ $author->email }}</a></p>
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
    </div>
</section> 

<?php if($newsD->testimonial) { ?>
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
    <h2>{{ $newsD->norder }} <span>{{ $newsData->name }}</span></h2>
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
    <h2>{{ $newsD->proorder }} <span>{{ $prodData->name }}</span></h2>
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
    <h2>{{ $newsD->porder }} <span>{{ $proData->name }}</span></h2>
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
if($accData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $newsD->accorder }} <span>{{ $accData->name }}</span></h2>
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
    <h2>{{ $newsD->sorder }} <span>{{ $servData->name }}</span></h2>
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
    <h2>{{ $newsD->portorder }} <span>{{ $portData->name }}</span></h2>
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
    <h2>{{ $newsD->blogorder }} <span>{{ $blogData->name }}</span></h2>
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
      <h2>{{ $newsD->name }}</h2>
        <div class="acco-detail-inner">
           <div class="acco-detail-content">
             <?php echo $newsD->introduction; ?><br>
             <?php echo $newsD->content; ?>
        </div>
        </div>
    
    </div>
   
</section> 
<?php if(count($newsimgs) >=1) { ?>
      
<section class="acco-gallery news-gallery">
    <div class="acco-gallery-inner">
        <div class="acco-gallery-box">
          <?php foreach ($newsimgs as $img) { ?>
            <div class="gallery-item">
                <img src="{{ asset($img->image) }}" alt="{{$img->imagealt}}">
            </div>
          <?php } ?>
            

        </div>
    </div>
</section>
<?php } ?>
 
<section class="acco-contact service-contact" id="">
    <div class="container">
        <div class="acco-contact-inner">
            <div class="contact-content">
                <div class="left-contact-section-main col-md-6">
                    <div class="left-contact-section">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <?php $extag = explode (",", $newsD->tags); 
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
                        
                            <div class="contact-box">
                            <?php if($newsD->author)
                            { $authors = explode (",", $newsD->author);  
                            foreach ($authors as $id ) {
                           $author = App\Admin\Models\AdminUser::GetAdminUser($id);

                           ?>
                            <div class="user-image">
                            <img src="<?php if($author->avatar) echo asset($author['avatar']); else echo asset('images/index.jpg'); ?> " class="img-thumbnail">
                           </div>
                            <p><span>Name:</span> {{ $author->salutation }}  {{ $author->name }} <?php echo " ".$author->last_name; ?></p>
                                <p><span>Business phone:</span> {{ $author->business_phone }}</p>
                              <p><span>Mobile:</span> {{ $author->cell_number }}</p>                               

                                <p><span>Email Enquiry:</span><a href="mailto:{{ $author->email }}?subject={{ url('news') }}/{{$newsD->alias}}"> {{ $author->email }}</a></p>
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
                                
                                <br>

                                
                            <?php } } ?>
                            </div>
                    </div>
                </div>
            </div>

        </div>
        <p class="address">{{ route('home') }}</p>
    </div>
</section>


  </div>
 

@endsection


@push('styles')
@endpush
@push('scripts')
<script>
$(document).ready(function() { 
  $('.panel-heading .panel-title > a').click(function(){
    $(this).parents('.panel.panel-default').siblings().find('.panel-title').removeClass('active');
    $(this).parent().toggleClass('active');

  });
  $('.removeDiv').parent().remove();
    
    $('.acc-slider').slick({
          dots: true,
          infinite: true,
          slidesToShow: 4,
          adaptiveHeight: true,
          autoplay: true,
          slidesToScroll: 1, 
        });       
    
  });

 </script>
@endpush
