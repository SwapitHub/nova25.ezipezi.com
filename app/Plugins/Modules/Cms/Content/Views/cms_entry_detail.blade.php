@extends($templatePath.'.shop_layout')

@section('main')

<?php 
 $slides = App\Models\Slider::getSlider($entry_currently->id);  

if  (count($slides) >=1) { ?>   
<!-- <section class="slider-sec">
  <div class="slider">
    <?php foreach($slides as $slide) { ?>
  <div>
    <img src="{{ asset($slide->image) }}" class="girl img-responsive" alt="" />
  </div>
<?php } ?>
</div>
</section> -->

<section class="banner-outer cms-banner">
<div class="banner-slider slider">
  <?php $slcnt=1; ?>
@foreach ($slides as $banner)
<div class="banner slider-{{$slcnt}}" style="background-image: url('{{ asset($banner->image) }}');">
  <div class="container">
    <div class="banner-inner">
      <div class="banner-content">
        <?php echo $banner->description; ?>
        
      </div>
    </div>
  </div>
</div>
<?php $slcnt++; ?>
@endforeach



</div>  
</section>
<?php } else {  ?>

 

 <section class="banner_product-listing" style="background-image: url('{{ asset($entry_currently->image) }}');">
  
</section>
<?php } ?>

<section class="content-page">
    <div class="container">
        <div class="row">
            <h2 class="title text-center">{{ $title }}</h2>
            {!! sc_html_render($entry_currently->content) !!}
        </div>
        <?php if(!empty($admin)) {
      if($admin->role==1) { ?>
        <div class="edit-post-link">
          <a target="_blank" href="{{ route('admin_cms_content.edit', ['id' => $entry_currently->id]) }}">Edit post</a>
        </div>
      <?php } } ?>
    </div>
</section>

<?php if($entry_currently->testimonial) { ?>
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


<?php  if(count($footerNews) >=1) { 
  $newsData = App\Models\HeaderMenu::getMenu(2);
  if($newsData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $entry_currently->norder }} <span>{{ $newsData->name }}</span></h2>
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
    <h2>{{ $entry_currently->proorder }} <span>{{ $prodData->name }}</span></h2>
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
    <h2>{{ $entry_currently->porder }} <span>{{ $proData->name }}</span></h2>
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
if($accData->status) {?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $entry_currently->accorder }} <span>{{ $accData->name }}</span></h2>
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
<?php }  } ?>
 

<?php if(count($footerService) >=1) {
$servData = App\Models\HeaderMenu::getMenu(3);
if($servData->status) { ?>

<section class="news">
  <div class="container">
    <div class="news-inner">
    <h2>{{ $entry_currently->sorder }} <span>{{ $servData->name }}</span></h2>
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
    <h2>{{ $entry_currently->portorder }} <span>{{ $portData->name }}</span></h2>
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
    <h2>{{ $entry_currently->blogorder }} <span>{{ $blogData->name }}</span></h2>
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
@endsection

@section('breadcrumb')
   <!--  <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{ $entry_currently->category->getUrl() }}">{{ $entry_currently->category->title }}</a></li>
          <li class="active">{{ $title }}</li>
        </ol>
      </div> -->
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
    var footer = '<?php echo $entry_currently->footer; ?>';
    if(footer==0) {
      $('footer').remove();
    }
 



 });
</script>
@endpush