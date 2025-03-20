<?php $expshow = date("Y-m-d", strtotime("+45 day"));
if(sc_store('enddate')<=date('Y-m-d')) { ?> 
<script>window.location.href = "{{ route('expire')}}";</script>"; <?php } ?>
<div class="wrapper">
<?php $admUser =  App\Admin\Admin::user();   
if(!empty($admUser)) {
if($expshow >= sc_store('enddate')) { echo '<p class="header-warning">Warning: This site will expire on '.sc_store('enddate').'!</p>'; } } ?>


<?php $userAct = App\Models\HeaderMenu::getMenu(7);
$cartAct = App\Models\HeaderMenu::getMenu(8);
$currAct = App\Models\HeaderMenu::getMenu(6);
?>
<div class="topbar" style="<?php //if($userAct->status==0 && $currAct->status==0 && $cartAct->status==0 ) echo 'display: none'; ?>">
<div class="container">
  <div class="topbar-inner">
    <div class="topbar-content">
      <div class="topbar-text">
         <?php if($userAct->status) { ?>
        <ul class="user-meunu">
           @guest
              {{-- <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Log in or Create an account </a></li> --}}
              <li>
                  <h2>{{ sc_store('title') }}</h2>
                  <span><a href="tel:+27769762629">Call us now : {{sc_store('phone')}}</a></span> <br>
                  <span><a href="mailto:webmaster@ezipezi.com">Email : {{sc_store('email')}}</a></span>
				  <br>
              </li>
              @else                
              <?php
              $user = Auth::user(); ?>
              <li><a href="{{ route('member.index') }}"><i class="fa fa-user"></i> {{$user->username}}  </a></li>
              <li><a href="{{ route('logout') }}" rel="nofollow" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ trans('front.logout') }}</a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @endguest
        </ul>
      <?php } ?>
      </div>
      <div class="topbar-btn">
        <?php  if($cartAct->status) { ?>
        <ul class="nav navbar-nav">
              @php
              $cartsCount = \Cart::count();
              @endphp
              {{-- <li><a href="{{ route('cart') }}"><span class="cart-qty sc-cart" id="shopping-cart">{{ Cart::instance('default')->count() }}</span> view favourites</a></li> --}}
              <li>
                <marquee behavior="scroll" direction="left">{{ sc_store('description') }}</marquee>
              </li>
            </ul>
          <?php } ?>
      </div>
      <?php  if($currAct->status) { ?>
      <div class="topbar-selectbox">

        <ul>
          <li><a href="{{ route('login') }}">Login or Register</a></li>
          <li>
              <select>
                  <option>currency</option>
              </select> 
          </li>
          <li class="icon-cart"><a href="{{ route('cart') }}">{{ Cart::instance('default')->count() }}</a></li>
        </ul>
        {{-- <label for="currency-select">Currency:</label> --}}
      
        {{-- @if (count($currencies)>1)
             <div class="btn-group locale">
              <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                {{ sc_currency_info()['name'] }}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                @foreach ($currencies as $key => $currency)
                  <li><a href="{{ url('currency/'.$currency->code) }}">{{ $currency->name }}</a></li>
                @endforeach
              </ul>
            </div>
            @endif  --}}
      </div>
       <?php } ?>
    </div>
  </div>
</div>
</div>

{{-- Moddle header start--}}
<div class="middle-header">
  <div class="container">
    <div class="middle-header-inner">
      <div class="middle-header-column middle-header-column-one">
        <ul>
          <li><a href="#">FIND A STORE</a></li>
          <li><a href="#">CREDIT CARD</a></li>
          <li><a href="#">GIFT CARD</a></li>
        </ul>
      </div>
      <div class="middle-header-column middle-header-column-two">
        <img src="{{ asset(sc_store('logo')) }}" alt="img">
      </div>
      <div class="middle-header-column middle-header-column-three">
        <div id="sosearchpro-custom" class="sosearchpro-wrapper so-search ">
          <form method="GET" action="index.php">
            <div id="search-function-header" class="search input-group form-group">
              <input class="autosearch-input form-control" type="search" value="" size="50" autocomplete="off" placeholder="Keyword here..." name="search"><ul class="dropdown-menu" style="display: none;"></ul>
              <button type="submit" class="button-search btn btn-default btn-lg" name="submit_search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Moddle header end--}}
        
<header>
	<div class="container">
	  <div class="header-inner">
		<div class="header-content">
		  <div class="navbar">
			<ul class="main-list-parent desktop-view-navigation">
			  <li>
					<a href="{{ route('home') }}">Welcome</a>
			  </li>
			  {{-- about menus start here  --}}
			  @php
$cmsCat = App\Models\Widget::getncmsCat();
@endphp

@if(!empty($cmsCat) && count($cmsCat))
    @foreach($cmsCat as $cmcat)
        <li class="dropdown-menu-list">
            <a href="#" title="menu">{{ $cmcat->title }} <span class="caret-icon">&nbsp;</span></a>
            @php
            $subCat = App\Models\Widget::getcmsContent($cmcat->id);
            @endphp
            @if(!empty($subCat) && count($subCat))
                <ul class="sub-menu-header-list blog-menu-col-five">
                    @foreach($subCat as $subc)
                        <li>
                            <a href="#" title="{{ $subc->title }}">
                                <img src="{{ $subc->image }}" alt="{{ $subc->title }}">
                            </a>
                            <p class="menu-name">
                                <a href="{{url('/entry/'.$subc->alias)}}.php" title="{{ $subc->title }}">{{ $subc->title }}</a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
@else
    <li>
        <a href="{{ url('/entry/'.$cmcat->alias) }}" title="menu">{{ $cmcat->title }}</a>
    </li>
@endif


			  {{-- about menu ends here --}}


			  {{-- products menus start --}}
			  @php
			     $winemenu = App\Models\HeaderMenu::getMenu(1);
			  @endphp
			  
			  <li class="dropdown-menu-list">
				@if($winemenu->status)
				<a href="{{ route('product.all') }}" title="menu">{{ $winemenu->name }} <span class="caret-icon">&nbsp;</span></a>
			  @endif
				<ul class="sub-menu-header-list four-column">
					@php
					      use App\Models\ProCat;
                          use App\Models\ProType;
						  $protypes = ProType::all();
					@endphp
				  @foreach($protypes as $protype)
					<li class="shop-page-drodown-col collection-menu-col">
						<ul>
						<li>
							<a href="#" class="menuitem-shop" target="_top">
							<img src="{{ $protype->image }}" alt="{{ $protype->name }}">
							</a>
						</li>
						<li>
							<a href="{{ url('product/category') }}/{{$protype->alias}}" class="title-shoppage">{{ $protype->name }}</a>
						</li>
						@php
							  $procats = ProCat::where('protype',$protype->id)->where('status',1)->get(); 
						@endphp
						@foreach($procats as $procat)
							<li>
								{{-- <a href="{{ url('search.php?protype=11&procat=2') }}/{{ $protype->id }}" class="menuitem-shop" target="_top">{{ $procat->name }}</a> --}}
								<a href="{{ url('search.php?protype=' . $protype->id . '&procat=' . $procat->id) }}" class="menuitem-shop" target="_top">
									{{ $procat->name }}
								</a>
							</li>
						@endforeach

						</ul>
					</li>
				  @endforeach
				</ul>
			  </li>
			  {{-- products menus start --}}

			  {{-- service menu start --}}
			  @php
			  $servcmenu = App\Models\HeaderMenu::getMenu(3);
			  @endphp
			  @if($servcmenu->status)
			  <li class="dropdown-menu-list">
				<a href="{{ route('services.all') }}" title="menu">{{ $servcmenu->name }}<span class="caret-icon">&nbsp;</span></a>
				@php
				$stypes = App\Models\Service::getHeaderCats();
				@endphp
				@if(count($stypes) >= 1)
				<ul class="sub-menu-header-list blog-menu-col-five">
					@foreach($stypes as $dd)
					@php
						$type = App\Models\ServiceType::getSingleCat($dd->servicetype);
					@endphp
					<li>
						<a href="{{ url('services/category') }}/{{$type->alias}}" title="menu">
							<img src="{{ $type->image }}">
						</a>
						<p class="menu-name">
							<a href="{{ url('services/category') }}/{{$type->alias}}" title="menu">{{ $type->name }}</a>
						</p>
					</li>
					@endforeach
				</ul>
				@endif
			</li>
			@endif
			   {{-- service menu end --}}
			@php
			$propmenu = App\Models\HeaderMenu::getMenu(4);
			@endphp
			@if($propmenu->status)
			  <li>
				<a href="{{ route('property.all') }}" title="menu">{{ $propmenu->name }}</a>
			  </li>
			@endif

			@php
			$accmenu = App\Models\HeaderMenu::getMenu(5);
			@endphp
			@if($accmenu->status)
			  <li>
				<a href="{{ route('accommodation.all') }}" title="menu">{{ $accmenu->name }}</a>
			  </li>
			@endif

			{{-- news section seart here --}}
			@php
			$thewine = App\Models\HeaderMenu::getMenu(2);
			@endphp
			@if($thewine->status)
			  <li class="dropdown-menu-list">
				<a href="{{ route('news') }}" title="menu">{{ $thewine->name }}<span class="caret-icon">&nbsp;</span>
				</a>
				@php
				$vinetypes = App\Models\Blog::getHeaderCats();
				@endphp
				@if(count($vinetypes))
				<ul class="sub-menu-header-list four-column two-column-menu">
				  @foreach($vinetypes as $dd)
				  @php
				  $type = App\Models\NewsType::getsingleCat($dd->newstype); 
				  @endphp
				  <li class="shop-page-drodown-col new-arrival-menu-col">
					<ul>
					  <li>
						<a href="{{ url('news/category') }}/{{$type->alias}}" class="menuitem-shop" target="_top">{{ $type->name }}</a>
					  </li>
					</ul>
				  </li>
				  @endforeach
				</ul>
				@endif
			  </li>
			@endif
			  {{-- news section seart here --}}
			@php
			$blogmenu = App\Models\HeaderMenu::getMenu(13);
			@endphp
			@if($blogmenu->status)
			  <li class="dropdown-menu-list">
				<a href="{{ route('blog.all') }}" title="menu">{{ $blogmenu->name }} <span class="caret-icon">&nbsp;</span>
				</a>
				@php
				$stypes = App\Models\NewBlog::getHeaderCats();
				@endphp
				@if(count($stypes) >= 1)
				<ul class="sub-menu-header-list blog-menu-col-five">
					@foreach ($stypes as $dd) 
					@php
					$type = App\Models\BlogType::getSingleCat($dd->blogtype);
					@endphp
				  <li>
					<a href="#" title="menu">
					  <img src="{{ $type->image }}">
					</a>
					<p class="menu-name">
					  <a href="{{ url('blog/category') }}/{{$type->alias}}" title="menu">{{ $type->name }}</a>
					</p>
				  </li>
				  @endforeach
				</ul>
				@endif
			  </li>
			@endif

			<?php $cmsCat = App\Models\Widget::getcmsCat();
			if (!empty($cmsCat)) {
			  foreach ($cmsCat as $cmcat) {
				$subCat = App\Models\Widget::getcmsContent($cmcat->id);

				if (count($subCat) > 1) {
			?>
				  <li class="dropdown"><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}<i class="fa fa-angle-down"></i></a>
					<ul role="menu" class="sub-menu">
					  <?php foreach ($subCat as $subc) {
						if ($subc->title != $cmcat->title) {

					  ?>
						  <li><a href="{{url('/entry/'.$subc->alias)}}.php">{{ $subc->title }} </a></li>
					  <?php

						}
					  } ?>
					</ul>
				  </li>
				<?php } elseif ($cmcat->alias == 'welcome') {
				} else { ?>

				  <li><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}</a></li>
			<?php }
			  }
			} ?>
			  {{-- <li>
				<a href="#" title="menu">sale </a>
			  </li> --}}
			  
			</ul>
		  </div>




		  
		  <!-- toggler -->
		  <div class="nav-toggler">
			<div class="nav-btn">
			  <span></span>
			  <span></span>
			  <span></span>
			</div>
			<div class="menu-bar">
			  <div class="close-icon-for-mobile">
				<span>
				  <i class="fa fa-times" aria-hidden="true"></i>
				</span>
			  </div>
			  <ul class="main-list-parent mobile-view-navigation">
				<li class="dropdown-menu-list dropdown-menu-list-layout">
				  <a href="#" title="menu">layouts <span class="caret-icon">&nbsp;</span>
				  </a>
				  <ul class="sub-menu-header-list">
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images/home1.jpg">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">home1</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images/home1.jpg">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">home2</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images/home1.jpg">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">home3</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//home1.jpg">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">home4</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//home1.jpg">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">home5</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//home1.jpg">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">home6</a>
					  </p>
					</li>
				  </ul>
				</li>
				<li class="dropdown-menu-list dropdown-menu-list-features">
				  <a href="#" title="menu">features <span class="caret-icon">&nbsp;</span>
				  </a>
				  <ul class="sub-menu-header-list four-column">
					<li class="shop-page-drodown-col feature-menu-col">
					  <a href="#" class="title-shoppage">Shop pages</a>
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Outside content) </span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Inside content)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Outside content)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Inside content)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar left, right <span class="submenuitem">(Off Canvas)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">All sidebar <span class="submenuitem">(Layout Fluid)</span>
						  </a>
						</li>
						<li class="submenu-shop">
						  <a href="#" class="menuitem-shop" target="_top">Category features <span class="menu-label menu-label-new">new</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Refine search more</a>
						</li>
					  </ul>
					</li>
					<li class="feature-menu-col">
					  <a href="#" class="title-shoppage">Shop style</a>
					  <ul>
						<li class="submenu-shop">
						  <b class="fa fa-angle-right" aria-hidden="true"></b>
						  <a href="#" class="menuitem-shop">Grid columns <span class="menu-label menu-label-hot">HOT</span>
						  </a>
						  <ul>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">2 columns </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">3 columns </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">4 columns </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">5 columns </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">List columns </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Table columns </a>
							</li>
						  </ul>
						</li>
						<li class="submenu-shop">
						  <b class="fa fa-angle-right" aria-hidden="true"></b>
						  <a href="#" class="menuitem-shop">Cart info <span class="menu-label menu-label-new">new</span>
						  </a>
						  <ul>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Align left</a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Align right </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Align center </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Align bottom </a>
							</li>
						  </ul>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Quick shop products </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Countdown of special offer </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Show orders</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Out of stock</a>
						</li>
						<li class="submenu-shop">
						  <a href="#" class="menuitem-shop" target="_top">Color swatches pro <span class="menu-label menu-label-hot">HOT</span>
						  </a>
						</li>
					  </ul>
					</li>
					<li class="feature-menu-col">
					  <a href="#" class="title-shoppage">Product Page </a>
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Outside content)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Inside content)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Outside content)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Inside content)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Sidebar left, right <span class="submenuitem">(Off Canvas)</span>
						  </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">All sidebar <span class="submenuitem">(Layout Fluid)</span>
						  </a>
						</li>
					  </ul>
					</li>
					<li class="feature-menu-col">
					  <a href="#" class="title-shoppage">Product style</a>
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop">Checkbox and radio style </a>
						</li>
						<li class="submenu-shop">
						  <b class="fa fa-angle-right" aria-hidden="true"></b>
						  <a href="#" class="menuitem-shop">Product gallery <span class="menu-label menu-label-new">new</span>
						  </a>
						  <ul>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Style bottom </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Style left </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Style grid </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Style list </a>
							</li>
							<li>
							  <a href="#" class="menuitem-shop" target="_top">Style slider </a>
							</li>
						  </ul>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Zoom image </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Image size chart </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Tabs vertical </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Tabs horizontal </a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Show orders</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Color swatches pro</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Countdown of special offer</a>
						</li>
						<li class="submenu-shop">
						  <a href="#" class="menuitem-shop" target="_top">Videos <span class="menu-label menu-label-new">new</span>
						  </a>
						</li>
						<li class="submenu-shop">
						  <a href="#" class="menuitem-shop" target="_top">Custom tab <span class="menu-label menu-label-new">new</span>
						  </a>
						</li>
					  </ul>
					</li>
					<div class="menu-header-image-dropdown">
					  <div class="two-col">
						<div class="column-img">
						  <img src="../images/theme-images/menu-guide.jpg" alt="img">
						</div>
						<div class="column-img">
						  <img src="../images/theme-images/menu-guide.jpg" alt="img">
						</div>
					  </div>
					</div>
				  </ul>
				</li>
				<li class="dropdown-menu-list">
				  <a href="#" title="menu">collections <span class="caret-icon">&nbsp;</span>
				  </a>
				  <ul class="sub-menu-header-list four-column">
					<li class="shop-page-drodown-col collection-menu-col">
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">
							<img src="../images/theme-images//image-1.jpg" alt="img">
						  </a>
						</li>
						<li>
						  <a href="#" class="title-shoppage">Kids</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Aspering</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Boy</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Consectetur</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Duis aute</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Excepteur</a>
						</li>
					  </ul>
					</li>
					<li class="shop-page-drodown-col collection-menu-col">
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">
							<img src="../images/theme-images//image-2.jpg" alt="img">
						  </a>
						</li>
						<li>
						  <a href="#" class="title-shoppage">Clothers</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Dolor emque</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Mollit anim</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Speaker for car</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Dash Cam</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Pampers</a>
						</li>
					  </ul>
					</li>
					<li class="shop-page-drodown-col collection-menu-col">
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">
							<img src="../images/theme-images//image-3.jpg" alt="img">
						  </a>
						</li>
						<li>
						  <a href="#" class="title-shoppage">Mens</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Accessories</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Food miles</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Food miles</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Milk</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Snacks</a>
						</li>
					  </ul>
					</li>
					<li class="shop-page-drodown-col collection-menu-col">
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">
							<img src="../images/theme-images//image-4.jpg" alt="img">
						  </a>
						</li>
						<li>
						  <a href="#" class="title-shoppage">Furniture</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Duis aute</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Esse cillum</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Excepteur</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Hand Tools</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Impact Wrehes</a>
						</li>
					  </ul>
					</li>
				  </ul>
				</li>
				<li>
				  <a href="#" title="menu">womens</a>
				</li>
				<li class="dropdown-menu-list">
				  <a href="#" title="menu">new arrival <span class="caret-icon">&nbsp;</span>
				  </a>
				  <ul class="sub-menu-header-list four-column two-column-menu">
					<li class="shop-page-drodown-col new-arrival-menu-col">
					  <ul>
						<li>
						  <a href="#" class="title-shoppage">Womens</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">For boy</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">For girl</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Duis aute</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Laudantium</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">For boy</a>
						</li>
					  </ul>
					</li>
					<li class="shop-page-drodown-col new-arrival-menu-col">
					  <ul>
						<li>
						  <a href="#" class="title-shoppage">Clothers</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Dash Cam</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Dolor emque</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Screen TV</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Smartwatch</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Screen TV</a>
						</li>
					  </ul>
					</li>
					<div class="dropdown-single-image">
					  <img src="../images/theme-images/image-5.jpg" alt="img">
					</div>
				  </ul>
				</li>
				<li>
				  <a href="#" title="menu">mens</a>
				</li>
				{{-- pages start here --}}
				<li class="dropdown-menu-list">
				  <a href="#" title="menu">pages <span class="caret-icon">&nbsp;</span>
				  </a>
				  <ul class="sub-menu-header-list four-column two-column-menu">
					<li class="shop-page-drodown-col new-arrival-menu-col">
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">About Us</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Services</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">FAQs</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Contact us</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Support 24/7 Page</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Typography</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Photo Gallery</a>
						</li>
					  </ul>
					</li>
					<li class="shop-page-drodown-col new-arrival-menu-col">
					  <ul>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">SiteMap</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Page 404</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Coming Soon</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Testimonials</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Best Seller</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">New Arrivals</a>
						</li>
						<li>
						  <a href="#" class="menuitem-shop" target="_top">Most Rated</a>
						</li>
					  </ul>
					</li>
				  </ul>
				</li>
				{{-- pages end here --}}

				{{-- blog start here --}}
				@php
				  $blogmenu = App\Models\HeaderMenu::getMenu(13);
				@endphp
				@if($blogmenu->status)
				<li class="dropdown-menu-list">
				  <a href="{{ route('blog.all') }}" title="menu">{{ $blogmenu->name }}<span class="caret-icon">&nbsp;</span>
				  </a>
				  @php
				   $stypes = App\Models\NewBlog::getHeaderCats();
				  @endphp
				  @if(count($stypes) >= 1)
				  <ul class="sub-menu-header-list blog-menu-col-five">
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//blog-col1.png">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">blog1</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//blog-col1.png">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">blog2</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//blog-col1.png">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">blog3</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//blog-col1.png">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">blog4</a>
					  </p>
					</li>
					<li>
					  <a href="#" title="menu">
						<img src="../images/theme-images//blog-col1.png">
					  </a>
					  <p class="menu-name">
						<a href="#" title="menu">blog5</a>
					  </p>
					</li>
					<div class="six-column-blog">
					  <div class="blog-menu-column">
						<li>
						  <a href="#" title="menu">
							<img src="../images/theme-images//article-default.png">
						  </a>
						  <p class="menu-name">
							<a href="#" title="menu">blog1</a>
						  </p>
						</li>
						<li>
						  <a href="#" title="menu">
							<img src="../images/theme-images//article-default.png">
						  </a>
						  <p class="menu-name">
							<a href="#" title="menu">blog2</a>
						  </p>
						</li>
						<li>
						  <a href="#" title="menu">
							<img src="../images/theme-images//article-default.png">
						  </a>
						  <p class="menu-name">
							<a href="#" title="menu">blog3</a>
						  </p>
						</li>
						<li>
						  <a href="#" title="menu">
							<img src="../images/theme-images//article-default.png">
						  </a>
						  <p class="menu-name">
							<a href="#" title="menu">blog4</a>
						  </p>
						</li>
						<li>
						  <a href="#" title="menu">
							<img src="../images/theme-images//article-default.png">
						  </a>
						  <p class="menu-name">
							<a href="#" title="menu">blog5</a>
						  </p>
						</li>
						<li>
						  <a href="#" title="menu">
							<img src="../images/theme-images//article-default.png">
						  </a>
						  <p class="menu-name">
							<a href="#" title="menu">blog6</a>
						  </p>
						</li>
					  </div>
					</div>
				  </ul>
				  @endif
				</li>
				@endif
				
				{{-- blog end here  --}}
				{{-- <li>
				  <a href="#" title="menu">sale </a>
				</li> --}}
			  </ul>
			</div>
		  </div>
		  <!-- toggler-ends -->
		</div>
	  </div>
	</div>
  </header>


  