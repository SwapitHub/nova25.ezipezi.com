<?php $expshow = date("Y-m-d", strtotime("+45 day"));
if(sc_store('enddate')<=date('Y-m-d')) { ?>
<script>
    window.location.href = "{{ route('expire') }}";
</script>"; <?php } ?>

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
	<section class="header">
    <div class="topbar" style="<?php //if($userAct->status==0 && $currAct->status==0 && $cartAct->status==0 ) echo 'display: none';
    ?>">
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
                                    <span><a href="tel:+27769762629">Call us now : {{ sc_store('phone') }}</a></span> <br>
                                    <span><a href="mailto:webmaster@ezipezi.com">Email : {{ sc_store('email') }}</a></span>
                                    <br>
                                </li>
                            @else
                                <?php
                                $user = Auth::user(); ?>
                                <li><a href="{{ route('member.index') }}"><i class="fa fa-user"></i> {{ $user->username }}
                                    </a></li>
                                <li><a href="{{ route('logout') }}" rel="nofollow"
                                        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();"><i
                                            class="fa fa-power-off"></i> {{ trans('front.logout') }}</a></li>
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
                                @if (count($currencies) > 1)
                                    <div class="btn-group locale">
                                        <button type="button" class="btn btn-default dropdown-toggle usa"
                                            data-toggle="dropdown">
                                            {{ sc_currency_info()['name'] }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach ($currencies as $key => $currency)
                                                <li><a
                                                        href="{{ url('currency/' . $currency->code) }}">{{ $currency->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {{-- <select>
                                    <option>currency</option>
                                </select> --}}
                            </li>
                            <li class="icon-cart"><a
                                    href="{{ route('cart') }}">{{ Cart::instance('default')->count() }}</a></li>
                        </ul>
                        {{-- <label for="currency-select">Currency:</label> --}}


                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    {{-- Moddle header start --}}
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
                    <a href="{{ url('/') }}"> <img src="{{ asset(sc_store('logo')) }}"
                            alt="{{ sc_store('logo_alt') }}"></a>
                </div>
                <div class="middle-header-column middle-header-column-three">
                    <div id="sosearchpro-custom" class="sosearchpro-wrapper so-search ">
                        <form method="GET" action="index.php">
                            <div id="search-function-header" class="search input-group form-group">
                                <input class="autosearch-input form-control" type="search" value=""
                                    size="50" autocomplete="off" placeholder="Keyword here..." name="search">
                                <ul class="dropdown-menu" style="display: none;"></ul>
                                <button type="submit" class="button-search btn btn-default btn-lg"
                                    name="submit_search"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Middle header end --}}

    <div class="main-header-menu">
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

                            @if (!empty($cmsCat) && count($cmsCat))
                                @foreach ($cmsCat as $cmcat)
                                    <li class="dropdown-menu-list">
                                        <a href="#" title="menu">{{ $cmcat->title }} <span
                                                class="caret-icon">&nbsp;</span></a>
                                        @php
                                            $subCat = App\Models\Widget::getcmsContent($cmcat->id);
                                        @endphp
                                        @if (!empty($subCat) && count($subCat))
                                            <ul class="sub-menu-header-list blog-menu-col-five">
                                                @foreach ($subCat as $subc)
                                                    <li>
                                                        <a href="#" title="{{ $subc->title }}">
                                                            <img src="{{ $subc->image }}" alt="{{ $subc->title }}">
                                                        </a>
                                                        <p class="menu-name">
                                                            <a href="{{ url('/entry/' . $subc->alias) }}.php"
                                                                title="{{ $subc->title }}">{{ $subc->title }}</a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <a href="{{ url('/entry/' . $cmcat->alias) }}"
                                        title="menu">{{ $cmcat->title }}</a>
                                </li>
                            @endif


                            {{-- blog menu ends here --}}


                            {{-- products menus start --}}
                            @php
                                $winemenu = App\Models\HeaderMenu::getMenu(1);
                            @endphp

                            <li class="dropdown-menu-list">
                                @if ($winemenu->status)
                                    <a href="{{ route('product.all') }}" title="menu">{{ $winemenu->name }} <span
                                            class="caret-icon">&nbsp;</span></a>
                                @endif
                                <ul class="sub-menu-header-list four-column">
                                    @php
                                        use App\Models\ProCat;
                                        use App\Models\ProType;
                                        $protypes = ProType::all();
                                    @endphp
                                    @foreach ($protypes as $protype)
                                        <li class="shop-page-drodown-col collection-menu-col">
                                            <ul>
                                                <li>
                                                    <a href="#" class="menuitem-shop" target="_top">
                                                        <img src="{{ $protype->image }}" alt="{{ $protype->name }}">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('product/category') }}/{{ $protype->alias }}"
                                                        class="title-shoppage">{{ $protype->name }}</a>
                                                </li>
                                                @php
                                                    $procats = ProCat::where('protype', $protype->id)
                                                        ->where('status', 1)
                                                        ->get();
                                                @endphp
                                                @foreach ($procats as $procat)
                                                    <li>
                                                        {{-- <a href="{{ url('search.php?protype=11&procat=2') }}/{{ $protype->id }}" class="menuitem-shop" target="_top">{{ $procat->name }}</a> --}}
                                                        <a href="{{ url('search.php?protype=' . $protype->id . '&procat=' . $procat->id) }}"
                                                            class="menuitem-shop" target="_top">
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
                            @if ($servcmenu->status)
                                <li class="dropdown-menu-list">
                                    <a href="{{ route('services.all') }}" title="menu">{{ $servcmenu->name }}<span
                                            class="caret-icon">&nbsp;</span></a>
                                    @php
                                        $stypes = App\Models\Service::getHeaderCats();
                                    @endphp
                                    @if (count($stypes) >= 1)
                                        <ul class="sub-menu-header-list blog-menu-col-five">
                                            @foreach ($stypes as $dd)
                                                @php
                                                    $type = App\Models\ServiceType::getSingleCat($dd->servicetype);
                                                @endphp
                                                <li>
                                                    <a href="{{ url('services/category') }}/{{ $type->alias }}"
                                                        title="menu">
                                                        <img src="{{ $type->image }}">
                                                    </a>
                                                    <p class="menu-name">
                                                        <a href="{{ url('services/category') }}/{{ $type->alias }}"
                                                            title="menu">{{ $type->name }}</a>
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
                            @if ($propmenu->status)
                                <li>
                                    <a href="{{ route('property.all') }}" title="menu">{{ $propmenu->name }}</a>
                                </li>
                            @endif

                            @php
                                $accmenu = App\Models\HeaderMenu::getMenu(5);
                            @endphp
                            @if ($accmenu->status)
                                <li>
                                    <a href="{{ route('accommodation.all') }}"
                                        title="menu">{{ $accmenu->name }}</a>
                                </li>
                            @endif

                            {{-- news section seart here --}}
                            @php
                                $thewine = App\Models\HeaderMenu::getMenu(2);
                            @endphp
                            @if ($thewine->status)
                                <li class="dropdown-menu-list">
                                    <a href="{{ route('news') }}" title="menu">{{ $thewine->name }}<span
                                            class="caret-icon">&nbsp;</span>
                                    </a>
                                    @php
                                        $vinetypes = App\Models\Blog::getHeaderCats();
                                    @endphp
                                    @if (count($vinetypes))
                                        <ul class="sub-menu-header-list blog-menu-col-five">
                                            @foreach ($vinetypes as $dd)
                                                @php
                                                    $type = App\Models\NewsType::getsingleCat($dd->newstype);
                                                @endphp
                                                <li>
                                                    <a href="{{ url('news/category') }}/{{ $type->alias }}"
                                                        title="menu">
                                                        <img src="{{ $type->image }}">
                                                    </a>
                                                    <p class="menu-name">
                                                        <a href="{{ url('news/category') }}/{{ $type->alias }}"
                                                            title="menu">{{ $type->name }}</a>
                                                    </p>
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
                            @if ($blogmenu->status)
                                <li class="dropdown-menu-list">
                                    <a href="{{ route('blog.all') }}" title="menu">{{ $blogmenu->name }} <span
                                            class="caret-icon">&nbsp;</span>
                                    </a>
                                    @php
                                        $stypes = App\Models\NewBlog::getHeaderCats();
                                    @endphp
                                    @if (count($stypes) >= 1)
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
                                                        <a href="{{ url('blog/category') }}/{{ $type->alias }}"
                                                            title="menu">{{ $type->name }}</a>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif

                            {{-- portfolio start here --}}
                            @php
                                $portfolio = App\Models\HeaderMenu::getMenu(12);
                            @endphp
                            @if ($portfolio->status)
                                <li class="dropdown-menu-list">
                                    <a href="{{ route('portfolio.all') }}" title="menu">{{ $portfolio->name }}
                                        <span class="caret-icon">&nbsp;</span>
                                    </a>
                                    @php
                                        $stypes = App\Models\PortfolioType::GetPortfolioTypes();
                                    @endphp
                                    @if (count($stypes) >= 1)
                                        <ul class="sub-menu-header-list blog-menu-col-five">
                                            @foreach ($stypes as $dd)
                                                <li>
                                                    <a href="{{ url('portfolio/category') }}/{{ $dd->alias }}"
                                                        title="menu">
                                                        <img src="{{ $dd->image }}">
                                                    </a>
                                                    <p class="menu-name">
                                                        <a href="{{ url('portfolio/category') }}/{{ $dd->alias }}"
                                                            title="menu">{{ $dd->name }}</a>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                            {{-- portfolio end here --}}
                            {{-- event end here --}}
                            @php
                                $event = App\Models\HeaderMenu::getMenu(14);
                            @endphp
                            @if ($event->status)
                                <li class="dropdown-menu-list">
                                    <a href="{{ route('event.all') }}" title="menu">{{ $event->name }} <span
                                            class="caret-icon">&nbsp;</span>
                                    </a>
                                    @php
                                        $stypes = App\Models\EventType::GetEventTypes();
                                    @endphp
                                    @if (count($stypes) >= 1)
                                        <ul class="sub-menu-header-list blog-menu-col-five">
                                            @foreach ($stypes as $dd)
                                                <li>
                                                    <a href="{{ url('event/category') }}/{{ $dd->alias }}"
                                                        title="menu">
                                                        <img src="{{ $dd->image }}">
                                                    </a>
                                                    <p class="menu-name">
                                                        <a href="{{ url('event/category') }}/{{ $dd->alias }}"
                                                            title="menu">{{ $dd->name }}</a>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                            {{-- event end here --}}

                            <?php $cmsCat = App\Models\Widget::getcmsCat();
			if (!empty($cmsCat)) {
			  foreach ($cmsCat as $cmcat) {
				$subCat = App\Models\Widget::getcmsContent($cmcat->id);

				if (count($subCat) > 1) {
			?>
                            <li class="dropdown"><a
                                    href="{{ url('/entry/' . $cmcat->alias) }}.php">{{ $cmcat->title }}<i
                                        class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <?php foreach ($subCat as $subc) {
						if ($subc->title != $cmcat->title) {

					  ?>
                                    <li><a href="{{ url('/entry/' . $subc->alias) }}.php">{{ $subc->title }} </a>
                                    </li>
                                    <?php

						}
					  } ?>
                                </ul>
                            </li>
                            <?php } elseif ($cmcat->alias == 'welcome') {
				} else { ?>

                            <li><a href="{{ url('/entry/' . $cmcat->alias) }}.php">{{ $cmcat->title }}</a></li>
                            <?php }
			  }
			} ?>
                            {{-- <li>
				<a href="#" title="menu">sale </a>
			  </li> --}}

                        </ul>
                    </div>

                    {{-- mobile view heade --}}

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
                                <li>
                                    <a href="{{ route('home') }}" class="title-shoppage">Welcome</a>
                                </li>

                                {{-- about mobile --}}
                                @php
                                    $cmsCat = App\Models\Widget::getncmsCat();
                                @endphp
                                @if (!empty($cmsCat) && count($cmsCat))
                                    @foreach ($cmsCat as $cmcat)
                                        <li class="dropdown-menu-list">
                                            <a href="#" title="menu">{{ $cmcat->title }}<span
                                                    class="caret-icon">&nbsp;</span>
                                            </a>
                                            @php
                                                $subCat = App\Models\Widget::getcmsContent($cmcat->id);
                                            @endphp
                                            @if (!empty($subCat) && count($subCat))
                                                <ul class="sub-menu-header-list blog-menu-col-five">
                                                    @foreach ($subCat as $subc)
                                                        <li>
                                                            <a href="{{ url('/entry/' . $subc->alias) }}.php"
                                                                title="menu">
                                                                <img src="{{ $subc->image }}"
                                                                    alt="{{ $subc->title }}">
                                                            </a>
                                                            <p class="menu-name">
                                                                <a href="{{ url('/entry/' . $subc->alias) }}.php"
                                                                    title="menu">{{ $subc->title }}</a>
                                                            </p>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                                {{-- about mobile end --}}

                                {{-- product mobile menu start here  --}}
                                @php
                                    $winemenu = App\Models\HeaderMenu::getMenu(1);
                                @endphp
                                <li class="dropdown-menu-list">
                                    @if ($winemenu->status)
                                        <a href="{{ route('product.all') }}" title="menu">{{ $winemenu->name }}
                                            <span class="caret-icon">&nbsp;</span>
                                        </a>
                                    @endif
                                    <ul class="sub-menu-header-list four-column">
                                        @php
                                            $protypes = ProType::all();
                                        @endphp
                                        @foreach ($protypes as $protype)
                                            <li class="shop-page-drodown-col collection-menu-col">
                                                <ul>
                                                    <li>
                                                        <a href="#" class="menuitem-shop" target="_top">
                                                            <img src="{{ $protype->image }}"
                                                                alt="{{ $protype->name }}">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('product/category') }}/{{ $protype->alias }}"
                                                            class="title-shoppage">{{ $protype->name }}</a>
                                                    </li>
                                                    @php
                                                        $procats = ProCat::where('protype', $protype->id)
                                                            ->where('status', 1)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($procats as $procat)
                                                        <li>
                                                            <a href="{{ url('search.php?protype=' . $protype->id . '&procat=' . $procat->id) }}"
                                                                class="menuitem-shop"
                                                                target="_top">{{ $procat->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                {{-- product mobile menu end  here  --}}

                                {{-- services menu start here --}}
                                @php
                                    $servcmenu = App\Models\HeaderMenu::getMenu(3);
                                @endphp
                                @if ($servcmenu->status)
                                    <li class="dropdown-menu-list">
                                        <a href="{{ route('services.all') }}"
                                            title="menu">{{ $servcmenu->name }}<span
                                                class="caret-icon">&nbsp;</span>
                                        </a>
                                        @php
                                            $stypes = App\Models\Service::getHeaderCats();
                                        @endphp
                                        @if (count($stypes) >= 1)
                                            <ul class="sub-menu-header-list blog-menu-col-five">
                                                @foreach ($stypes as $dd)
                                                    @php
                                                        $type = App\Models\ServiceType::getSingleCat($dd->servicetype);
                                                    @endphp
                                                    <li>
                                                        <a href="{{ url('services/category') }}/{{ $type->alias }}"
                                                            title="menu">
                                                            <img src="{{ $type->image }}"
                                                                alt="{{ $type->name }}">
                                                        </a>
                                                        <p class="menu-name">
                                                            <a href="{{ url('services/category') }}/{{ $type->alias }}"
                                                                title="menu">{{ $type->name }}</a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                                {{-- services menu end here --}}

                                @php
                                    $propmenu = App\Models\HeaderMenu::getMenu(4);
                                @endphp
                                @if ($propmenu->status)
                                    <li>
                                        <a href="{{ route('property.all') }}"
                                            title="menu">{{ $propmenu->name }}</a>
                                    </li>
                                @endif


                                @php
                                    $accmenu = App\Models\HeaderMenu::getMenu(5);
                                @endphp
                                @if ($accmenu->status)
                                    <li>
                                        <a href="{{ route('accommodation.all') }}"
                                            title="menu">{{ $accmenu->name }}</a>
                                    </li>
                                @endif

                                {{-- news menu start here --}}
                                @php
                                    $thewine = App\Models\HeaderMenu::getMenu(2);
                                @endphp
                                @if ($thewine->status)
                                    <li class="dropdown-menu-list">
                                        <a href="{{ route('news') }}" title="menu">{{ $thewine->name }}<span
                                                class="caret-icon">&nbsp;</span>
                                        </a>
                                        @php
                                            $vinetypes = App\Models\Blog::getHeaderCats();
                                        @endphp
                                        @if (count($vinetypes))
                                            <ul class="sub-menu-header-list blog-menu-col-five">
                                                @foreach ($vinetypes as $dd)
                                                    @php
                                                        $type = App\Models\NewsType::getsingleCat($dd->newstype);
                                                    @endphp
                                                    <li>
                                                        <a href="{{ url('news/category') }}/{{ $type->alias }}"
                                                            title="menu">
                                                            <img src="{{ $type->image }}"
                                                                alt="{{ $type->name }}">
                                                        </a>
                                                        <p class="menu-name">
                                                            <a href="#" title="menu">{{ $type->name }}</a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif

                                {{-- news menu end here --}}

                                {{-- blog start here --}}
                                @php
                                    $blogmenu = App\Models\HeaderMenu::getMenu(13);
                                @endphp
                                @if ($blogmenu->status)
                                    <li class="dropdown-menu-list">
                                        <a href="{{ route('blog.all') }}"
                                            title="menu">{{ $blogmenu->name }}<span
                                                class="caret-icon">&nbsp;</span>
                                        </a>
                                        @php
                                            $stypes = App\Models\NewBlog::getHeaderCats();
                                        @endphp
                                        @if (count($stypes) >= 1)
                                            <ul class="sub-menu-header-list blog-menu-col-five">
                                                @foreach ($stypes as $dd)
                                                    @php
                                                        $type = App\Models\BlogType::getSingleCat($dd->blogtype);
                                                    @endphp
                                                    <li>
                                                        <a href="{{ url('blog/category') }}/{{ $type->alias }}"
                                                            title="menu">
                                                            <img src="{{ $type->image }}"
                                                                alt="{{ $type->name }}">
                                                        </a>
                                                        <p class="menu-name">
                                                            <a href="{{ url('blog/category') }}/{{ $type->alias }}"
                                                                title="menu">{{ $type->name }}</a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                                {{-- blog section end  --}}

                                {{-- portfolio section start  --}}
                                @php
                                    $portfolio = App\Models\HeaderMenu::getMenu(12);
                                @endphp
                                @if ($portfolio->status)
                                    <li class="dropdown-menu-list">
                                        <a href="{{ route('portfolio.all') }}"
                                            title="menu">{{ $portfolio->name }}<span
                                                class="caret-icon">&nbsp;</span>
                                        </a>
                                        @php
                                            $stypes = App\Models\PortfolioType::GetPortfolioTypes();
                                        @endphp
                                        @if (count($stypes) >= 1)
                                            <ul class="sub-menu-header-list blog-menu-col-five">
                                                @foreach ($stypes as $dd)
                                                    <li>
                                                        <a href="{{ url('portfolio/category') }}/{{ $dd->alias }}"
                                                            title="menu">
                                                            <img src="{{ $dd->image }}"
                                                                alt="{{ $dd->name }}">
                                                        </a>
                                                        <p class="menu-name">
                                                            <a href="{{ url('portfolio/category') }}/{{ $dd->alias }}"
                                                                title="menu">{{ $dd->name }}</a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                                {{-- portfolio section end  --}}

                                <?php $cmsCat = App\Models\Widget::getcmsCat();
								if (!empty($cmsCat)) {
								  foreach ($cmsCat as $cmcat) {
									$subCat = App\Models\Widget::getcmsContent($cmcat->id);
					
									if (count($subCat) > 1) {
								?>
                                <li class="dropdown"><a
                                        href="{{ url('/entry/' . $cmcat->alias) }}.php">{{ $cmcat->title }}<i
                                            class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <?php foreach ($subCat as $subc) {
											if ($subc->title != $cmcat->title) {
					
										  ?>
                                        <li><a href="{{ url('/entry/' . $subc->alias) }}.php">{{ $subc->title }}
                                            </a>
                                        </li>
                                        <?php
					
											}
										  } ?>
                                    </ul>
                                </li>
                                <?php } elseif ($cmcat->alias == 'welcome') {
									} else { ?>

                                <li><a href="{{ url('/entry/' . $cmcat->alias) }}.php">{{ $cmcat->title }}</a></li>
                                <?php }
								  }
								} ?>

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
    </div>
	</section>
