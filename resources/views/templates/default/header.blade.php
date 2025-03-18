<?php /*  <header id="header"><!--header-->
  <div class="header_top"><!--header_top-->
    <div class="container">
      <div class="row">
        
        <div class="col-sm-6">
          <div class="btn-group pull-right">
            <div class="btn-group locale">
              @if (count($languages)>1)
              <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown"><img src="{{ asset($languages[app()->getLocale()]['icon']) }}" style="height: 25px;">
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                @foreach ($languages as $key => $language)
                  <li><a href="{{ url('locale/'.$key) }}"><img src="{{ asset($language['icon']) }}" style="height: 25px;"></a></li>
                @endforeach
              </ul>
              @endif
            </div>
            @if (count($currencies)>1)
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
          </div>
        </div>

        <div class="col-sm-6">
          <div class="contactinfo">
            <ul class="nav nav-pills">
              <li><a href="tel:{{ sc_store('phone') }}" target="_blank"><i class="fa fa-phone"></i> {{ sc_store('phone') }}</a></li>
              <li> <span>Follow us</span> <a href="http://www.facebook.com/PaisajesEspanoles"><i class="fa fa-facebook fa-lg"></i> </a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header_top-->
  <div class="header-middle"><!--header-middle-->
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <div class="logo pull-left">
            <a href="{{ route('home') }}"><img style="width: 150px;" src="{{ asset(sc_store('logo')) }}" alt="" /></a>
          </div>
        </div>
        <div class="col-sm-4">

       <!--  <form method="post">
          <div class="input-group">
                <input type="text" name="Dbusqueda" value="" placeholder="Buscar..." autocomplete="off"><button type="submit" class="search-btn">
                    <i class="fa fa-search"></i>
                </button>
            </div><div class="autocomplete-suggestions " style="display: none;"></div>
            <?php $provincia = App\Models\Provincia::GetProvincias(); 
             
           
             ?>
          <select name="provincia" class="provincia">
            <option value="">Provincia</option>
            <?php foreach ($provincia as $pro ) { ?>
                <option value="{{ $pro->id }}">{{ $pro->name }}</option>
            <?php } ?>
          </select>
          <select name="localidad" class="localidad">
            <option value="">Localidad</option>
          </select>

          </form> -->
        </div>
        <div class="col-sm-5">
          <div class="shop-menu pull-right">
            <ul class="nav navbar-nav">
              @php
              $cartsCount = \Cart::count();
              @endphp
              <!-- <li><a href="{{ route('wishlist') }}"><span  class="cart-qty  sc-wishlist" id="shopping-wishlist">{{ Cart::instance('wishlist')->count() }}</span><i class="fa fa-star"></i> {{ trans('front.wishlist') }}</a></li> -->
             <!--  <li><a href="{{ route('compare') }}"><span  class="cart-qty sc-compare" id="shopping-compare">{{ Cart::instance('compare')->count() }}</span><i class="fa fa-crosshairs"></i> {{ trans('front.compare') }}</a></li> -->
              <li><a href="{{ route('cart') }}"><span class="cart-qty sc-cart" id="shopping-cart">{{ Cart::instance('default')->count() }}</span> view favourites</a>
              </li>
              @guest
              <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ trans('front.login') }}</a></li>
              @else
              <li><a href="{{ route('member.index') }}"><i class="fa fa-user"></i> {{ trans('front.account') }}</a></li>
              <li><a href="{{ route('logout') }}" rel="nofollow" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ trans('front.logout') }}</a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @endguest

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-middle-->

  <div class="header-bottom"><!--header-bottom-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="mainmenu pull-left">
            <ul class="nav navbar-nav collapse navbar-collapse">
            
                <!--<li class="dropdown"><a href="#">{{ trans('front.shop') }}<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                      <li><a href="{{ route('product.all') }}">{{ trans('front.all_product') }}</a></li>
                      <li><a href="{{ route('compare') }}">{{ trans('front.compare') }}</a></li>
                      <li><a href="{{ route('cart') }}">{{ trans('front.cart_title') }}</a></li>
                      <li><a href="{{ route('categories') }}">{{ trans('front.categories') }}</a></li>
                      <li><a href="{{ route('brands') }}">{{ trans('front.brands') }}</a></li>
                      <li><a href="{{ route('vendors') }}">{{ trans('front.vendors') }}</a></li>
                  </ul>
              </li> -->
              <?php  $cmsCat = App\Models\Widget::getcmsCat();
                
               
          
              if(!empty($cmsCat)) { 
                foreach($cmsCat as $cmcat) { 
                 $subCat = App\Models\Widget::getcmsContent($cmcat->id);

                 if(count($subCat)>1)
                 {
                   ?>
                   <li class="dropdown"><a href="#">{{ $cmcat->title }}<i class="fa fa-angle-down"></i></a>
                       <ul role="menu" class="sub-menu">
                        <?php foreach($subCat as $subc) { ?>
                        <li><a href="{{url('/entry/'.$subc->alias)}}">{{ $subc->title }}</a></li>
                      <?php } ?>
                      </ul>
                  </li>
                  <?php } else { ?>
                 
                  <li><a href="{{ $cmcat->alias }}">{{ $cmcat->title }}</a></li>
                <?php } } }?>

             <!--  <li><a href="{{ route('news') }}">{{ trans('front.blog') }}</a></li> -->

             <!--  @if (!empty(sc_config('Content')))
              <li class="dropdown"><a href="#">{{ trans('front.cms_category') }}<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    @php
                      $nameSpace = sc_get_module_namespace('Cms','Content').'\Models\CmsCategory';
                      $cmsCategories = (new $nameSpace)->where('status', 1)->get();
                    @endphp
                    @foreach ($cmsCategories as $cmsCategory)
                      <li><a href="{{ $cmsCategory->getUrl() }}">{{ sc_language_render($cmsCategory->title) }}</a></li>
                    @endforeach
                  </ul> 
              
              @php
                      $nameSpace = sc_get_module_namespace('Cms','Content').'\Models\CmsCategory';
                      $cmsCategories = (new $nameSpace)->where('status', 1)->get();
                    @endphp
                    @foreach ($cmsCategories as $cmsCategory)
                      <li><a href="{{url('/entry/'.$cmsCategory->alias)}}">{{ sc_language_render($cmsCategory->title) }}</a></li>
                    @endforeach<li></li>
              @endif -->

                @if (!empty($layoutsUrl['menu']))
                  @foreach ($layoutsUrl['menu'] as $url)
                    <li><a {{ ($url->target =='_blank')?'target=_blank':''  }} href="{{ sc_url_render($url->url) }}">{{ sc_language_render($url->name) }}</a>
                  @endforeach
                @endif
            </ul>
          </div>
        </div>
       <!--  <div class="col-sm-3">
          <div class="search_box pull-right">
            <form id="searchbox" method="get" action="{{ route('search') }}" >
              <div class="input-group">
                <input type="text" class="form-control" placeholder="{{ trans('front.search_form.keyword') }}..." name="keyword">
              </div>
            </form>
          </div>
        </div> -->
      </div>
    </div>
  </div><!--/header-bottom-->
</header><!--/header-->
*/?>
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
          <li><a href="">Login or Register</a></li>
          <li>
              <select>
                  <option>currency</option>
              </select> 
          </li>
          <li class="icon-cart">{{ Cart::instance('default')->count() }}</li>
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
</header>