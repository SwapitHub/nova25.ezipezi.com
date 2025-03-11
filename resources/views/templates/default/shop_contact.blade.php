{{-- @extends($templatePath . '.shop_layout')

@section('main')
    <?php $pageData = App\Models\HeaderMenu::getMenu(10);
    if ($pageData->image) {
        $image = $pageData->image;
    } else {
        $image = $templateFile . '/images/home/product-listing-bg.png';
    } ?>
    <section class="banner_product-listing" style="background-image: url('{{ asset($image) }}');">
        <div class="container">
            <div class="banner-inner">
                <div class="banner-innerpage-content">
                    <h2>{{ $pageData->name }}</h2>
                </div>
            </div>
        </div>
    </section>

    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center"></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-form">

                        <form method="post" action="{{ route('contact.post') }}" class="contact-form">
                            {{ csrf_field() }}
                            <div id="contactFormWrapper" style="margin: 30px;">
                                <div class="row">



                                    <div class="col-md-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-sm-4 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>{{ trans('front.contact_form.name') }}:</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('name') ? 'input-error' : '' }}"
                                                    name="name" placeholder="Your name..." value="{{ old('name') }}">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div
                                                class="col-sm-4 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label>{{ trans('front.contact_form.email') }}:</label>
                                                <input type="email"
                                                    class="form-control {{ $errors->has('email') ? 'input-error' : '' }}"
                                                    name="email" placeholder="Your email..." value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div
                                                class="col-sm-4 form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label>{{ trans('front.contact_form.phone') }}:</label>
                                                <input type="telephone"
                                                    class="form-control {{ $errors->has('phone') ? 'input-error' : '' }}"
                                                    name="phone" placeholder="Your phone..." value="{{ old('phone') }}">
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                        {{ $errors->first('phone') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div
                                                class="col-sm-12 form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                                <label
                                                    class="control-label">{{ trans('front.contact_form.subject') }}:</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('title') ? 'input-error' : '' }}"
                                                    name="title" placeholder="Subject..." value="{{ old('title') }}">
                                                @if ($errors->has('title'))
                                                    <span class="help-block">
                                                        {{ $errors->first('title') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div
                                                class="col-sm-12 form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                                <label
                                                    class="control-label">{{ trans('front.contact_form.content') }}:</label>
                                                <textarea class="form-control {{ $errors->has('content') ? 'input-error' : '' }}" rows="5" cols="75"
                                                    name="content" placeholder="Your Message...">{{ old('content') }}</textarea>
                                                @if ($errors->has('content'))
                                                    <span class="help-block">
                                                        {{ $errors->first('content') }}
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="g-recaptcha" data-sitekey="{{ sc_store('reCaptcha_site_key') }}"></div>
                                        <div class="btn-toolbar form-group">
                                            <input type="submit" value="{{ trans('front.contact_form.submit') }}"
                                                class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- contactFormWrapper -->
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div><!--/#contact-page-->



    <!-- Main Container -->
    <div class="main-container col1-layout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page_content">


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">{{ trans('front.home') }}</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </div>
@endsection


@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush --}}

@extends($templatePath . '.shop_layout')
@section('main')
    <!----==================-page-breadcrumb==================---->
    <div class="breadcrumbs ">
        <div class="inner">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!----==================-page-breadcrumb==================---->
    <section class="contact-box-one main-content-section">
        <div class="container">
            <div class="d-flex-custom contact-innner">
                <div class="fifty-column contact-column">
                    <img src="{{ asset($templateFile . '/images/theme-images') }}/map.jpg">
                </div>
                <div class="fifty-column contact-column contact-form">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset>
                            <legend>
                                <h2>Contact Form </h2>
                            </legend>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam </p>

                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <input type="text" name="name" value="" id="input-name" class="form-control"
                                        placeholder="Your Name *">

                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <input type="text" name="email" value="" id="input-email"
                                        class="form-control" placeholder="E-Mail Address *">

                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <textarea name="enquiry" value="Enquiry" rows="10" id="input-enquiry" placeholder="Enquiry *" class="form-control"></textarea>

                                </div>
                            </div>

                        </fieldset>
                        <div class="buttons">
                            <div class="pull-left">
                                <button class="btn btn-info" type="submit"><span>Go </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
