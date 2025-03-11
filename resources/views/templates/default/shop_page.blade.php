{{-- @extends($templatePath.'.shop_layout')

@section('main')
<section >
<div class="container">
    <div class="row">
        <h2 class="title text-center">{{ $title }}</h2>
        {!! sc_html_render($page->content) !!}
</div>
</div>
</section>

@endsection

@section('breadcrumb')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">{{ trans('front.home') }}</a></li>
          <li class="active">{{ $title }}</li>
        </ol>
      </div>
@endsection --}}

@extends($templatePath . '.shop_layout')

@section('main')
    <!----==================-page-breadcrumb==================---->
    <div class="breadcrumbs ">
        <div class="inner">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!----==================-page-breadcrumb==================---->


    <section class="about-box-one main-content-section">
        <div class="container">
            <div class="d-flex-custom about-box-inner">
                <div class="seventy-col welcome-about-us">
                    <div class="title-about-us">
                        <h2>Welcome To Shop</h2>
                    </div>
                    <div class="d-flex-custom content-about-us">
                        <div class="image-about-us thirty-col"><img src="{{ asset($templateFile . '/images/theme-images') }}/about-us.jpg" alt="Image Client"></div>
                        <div class="des-about-us seventy-col">
                            <p>Nulla auctor mauris ut dui luctus semper. In hac habitasse platea dictumst. Duis pellentesque
                                ligula a risus suscipit dignissim. Nunc non nisl lacus. Integer pharetra lacinia dapibus.
                                Donec eu dolor dui, vel posuere mauris.
                            </p>
                            <p> Pellentesque semper congue sodales. In consequat, metus eget con sequat ornare, augue dolor
                                blandit purus, vitae lacinia nisi tellus in erat. Nulla ac justo eget massa aliquet sodales.
                                Maecenas mattis male suada sem, in fringilla massa dapibus quis. Suspendisse aliquam leo id
                                neque auctor molestie. Etiam at nulla tellus.</p>
                            <p> Nulla auctor mauris ut dui luctus semper. In hac habitasse platea dictumst. Duis
                                pellentesque ligula a risus suscipit dignissi</p>
                        </div>
                    </div>
                </div>
                <div class="thirty-col why-choose-us">
                    <div class="title-about-us">
                        <h2>Why Choose Us</h2>
                    </div>
                    <div class="content-why">
                        <ul class="why-list">
                            <li><a title="Shipping &amp; Returns" href="#">Shipping &amp; Returns</a></li>
                            <li><a title="Secure Shopping" href="#">Secure Shopping</a></li>
                            <li><a title="International Shipping" href="#">International Shipping</a></li>
                            <li><a title="Affiliates" href="#">Affiliates</a></li>
                            <li><a title="Group Sales" href="#">Group Sales</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="our-member">
                <div class="title-about-us">
                    <h2>Our Member</h2>
                </div>
                <div class="short-des">
                    <p>Consectetur adipiscing elit. Donec pellentesque venenatis elit, quis aliquet mauris malesuada vel.
                        Donec vitae libero dolor, eget dapibus justo.</p>
                    <p>Aenean facilisis aliquet feugiat. Suspendisse lacinia congue est ac semper. Nulla ut elit magna,
                        vitae volutpat magna.</p>
                </div>
            </div>

            <!--====================about-box-column=======================-->

            <div class="d-flex-custom slider-ourmember">
                <div class="fifty-column our-member-column">
                    <div class="d-flex-custom our-memberinner">
                        <div class="image-about-us thirty-col">
                            <img src="{{ asset($templateFile . '/images/theme-images') }}/cl-image-1.jpg" alt="Image Client">
                        </div>
                        <div class="des-about-us seventy-col">
                            <div class="info-member">
                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a></h2>
                                <p class="cl-job">Art Director</p>
                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed
                                    facilisis arcu placerat consequat</p>
                                <ul>
                                    <li><a class="fa fa-f" title="Facebook" href="#"></a></li>
                                    <li><a class="fa fa-t" title="Twitter" href="#"></a></li>
                                    <li><a class="fa fa-g" title="google" href="#"></a></li>
                                    <li><a class="fa fa-s" title="skyper" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fifty-column our-member-column">
                    <div class="d-flex-custom our-memberinner">
                        <div class="image-about-us thirty-col">
                            <img src="{{ asset($templateFile . '/images/theme-images') }}/cl-image-2.jpg" alt="Image Client">
                        </div>
                        <div class="des-about-us seventy-col">
                            <div class="info-member">
                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a></h2>
                                <p class="cl-job">Design Leader</p>
                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed
                                    facilisis arcu placerat consequat</p>
                                <ul>
                                    <li><a class="fa fa-f" title="Facebook" href="#"></a></li>
                                    <li><a class="fa fa-t" title="Twitter" href="#"></a></li>
                                    <li><a class="fa fa-g" title="google" href="#"></a></li>
                                    <li><a class="fa fa-s" title="skyper" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fifty-column our-member-column">
                    <div class="d-flex-custom our-memberinner">
                        <div class="image-about-us thirty-col">
                            <img src="{{ asset($templateFile . '/images/theme-images') }}/cl-image-3.jpg" alt="Image Client">
                        </div>
                        <div class="des-about-us seventy-col">
                            <div class="info-member">
                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a></h2>
                                <p class="cl-job">Tech Leader</p>
                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed
                                    facilisis arcu placerat consequat</p>
                                <ul>
                                    <li><a class="fa fa-f" title="Facebook" href="#"></a></li>
                                    <li><a class="fa fa-t" title="Twitter" href="#"></a></li>
                                    <li><a class="fa fa-g" title="google" href="#"></a></li>
                                    <li><a class="fa fa-s" title="skyper" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fifty-column our-member-column">
                    <div class="d-flex-custom our-memberinner">
                        <div class="image-about-us thirty-col">
                            <img src="{{ asset($templateFile . '/images/theme-images') }}/cl-image-4.jpg" alt="Image Client">
                        </div>
                        <div class="des-about-us seventy-col">
                            <div class="info-member">
                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a>
                                </h2>
                                <p class="cl-job">Manager</p>
                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed
                                    facilisis arcu placerat consequat</p>
                                <ul>
                                    <li><a class="fa fa-f" title="Facebook" href="#"></a></li>
                                    <li><a class="fa fa-t" title="Twitter" href="#"></a></li>
                                    <li><a class="fa fa-g" title="google" href="#"></a></li>
                                    <li><a class="fa fa-s" title="skyper" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====================about-box-column=======================-->

            <div class="slider-happy-about-us">
                <div class="slider-happy-about-us-inner">
                    <div class="title-happy-about">
                        <h2>Happy customer says</h2>
                    </div>
                    <div class="about-us-inner-slider">
                        <div class="about-us-slides">
                            <div class="ct-why">
                                <div class="client-say">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla.
                                        Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet,
                                        consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis.
                                    </p>
                                </div>
                                <p class="client-info-about"><span class="name">- Mama Duo - </span>Social Media
                                    Strategist</p>
                            </div>
                        </div>
                        <div class="about-us-slides">
                            <div class="ct-why">
                                <div class="client-say">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla.
                                        Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet,
                                        consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis.
                                    </p>
                                </div>
                                <p class="client-info-about"><span class="name">- john Doe - </span>Social Media
                                    Strategist</p>
                            </div>
                        </div>
                        <div class="about-us-slides">
                            <div class="ct-why">
                                <div class="client-say">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla.
                                        Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet,
                                        consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis.
                                    </p>
                                </div>
                                <p class="client-info-about"><span class="name">- Mama Duo - </span>Social Media
                                    Strategist</p>
                            </div>
                        </div>
                        <div class="about-us-slides">
                            <div class="ct-why">
                                <div class="client-say">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla.
                                        Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet,
                                        consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus
                                        adipiscing, dui nibh scelerisque justo, quis pretium turpis.
                                    </p>
                                </div>
                                <p class="client-info-about"><span class="name">- john Doe - </span>Social Media
                                    Strategist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
