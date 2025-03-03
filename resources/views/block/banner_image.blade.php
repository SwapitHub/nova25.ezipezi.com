  @php
    $banners = \App\Models\ShopBanner::where('status', 1)->where('type', 0)->sort()->get()   
  @endphp
  <?php  $slides = App\Models\Slider::getSlider(6); 

  ?>
 @if (!empty($slides))
 <?php /*
 <section id="slider"><!--slider-->
   
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php $slcnt=0; ?>
              @foreach ($slides as $banner)
              <li data-target="#slider-carousel" data-slide-to="{{ $slcnt }}" class="<?php if($banner->id==1) echo 'active'; ?>"></li>
              <?php $slcnt++; ?>
              @endforeach
            </ol>
           <div class="carousel-inner">
               @foreach ($slides as $banner)
                  <div class="item <?php if($banner->id==1) echo 'active'; ?>">
                    <div class="col-sm-12">
                      <a href="" ><img src="{{ asset($banner->image) }}" class="girl img-responsive" alt="" /></a>
                      <div>
                        <?php echo $banner->description; ?>
                      </div>
                    </div>
                  </div>
               @endforeach
            </div> 
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>

        </div>
      </div>
  
  </section><!--/slider-->
  */?>

  <section class="banner-outer">
<div class="banner-slider">
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
@endif
