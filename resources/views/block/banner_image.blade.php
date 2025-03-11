  @php
      $banners = \App\Models\ShopBanner::where('status', 1)->where('type', 0)->sort()->get();
  @endphp
  <?php $slides = App\Models\Slider::getSlider(6);
  
  ?>
  @if (!empty($slides))
      <section class="banner-outer">
          <div class="banner-slider">
              <?php $slcnt = 1; ?>
              @foreach ($slides as $banner)
                  <div class="banner slider-{{ $slcnt }}"
                      style="background-image: url('{{ asset($banner->image) }}');">
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
