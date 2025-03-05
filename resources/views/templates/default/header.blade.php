{{-- <?php $expshow = date("Y-m-d", strtotime("+45 day"));
if(sc_store('enddate')<=date('Y-m-d')) { ?> 
  <script>window.location.href = "{{ route('expire')}}";</script>"; <?php } ?>
<div class="wrapper">
<?php $admUser = App\Admin\Admin::user();
if (!empty($admUser)) {
    if ($expshow >= sc_store('enddate')) {
        echo '<p class="header-warning">Warning: This site will expire on ' . sc_store('enddate') . '!</p>';
    }
} ?>


<?php $userAct = App\Models\HeaderMenu::getMenu(7);
$cartAct = App\Models\HeaderMenu::getMenu(8);
$currAct = App\Models\HeaderMenu::getMenu(6);
?>
<div class="topbar" style="<?php //if($userAct->status==0 && $currAct->status==0 && $cartAct->status==0 ) echo 'display: none';
?>">
  <div class="container">
    <div class="topbar-inner">
      <div class="topbar-content">
        <div class="topbar-text">
           <?php if($userAct->status) { ?>
          <ul class="user-meunu">
             @guest
                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Log in or Create an account </a></li>
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
                <!-- <li><a href="{{ route('wishlist') }}"><span  class="cart-qty  sc-wishlist" id="shopping-wishlist">{{ Cart::instance('wishlist')->count() }}</span><i class="fa fa-star"></i> {{ trans('front.wishlist') }}</a></li> -->
               <!--  <li><a href="{{ route('compare') }}"><span  class="cart-qty sc-compare" id="shopping-compare">{{ Cart::instance('compare')->count() }}</span><i class="fa fa-crosshairs"></i> {{ trans('front.compare') }}</a></li> -->
                <li><a href="{{ route('cart') }}"><span class="cart-qty sc-cart" id="shopping-cart">{{ Cart::instance('default')->count() }}</span> view favourites</a>
                </li>
                
               <!--  @guest
                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ trans('front.login') }}</a></li>
                @else
                <li><a href="{{ route('member.index') }}"><i class="fa fa-user"></i> {{ trans('front.account') }}</a></li>
                <li><a href="{{ route('logout') }}" rel="nofollow" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ trans('front.logout') }}</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                @endguest -->

              </ul>
            <?php } ?>
          <!-- @php
          $cartsCount = \Cart::count();
           @endphp
          <a href="{{ route('cart') }}"><span class="cart-qty sc-cart" id="shopping-cart">{{ Cart::instance('default')->count() }}</span> view favourites</a> -->
        </div>
        <?php  if($currAct->status) { ?>
        <div class="topbar-selectbox">
          <label for="currency-select">Currency:</label>
        
          @if (count($currencies) > 1)
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
              @endif 
           
         <!--  <select name="currency" id="currency-select">
              <option selected value="">south african rand</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
          </select> -->
        </div>
         <?php } ?>
      </div>
    </div>
  </div>
</div>  
          
<header>
  <div class="container">
    <div class="header-inner">
     <div class="header-content">
      <div class="logo">
      <div class="logo-img">
        <a href="{{ route('home') }}"><img src="{{ asset(sc_store('logo')) }}" alt="{{ sc_store('logo_alt') }}"></a>

      </div>
      </div>
      <div class="navbar">
        <ul class="nav navbar-nav collapse navbar-collapse">
          <li><a href="{{ route('home') }}">Welcome</a></li>
       <?php  $cmsCat = App\Models\Widget::getncmsCat();   


                if(!empty($cmsCat)) { 
                  foreach($cmsCat as $cmcat) { 
                   $subCat = App\Models\Widget::getcmsContent($cmcat->id);
                  
                   if(count($subCat)>1)
                   {

                     ?>
                     <li class="dropdown"><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}<i class="fa fa-angle-down"></i></a>
                         <ul role="menu" class="sub-menu">
                          <?php foreach($subCat as $subc)  {
                            if($subc->title!=$cmcat->title) {
                                                         
                          ?>
                          <li><a href="{{url('/entry/'.$subc->alias)}}.php">{{ $subc->title }} </a></li>
                        <?php 
                       
                         } }?>
                        </ul>
                    </li>
                    <?php } 
                    else { ?>
                   
                    <li><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}</a></li>
                  <?php } } }?>

          <?php $winemenu = App\Models\HeaderMenu::getMenu(1); if($winemenu->status) { ?>
          <li class="dropdown"><a href="{{ route('product.all') }}">{{ $winemenu->name }}<i class="fa fa-angle-down"></i></a>
            <?php 
            $protypes = App\Models\ShopProduct::getHeaderCats();
              
             if(count($protypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($protypes as $dd) { 
                  $type = App\Models\ProType::catByid($dd->protype);?>                    
                  <li><a href="{{ url('product/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
              <?php } ?>
              </li>
            <?php } ?>
         
       <?php $servcmenu = App\Models\HeaderMenu::getMenu(3); if($servcmenu->status) { ?>
               <li class="dropdown"><a href="{{ route('services.all') }}">{{ $servcmenu->name }}<i class="fa fa-angle-down"></i></a>
                <?php $stypes = App\Models\Service::getHeaderCats(); 

                 if(count($stypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($stypes as $dd) {
                 $type = App\Models\ServiceType::getSingleCat($dd->servicetype); ?>                    
                  <li><a href="{{ url('services/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
       
      <?php $propmenu = App\Models\HeaderMenu::getMenu(4); if($propmenu->status) { ?>
              <li><a href="{{ route('property.all') }}">{{ $propmenu->name }}</a></li>
            <?php } ?>
            <?php $accmenu = App\Models\HeaderMenu::getMenu(5); if($accmenu->status) { ?>
              <li><a href="{{ route('accommodation.all') }}">{{ $accmenu->name }}</a></li>
            <?php } ?>
              <?php $thewine = App\Models\HeaderMenu::getMenu(2); if($thewine->status) { ?>
              <li class="dropdown"><a href="{{ route('news') }}">{{ $thewine->name }}<i class="fa fa-angle-down"></i></a>
                <?php $vinetypes = App\Models\Blog::getHeaderCats(); 
                 if(count($vinetypes) >=1) {
                  ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($vinetypes as $dd) {
                 $type = App\Models\NewsType::getsingleCat($dd->newstype);  ?>                    
                  <li><a href="{{ url('news/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
            <?php $portfmenu = App\Models\HeaderMenu::getMenu(12); if($portfmenu->status) { ?>
               <li class="dropdown"><a href="{{ route('portfolio.all') }}">{{ $portfmenu->name }}<i class="fa fa-angle-down"></i></a>
                <?php $stypes = App\Models\Portfolio::getHeaderCats(); 

                 if(count($stypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($stypes as $dd) {
                 $type = App\Models\PortfolioType::getSingleCat($dd->portfoliotype); ?>                    
                  <li><a href="{{ url('portfolio/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>

             <?php $blogmenu = App\Models\HeaderMenu::getMenu(13); if($blogmenu->status) { ?>
               <li class="dropdown"><a href="{{ route('blog.all') }}">{{ $blogmenu->name }}<i class="fa fa-angle-down"></i></a>
                <?php $stypes = App\Models\NewBlog::getHeaderCats(); 

                 if(count($stypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($stypes as $dd) {
                 $type = App\Models\BlogType::getSingleCat($dd->blogtype); ?>                    
                  <li><a href="{{ url('blog/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
       <?php  $cmsCat = App\Models\Widget::getcmsCat();               
                if(!empty($cmsCat)) { 
                  foreach($cmsCat as $cmcat) { 
                   $subCat = App\Models\Widget::getcmsContent($cmcat->id);
                  
                   if(count($subCat)>1)
                   {
                     ?>
                     <li class="dropdown"><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}<i class="fa fa-angle-down"></i></a>
                         <ul role="menu" class="sub-menu">
                          <?php foreach($subCat as $subc)  {
                            if($subc->title!=$cmcat->title) {
                                                         
                          ?>
                          <li><a href="{{url('/entry/'.$subc->alias)}}.php">{{ $subc->title }} </a></li>
                        <?php 
                       
                         } }?>
                        </ul>
                    </li>
                    <?php } elseif ($cmcat->alias=='welcome') {
                      
                    }
                    else { ?>
                   
                    <li><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}</a></li>
                  <?php } } }?>
    

           <?php $enqmenu = App\Models\HeaderMenu::getMenu(10); if($enqmenu->status) { ?>
              <li><a href="{{ route('contact') }}">{{ $enqmenu->name }}</a></li>
            <?php } ?>
            


          

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
                <ul class="mobile-menu">
                    <li><a href="{{ route('home') }}">Welcome</a></li>
           <?php  $cmsCat = App\Models\Widget::getncmsCat();               
                if(!empty($cmsCat)) { 
                  foreach($cmsCat as $cmcat) { 
                   $subCat = App\Models\Widget::getcmsContent($cmcat->id);
                  
                   if(count($subCat)>1)
                   {
                     ?>
                     <li class="dropdown"><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}</a><i class="fa fa-angle-down"></i>
                          <ul role="menu" class="sub-menu">
                          <?php foreach($subCat as $subc)  {
                            if($subc->title!=$cmcat->title) {
                                                         
                          ?>
                          <li><a href="{{url('/entry/'.$subc->alias)}}.php">{{ $subc->title }} </a></li>
                        <?php 
                       
                         } }?>
                        </ul>
                    </li>
                    <?php } elseif ($cmcat->alias=='welcome') {
                      
                    }
                    else { ?>
                   
                    <li><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}</a></li>
                  <?php } } }?>
                    <?php $winemenu = App\Models\HeaderMenu::getMenu(1); if($winemenu->status) { ?>
          <li class="dropdown rert"><a href="{{ route('product.all') }}">{{ $winemenu->name }}</a><i class="fa fa-angle-down"></i>
            <?php 
            $protypes = App\Models\ShopProduct::getHeaderCats();
              
             if(count($protypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($protypes as $dd) { 
                  $type = App\Models\ProType::catByid($dd->protype);?>                    
                  <li><a href="{{ url('product/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
              <?php } ?>
              </li>
            <?php } ?>

            <?php $servcmenu = App\Models\HeaderMenu::getMenu(3); if($servcmenu->status) { ?>
               <li class="dropdown"><a href="{{ route('services.all') }}">{{ $servcmenu->name }}</a><i class="fa fa-angle-down"></i>
                <?php $stypes = App\Models\Service::getHeaderCats(); 

                 if(count($stypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($stypes as $dd) {
                 $type = App\Models\ServiceType::getSingleCat($dd->servicetype); ?>                    
                  <li><a href="{{ url('services/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
      
              <?php $propmenu = App\Models\HeaderMenu::getMenu(4); if($propmenu->status) { ?>
              <li><a href="{{ route('property.all') }}">{{ $propmenu->name }}</a></li>
            <?php } ?>
            <?php $accmenu = App\Models\HeaderMenu::getMenu(5); if($accmenu->status) { ?>
              <li ><a href="{{ route('accommodation.all') }}">{{ $accmenu->name }}</a></li>
            <?php } ?>
              <?php $thewine = App\Models\HeaderMenu::getMenu(2); if($thewine->status) { ?>
              <li class="dropdown"><a href="{{ route('news') }}">{{ $thewine->name }}</a><i class="fa fa-angle-down"></i>
                <?php $vinetypes = App\Models\Blog::getHeaderCats(); 
                 if(count($vinetypes) >=1) {
                  ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($vinetypes as $dd) {
                 $type = App\Models\NewsType::getsingleCat($dd->newstype);  ?>                    
                  <li><a href="{{ url('news/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
            <?php $portfmenu = App\Models\HeaderMenu::getMenu(12); if($portfmenu->status) { ?>
               <li class="dropdown"><a href="{{ route('portfolio.all') }}">{{ $portfmenu->name }}</a><i class="fa fa-angle-down"></i>
                <?php $stypes = App\Models\Portfolio::getHeaderCats(); 

                 if(count($stypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($stypes as $dd) {
                 $type = App\Models\PortfolioType::getSingleCat($dd->portfoliotype); ?>                    
                  <li><a href="{{ url('portfolio/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
            <?php $blogmenu = App\Models\HeaderMenu::getMenu(13); if($blogmenu->status) { ?>
               <li class="dropdown"><a href="{{ route('blog.all') }}">{{ $blogmenu->name }}</a><i class="fa fa-angle-down"></i>
                <?php $stypes = App\Models\NewBlog::getHeaderCats(); 

                 if(count($stypes) >=1) { ?>
                 <ul role="menu" class="sub-menu">   
                 <?php foreach ($stypes as $dd) {
                 $type = App\Models\BlogType::getSingleCat($dd->blogtype); ?>                    
                  <li><a href="{{ url('blog/category') }}/{{$type->alias}}">{{ $type->name }}</a></li>
                <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
   <?php  $cmsCat = App\Models\Widget::getcmsCat();               
                if(!empty($cmsCat)) { 
                  foreach($cmsCat as $cmcat) { 
                   $subCat = App\Models\Widget::getcmsContent($cmcat->id);
                  
                   if(count($subCat)>1)
                   {
                     ?>
                     <li class="dropdown"><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}</a><i class="fa fa-angle-down"></i>
                          <ul role="menu" class="sub-menu">
                          <?php foreach($subCat as $subc)  {
                            if($subc->title!=$cmcat->title) {
                                                         
                          ?>
                          <li><a href="{{url('/entry/'.$subc->alias)}}.php">{{ $subc->title }} </a></li>
                        <?php 
                       
                         } }?>
                        </ul>
                    </li>
                    <?php } elseif ($cmcat->alias=='welcome') {
                      
                    }
                    else { ?>
                   
                    <li><a href="{{url('/entry/'.$cmcat->alias)}}.php">{{ $cmcat->title }}</a></li>
                  <?php } } }?>

                  <?php $enqmenu = App\Models\HeaderMenu::getMenu(10); if($enqmenu->status) { ?>
              <li><a href="{{ route('contact') }}">{{ $enqmenu->name }}</a></li>
            <?php } ?>
           
         
                </ul>
                </div>
            </div>
            <!-- toggler-ends -->
      
    </div>
    </div>
  </div>
</header> --}}


<section class="header">
  <div class="top-header-baar">
    <div class="container">
      <div class="top-header-baar-content">
        <span class="code-discount">Extra <span style="font-size: 20px;">40% </span> OFF some final sale styles * Your Purrchase ( CODE: NOVASHOP)</span> <a class="link-discount" href="">SHOP NEUTRALS</a>
      </div>
    </div>
  </div>
  
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
          <img src="{{ asset($templateFile . '/images/theme-images') }}/logo.png" alt="img">
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
  
  <div class="main-header-menu">
    <div class="container">
      <div class="menu-list-header">
        <div class="close-icon-for-mobile">
          <span><i class="fa-solid fa-xmark"></i></span>
        </div>
        <ul class="main-list-parent">
          <li class="dropdown-menu-list dropdown-menu-list-layout">
            <a href="#" title="menu">layouts <span class="caret-icon">&nbsp;</span></a>
            <ul class="sub-menu-header-list">
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/home1.jpg"></a>
                <p class="menu-name"><a href="#" title="menu">home1</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/home1.jpg"></a>
                <p class="menu-name"><a href="#" title="menu">home2</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/home1.jpg"></a>
                <p class="menu-name"><a href="#" title="menu">home3</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/home1.jpg"></a>
                <p class="menu-name"><a href="#" title="menu">home4</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/home1.jpg"></a>
                <p class="menu-name"><a href="#" title="menu">home5</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/home1.jpg"></a>
                <p class="menu-name"><a href="#" title="menu">home6</a></p>
              </li>
            </ul>
          </li>
          <li class="dropdown-menu-list dropdown-menu-list-features">
            <a href="#" title="menu">features <span class="caret-icon">&nbsp;</span></a>
              <ul class="sub-menu-header-list four-column">
              <li class="shop-page-drodown-col feature-menu-col">
                <a href="#" class="title-shoppage">Shop pages</a>
              <ul>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Outside content) </span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Inside content)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Outside content)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Inside content)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar left, right <span class="submenuitem">(Off Canvas)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">All sidebar <span class="submenuitem">(Layout Fluid)</span></a></li>
                <li class="submenu-shop"><a href="#" class="menuitem-shop" target="_top">Category features <span class="menu-label menu-label-new">new</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Refine search more</a></li>
              </ul>
              </li>
              <li class="feature-menu-col">
                <a href="#" class="title-shoppage">Shop style</a>
              <ul>
                <li class="submenu-shop">
                <b class="fa fa-angle-right" aria-hidden="true"></b> 
                <a href="#" class="menuitem-shop">Grid columns <span class="menu-label menu-label-hot">HOT</span></a>
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top">2 columns </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">3 columns </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">4 columns </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">5 columns </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">List columns </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Table columns </a></li>
                </ul>
                </li>
                
                <li class="submenu-shop">
                <b class="fa fa-angle-right" aria-hidden="true"></b> 
                <a href="#" class="menuitem-shop">Cart info <span class="menu-label menu-label-new">new</span> </a>
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top">Align left</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Align right </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Align center </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Align bottom </a></li>         
                </ul>
                </li>
                <li><a href="#" class="menuitem-shop" target="_top">Quick shop products </a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Countdown of special offer </a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Show orders</a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Out of stock</a></li>
                <li class="submenu-shop"><a href="#" class="menuitem-shop" target="_top">Color swatches pro <span class="menu-label menu-label-hot">HOT</span></a></li>
              </ul>
              </li>
              
              <li class="feature-menu-col">
                <a href="#" class="title-shoppage">Product Page </a>
              <ul>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Outside content)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar left <span class="submenuitem">(Inside content)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Outside content)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar right <span class="submenuitem">(Inside content)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Sidebar left, right <span class="submenuitem">(Off Canvas)</span></a></li>
                <li><a href="#" class="menuitem-shop" target="_top">All sidebar <span class="submenuitem">(Layout Fluid)</span></a></li>
              </ul>   
              </li>
              <li class="feature-menu-col">
                <a href="#" class="title-shoppage">Product style</a>
              <ul>
                <li><a href="#" class="menuitem-shop">Checkbox and radio style </a></li>
                <li class="submenu-shop">
                 <b class="fa fa-angle-right" aria-hidden="true"></b>
                <a href="#" class="menuitem-shop">Product gallery <span class="menu-label menu-label-new">new</span></a>
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top">Style bottom  </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Style left  </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Style grid  </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Style list  </a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Style slider  </a></li>
                </ul>
                </li>
              
                <li><a href="#" class="menuitem-shop" target="_top">Zoom image </a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Image size chart </a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Tabs vertical </a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Tabs horizontal </a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Show orders</a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Color swatches pro</a></li>
                <li><a href="#" class="menuitem-shop" target="_top">Countdown of special offer</a></li>
                <li class="submenu-shop"><a href="#" class="menuitem-shop" target="_top">Videos <span class="menu-label menu-label-new">new</span></a></li>
                <li class="submenu-shop"><a href="#" class="menuitem-shop" target="_top">Custom tab <span class="menu-label menu-label-new">new</span></a></li>
              </ul>
                
              </li>
              
              <div class="menu-header-image-dropdown">
                <div class="two-col">
                  <div class="column-img">
                    <img src="{{ asset($templateFile . '/images/theme-images') }}/menu-guide.jpg" alt="img">
                  </div>
                  <div class="column-img">
                    <img src="{{ asset($templateFile . '/images/theme-images') }}/menu-guide.jpg" alt="img">
                  </div>
                </div>
              </div>
            </ul>
            
            
          </li>
          <li class="dropdown-menu-list">
            <a href="#" title="menu">collections <span class="caret-icon">&nbsp;</span></a>
            <ul class="sub-menu-header-list four-column">
              <li class="shop-page-drodown-col collection-menu-col">
                
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top"><img src="{{ asset($templateFile . '/images/theme-images') }}/image-1.jpg" alt="img"></a></li>
                  <li><a href="#" class="title-shoppage">Kids</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Aspering</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Boy</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Consectetur</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Duis aute</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Excepteur</a></li>
                </ul>
              </li>
              <li class="shop-page-drodown-col collection-menu-col">
                
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top"><img src="{{ asset($templateFile . '/images/theme-images') }}/image-2.jpg" alt="img"></a></li>
                  <li><a href="#" class="title-shoppage">Clothers</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Dolor emque</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Mollit anim</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Speaker for car</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Dash Cam</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Pampers</a></li>
                </ul>
              </li>
              <li class="shop-page-drodown-col collection-menu-col">
                
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top"><img src="{{ asset($templateFile . '/images/theme-images') }}/image-3.jpg" alt="img"></a></li>
                  <li><a href="#" class="title-shoppage">Mens</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Accessories</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Food miles</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Food miles</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Milk</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Snacks</a></li>
                </ul>
              </li>
              <li class="shop-page-drodown-col collection-menu-col">
                
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top"><img src="{{ asset($templateFile . '/images/theme-images') }}/image-4.jpg" alt="img"></a></li>
                  <li><a href="#" class="title-shoppage">Furniture</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Duis aute</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Esse cillum</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Excepteur</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Hand Tools</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Impact Wrehes</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" title="menu">womens</a>
          </li>
          <li class="dropdown-menu-list">
            <a href="#" title="menu">new arrival <span class="caret-icon">&nbsp;</span></a>
            <ul class="sub-menu-header-list four-column two-column-menu">
              <li class="shop-page-drodown-col new-arrival-menu-col">
                <ul>
                  
                  <li><a href="#" class="title-shoppage">Womens</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">For boy</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">For girl</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Duis aute</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Laudantium</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">For boy</a></li>
                </ul>
                
              </li>
              <li class="shop-page-drodown-col new-arrival-menu-col">
                <ul>
                  <li><a href="#" class="title-shoppage">Clothers</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Dash Cam</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Dolor emque</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Screen TV</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Smartwatch</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Screen TV</a></li>
                </ul>
                
              </li>
              <div class="dropdown-single-image">
                <img src="{{ asset($templateFile . '/images/theme-images') }}/image-5.jpg" alt="img">
              </div>
            </ul>
          </li>
          <li>
            <a href="#" title="menu">mens</a>
          </li>
          <li class="dropdown-menu-list">
            <a href="#" title="menu">pages <span class="caret-icon">&nbsp;</span></a>
            <ul class="sub-menu-header-list four-column two-column-menu">
              <li class="shop-page-drodown-col new-arrival-menu-col">
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top">About Us</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Services</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">FAQs</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Contact us</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Support 24/7 Page</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Typography</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Photo Gallery</a></li>
                </ul>
                
              </li>
              <li class="shop-page-drodown-col new-arrival-menu-col">
                <ul>
                  <li><a href="#" class="menuitem-shop" target="_top">SiteMap</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Page 404</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Coming Soon</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Testimonials</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Best Seller</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">New Arrivals</a></li>
                  <li><a href="#" class="menuitem-shop" target="_top">Most Rated</a></li>
                </ul>
                
              </li>
              
            </ul>
          </li>
          <li class="dropdown-menu-list">
            <a href="#" title="menu">blog <span class="caret-icon">&nbsp;</span></a>
            <ul class="sub-menu-header-list blog-menu-col-five">
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/blog-col1.png"></a>
                <p class="menu-name"><a href="#" title="menu">blog1</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/blog-col1.png"></a>
                <p class="menu-name"><a href="#" title="menu">blog2</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/blog-col1.png"></a>
                <p class="menu-name"><a href="#" title="menu">blog3</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/blog-col1.png"></a>
                <p class="menu-name"><a href="#" title="menu">blog4</a></p>
              </li>
              <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/blog-col1.png"></a>
                <p class="menu-name"><a href="#" title="menu">blog5</a></p>
              </li>
              
              <div class="six-column-blog">
                <div class="blog-menu-column">
                  <li>
                <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/article-default.png"></a>
                  <p class="menu-name"><a href="#" title="menu">blog1</a></p>
                </li>
                <li>
                  <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/article-default.png"></a>
                  <p class="menu-name"><a href="#" title="menu">blog2</a></p>
                </li>
                <li>
                  <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/article-default.png"></a>
                  <p class="menu-name"><a href="#" title="menu">blog3</a></p>
                </li>
                <li>
                  <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/article-default.png"></a>
                  <p class="menu-name"><a href="#" title="menu">blog4</a></p>
                </li>
                <li>
                  <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/article-default.png"></a>
                  <p class="menu-name"><a href="#" title="menu">blog5</a></p>
                </li>
                <li>
                  <a href="#" title="menu"><img src="{{ asset($templateFile . '/images/theme-images') }}/article-default.png"></a>
                  <p class="menu-name"><a href="#" title="menu">blog6</a></p>
                </li>
                </div>
              </div>
            </ul>
          </li>
          <li><a href="#" title="menu">sale </a></li>
        </ul>
        
        
      </div>
      <button type="button" id="show-megamenu-mobile" data-toggle="collapse" class="navbar-toggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    
  </div>
  </section>
  

