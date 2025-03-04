  @php
      $banners = \App\Models\ShopBanner::where('status', 1)->where('type', 0)->sort()->get();
  @endphp
  <?php $slides = App\Models\Slider::getSlider(6);
  
  ?>
  @if (!empty($slides))
      {{-- <section class="banner-outer">
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
      </section> --}}


      <section class="banner-bg">
          <div class="container">
              <div class="banner-slider-main">

                  <!--Module banner -->

                  <?php $slcnt = 1; ?>
                  @foreach ($slides as $banner)
                 
                      <div class="inner-banner-slider"
                          style="background-image: url('{{ asset($banner->image) }}')">
                          <div class="animated-banner-content">
                              <h2 class="animate fade-down3"><span class="ctm-gray-light-color">introducing</span></h2>
                              <h1 class="ctm-dark-black animate fade-down2">Peace, Love & Prints</h1>
                              <p class="ctm-mt-10 animate fade-down">{!! $banner->description !!}</p>
                              <div class="explore-now-btn ctm-mt-20">
                                  <ul>
                                      <li><a href="#" title="explore now" class="common-secondary-button"> explore
                                              now
                                          </a>
                                      </li>
                                      <li><a href="#" title=" hop the collab" class="common-secondary-button">hop
                                              the
                                              collab
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <!--//Module banner -->
                  @endforeach




              </div>
          </div>
      </section>
  @endif
