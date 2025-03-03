@extends('admin.layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $title_description??'' }}</h2>
				
                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="{{ route('admin_homecontent.index') }}" class="btn  btn-flat btn-default" title="List"><i
						class="fa fa-list"></i><span class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
					</div>
				</div>
			</div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
			enctype="multipart/form-data">
				
				
                <div class="box-body">
                    <div class="fields-group">
						
						
                        <div class="box-body">
                            <div class="fields-group">
								
                                <div class="form-group   {{ $errors->has('aboutus_img1') ? ' has-error' : '' }}">
									<label for="aboutus_img1" class="col-sm-2  control-label">About us image1</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="aboutus_img1" name="aboutus_img1" value="{{ old('aboutus_img1',$homefront['aboutus_img1']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="aboutus_img1" data-preview="preview_image1" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('aboutus_img1'))
										<span class="help-block">
											{{ $errors->first('aboutus_img1') }}
										</span>
                                        @endif
										<div id="preview_image1" class="img_holder">
											@if (old('aboutus_img1',$homefront['aboutus_img1']??''))
											<img src="{{ asset(old('aboutus_img1',$homefront['aboutus_img1']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								<!-- image alt --->
								<div class="form-group{{ $errors->has('aboutus_img1_alt') ? ' has-error' : '' }}">
									<label for="image_alt" class="col-sm-2  control-label">About us image1 alt</label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
											<input type="text" id="image_alt" value="{!! old('image_alt',($homefront['aboutus_img1_alt']??'')) !!}" name="aboutus_img1_alt"
											class="form-control"
											placeholder="" />
										</div>
										@if ($errors->has('aboutus_img1_alt'))
										<span class="help-block">
											{{ $errors->first('aboutus_img1_alt') }}
										</span>
										@endif
									</div>
								</div> 
								<!-- image alt --->
								
								<div class="form-group   {{ $errors->has('aboutus_img2') ? ' has-error' : '' }}">
									<label for="aboutus_img2" class="col-sm-2  control-label">About us image2</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="aboutus_img2" name="aboutus_img2" value="{{ old('aboutus_img2',$homefront['aboutus_img2']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="aboutus_img2" data-preview="preview_image2" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('aboutus_img2'))
										<span class="help-block">
											{{ $errors->first('aboutus_img2') }}
										</span>
                                        @endif
										<div id="preview_image2" class="img_holder">
											@if (old('aboutus_img2',$homefront['aboutus_img2']??''))
											<img src="{{ asset(old('aboutus_img2',$homefront['aboutus_img2']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								
								<!-- image alt --->
								<div class="form-group{{ $errors->has('aboutus_img2_alt') ? ' has-error' : '' }}">
									<label for="image_alt" class="col-sm-2  control-label">About us image2 alt</label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
											<input type="text" id="image_alt" value="{!! old('aboutus_img2',($homefront['aboutus_img2_alt']??'')) !!}" name="aboutus_img2_alt"
											class="form-control"
											placeholder="" />
										</div>
										@if ($errors->has('aboutus_img2_alt'))
										<span class="help-block">
											{{ $errors->first('aboutus_img2_alt') }}
										</span>
										@endif
									</div>
								</div> 
								<!-- image alt --->
								
								<div class="form-group {{ $errors->has('aboutus') ? ' has-error' : '' }}">
									<label for="aboutus"
									class="col-sm-2 control-label">About us Content</label>
									<div class="col-sm-8">
										<textarea id="aboutus" 
										name="aboutus" class="editor">
											{!! old('aboutus',($homefront['aboutus']??'')) !!}
										</textarea>
										@if ($errors->has('aboutus'))
										<span class="help-block">
											{{ $errors->first('aboutus') }}
										</span>
										@endif
									</div>
								</div>
								
								<div class="form-group   {{ $errors->has('savejob_bg') ? ' has-error' : '' }}">
									<label for="savejob_bg" class="col-sm-2  control-label">Save jobs Background</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="savejob_bg" name="savejob_bg" value="{{ old('savejob_bg',$homefront['savejob_bg']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="savejob_bg" data-preview="preview_image3" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('savejob_bg'))
										<span class="help-block">
											{{ $errors->first('savejob_bg') }}
										</span>
                                        @endif
										<div id="preview_image3" class="img_holder">
											@if (old('savejob_bg',$homefront['savejob_bg']??''))
											<img src="{{ asset(old('savejob_bg',$homefront['savejob_bg']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								
								<div
								class="form-group {{ $errors->has('savejob') ? ' has-error' : '' }}">
									<label for="savejob"
									class="col-sm-2 control-label">Save job Content</label>
									<div class="col-sm-8">
										<textarea id="savejob" 
										name="savejob" class="editor">
											{!! old('savejob',($homefront['savejob']??'')) !!}
										</textarea>
										@if ($errors->has('savejob'))
										<span class="help-block">
											{{ $errors->first('savejob') }}
										</span>
										@endif
									</div>
								</div>
								
								<div class="form-group   {{ $errors->has('gallary_img1') ? ' has-error' : '' }}">
									<label for="gallary_img1" class="col-sm-2  control-label">Gallary Image1</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="gallary_img1" name="gallary_img1" value="{{ old('gallary_img1',$homefront['gallary_img1']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="gallary_img1" data-preview="preview_image4" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('gallary_img1'))
										<span class="help-block">
											{{ $errors->first('gallary_img1') }}
										</span>
                                        @endif
										<div id="preview_image4" class="img_holder">
											@if (old('gallary_img1',$homefront['gallary_img1']??''))
											<img src="{{ asset(old('gallary_img1',$homefront['gallary_img1']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								
								<!-- image alt --->
								<div class="form-group{{ $errors->has('gallary_img1_alt') ? ' has-error' : '' }}">
									<label for="gallary_img1_alt" class="col-sm-2  control-label">Gallary Image1 alt</label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
											<input type="text" id="image_alt" value="{!! old('gallary_img1_alt',($homefront['gallary_img1_alt']??'')) !!}" name="gallary_img1_alt"
											class="form-control"
											placeholder="" />
										</div>
										@if ($errors->has('gallary_img1_alt'))
										<span class="help-block">
											{{ $errors->first('gallary_img1_alt') }}
										</span>
										@endif
									</div>
								</div> 
								<!-- image alt --->
								
								<div class="form-group   {{ $errors->has('gallary_img2') ? ' has-error' : '' }}">
									<label for="gallary_img2" class="col-sm-2  control-label">Gallary image2</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="gallary_img2" name="gallary_img2" value="{{ old('gallary_img2',$homefront['gallary_img2']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="gallary_img2" data-preview="preview_image5" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('gallary_img2'))
										<span class="help-block">
											{{ $errors->first('gallary_img2') }}
										</span>
                                        @endif
										<div id="preview_image5" class="img_holder">
											@if (old('gallary_img2',$homefront['gallary_img2']??''))
											<img src="{{ asset(old('gallary_img2',$homefront['gallary_img2']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								
								<!-- image alt --->
								<div class="form-group{{ $errors->has('gallary_img2_alt') ? ' has-error' : '' }}">
									<label for="image_alt" class="col-sm-2  control-label">Gallary image2 alt</label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
											<input type="text" id="image_alt" value="{!! old('gallary_img2_alt',($homefront['gallary_img2_alt']??'')) !!}" name="gallary_img2_alt"
											class="form-control"
											placeholder="" />
										</div>
										@if ($errors->has('gallary_img2_alt'))
										<span class="help-block">
											{{ $errors->first('gallary_img2_alt') }}
										</span>
										@endif
									</div>
								</div> 
								<!-- image alt --->
								
								<div class="form-group   {{ $errors->has('gallary_img3') ? ' has-error' : '' }}">
									<label for="gallary_img3" class="col-sm-2  control-label">Gallary image3</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="gallary_img3" name="gallary_img3" value="{{ old('gallary_img3',$homefront['gallary_img3']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="gallary_img3" data-preview="preview_image6" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('gallary_img3'))
										<span class="help-block">
											{{ $errors->first('gallary_img3') }}
										</span>
                                        @endif
										<div id="preview_image6" class="img_holder">
											@if (old('gallary_img4',$homefront['gallary_img3']??''))
											<img src="{{ asset(old('gallary_img3',$homefront['gallary_img3']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								
								<!-- image alt --->
								<div class="form-group{{ $errors->has('gallary_img3_alt') ? ' has-error' : '' }}">
									<label for="image_alt" class="col-sm-2  control-label">Gallary image3 alt</label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
											<input type="text" id="image_alt" value="{!! old('gallary_img3_alt',($homefront['gallary_img3_alt']??'')) !!}" name="gallary_img3_alt"
											class="form-control"
											placeholder="" />
										</div>
										@if ($errors->has('gallary_img3_alt'))
										<span class="help-block">
											{{ $errors->first('gallary_img3_alt') }}
										</span>
										@endif
									</div>
								</div> 
								<!-- image alt --->
								
								<div class="form-group   {{ $errors->has('gallary_img4') ? ' has-error' : '' }}">
									<label for="gallary_img4" class="col-sm-2  control-label">Gallary image4</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="gallary_img4" name="gallary_img4" value="{{ old('gallary_img4',$homefront['gallary_img4']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="gallary_img4" data-preview="preview_image7" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('gallary_img4'))
										<span class="help-block">
											{{ $errors->first('gallary_img4') }}
										</span>
                                        @endif
										<div id="preview_image7" class="img_holder">
											@if (old('gallary_img4',$homefront['gallary_img4']??''))
											<img src="{{ asset(old('gallary_img4',$homefront['gallary_img4']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								
								<!-- image alt --->
								<div class="form-group{{ $errors->has('gallary_img4_alt') ? ' has-error' : '' }}">
									<label for="image_alt" class="col-sm-2  control-label">Gallary image4 alt</label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
											<input type="text" id="image_alt" value="{!! old('gallary_img4_alt',($homefront['gallary_img4_alt']??'')) !!}" name="gallary_img4_alt"
											class="form-control"
											placeholder="" />
										</div>
										@if ($errors->has('gallary_img4_alt'))
										<span class="help-block">
											{{ $errors->first('gallary_img4_alt') }}
										</span>
										@endif
									</div>
								</div> 
								<!-- image alt --->
								
								<div class="form-group   {{ $errors->has('gallary_img5') ? ' has-error' : '' }}">
									<label for="gallary_img5" class="col-sm-2  control-label">Gallary image5</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" id="gallary_img5" name="gallary_img5" value="{{ old('gallary_img5',$homefront['gallary_img5']??'') }}" class="form-control input-sm image" placeholder=""  />
											<span class="input-group-btn">
												<a data-input="gallary_img5" data-preview="preview_image8" data-type="banner" class="btn btn-sm btn-primary lfm">
													<i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
												</a>
											</span>
										</div>
                                        @if ($errors->has('gallary_img5'))
										<span class="help-block">
											{{ $errors->first('gallary_img5') }}
										</span>
                                        @endif
										<div id="preview_image8" class="img_holder">
											@if (old('gallary_img5',$homefront['gallary_img5']??''))
											<img src="{{ asset(old('gallary_img5',$homefront['gallary_img5']??'')) }}">
											@endif
										</div>
									</div>
								</div>
								
								
								<!-- image alt --->
								<div class="form-group{{ $errors->has('gallary_img5_alt') ? ' has-error' : '' }}">
									<label for="image_alt" class="col-sm-2  control-label">Gallary image5 alt</label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
											<input type="text" id="image_alt" value="{!! old('gallary_img5_alt',($homefront['gallary_img5_alt']??'')) !!}" name="gallary_img5_alt"
											class="form-control"
											placeholder="" />
										</div>
										@if ($errors->has('gallary_img5_alt'))
										<span class="help-block">
											{{ $errors->first('gallary_img5_alt') }}
										</span>
										@endif
									</div>
								</div> 
								<!-- image alt --->
								
								
								
                                
								
                                <div class="form-group   {{ $errors->has('alias') ? ' has-error' : '' }}">
                                    <label for="alias" class="col-sm-2  control-label">{!! trans('alias') !!}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="alias" name="alias"
											value="{!! old('alias',($homefront['alias']??'')) !!}" class="form-control"
											placeholder="" />
										</div>
                                        @if ($errors->has('alias'))
                                        <span class="help-block">
                                            {{ $errors->first('alias') }}
										</span>
                                        @endif
									</div>
								</div>
								
								
                                
                                <div class="form-group   {{ $errors->has('url') ? ' has-error' : '' }}">
                                    <label for="url" class="col-sm-2  control-label">{{ trans('url') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="url" name="url"
											value="{!! old('url',($homefront['url']??'')) !!}" class="form-control"
											placeholder="" />
										</div>
                                        @if ($errors->has('url'))
                                        <span class="help-block">
                                            {{ $errors->first('url') }}
										</span>
                                        @endif
									</div>
								</div>
								
								
								
								
								
								
								
                                <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">{{ trans('sort') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="number" style="width: 100px;" min=0 id="sort" name="sort"
											value="{!! old('sort',($homefront['sort']??0)) !!}"
											class="form-control sort" placeholder="" />
										</div>
                                        @if ($errors->has('sort'))
                                        <span class="help-block">
                                            {{ $errors->first('sort') }}
										</span>
                                        @endif
									</div>
								</div>
								
								
                                <div class="form-group  ">
                                    <label for="status"
									class="col-sm-2  control-label">{{ trans('status') }}</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="status"
										{{  old('status',(empty($homefront['status'])?0:1))?'checked':''}}>
										</div>
										</div>
										
										</div>
										</div>
										
										<h2>Listing section</h1>
										
										<div class="form-group  ">
										<label for="fprop"
										class="col-sm-2 control-label">Property</label>
										<div class="col-sm-2">
										<input type="checkbox" name="fprop"
										{{ old('fprop',(empty($homefront['fprop'])?0:1))?'checked':''}}>
										
										</div>
										<label for="fprop"
										class="col-sm-2 control-label">Property Order</label>
										<div class="col-sm-2">                             
										<select class="form-control porder select2" style="width: 100%;"
										name="porder">
										<option value="recent" {{ (old('porder', $homefront['porder']??'') ==  'recent')?'selected':'' }}>Recent</option>
										<option value="featured" {{ (old('porder', $homefront['porder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
										</select>
										</div>
										</div>
										
										<div class="form-group  ">
										<label for="fnews"
										class="col-sm-2 control-label">News</label>
										<div class="col-sm-2">
										<input type="checkbox" name="fnews"
										{{ old('fnews',(empty($homefront['fnews'])?0:1))?'checked':''}}>
										
										</div>
										<label for="fprop"
										class="col-sm-2 control-label">News Order</label>
										<div class="col-sm-2">                             
										<select class="form-control norder select2" style="width: 100%;"
										name="norder">
										<option value="recent" {{ (old('norder', $homefront['norder']??'') ==  'recent')?'selected':'' }}>Recent</option>
										<option value="featured" {{ (old('norder', $homefront['norder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
										</select>
										</div>
										</div>
										
										<div class="form-group  ">
										<label for="f$homefront"
										class="col-sm-2 control-label">Product</label>
										<div class="col-sm-2">
										<input type="checkbox" name="fproduct"
										{{ old('fproduct',(empty($homefront['fproduct'])?0:1))?'checked':''}}>
										
										</div>
										<label for="fprop"
										class="col-sm-2 control-label">Product Order</label>
										<div class="col-sm-2">                             
										<select class="form-control proorder select2" style="width: 100%;"
										name="proorder">
										<option value="recent" {{ (old('proorder', $homefront['proorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
										<option value="featured" {{ (old('proorder', $homefront['proorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
										</select>
										</div>
										</div>
										
										<div class="form-group  ">
										<label for="fservice"
										class="col-sm-2 control-label">Services</label>
										<div class="col-sm-2">
										<input type="checkbox" name="fservice"
										{{ old('fservice',(empty($homefront['fservice'])?0:1))?'checked':''}}>
										
										</div>
										<label for="fprop"
										class="col-sm-2 control-label">Services Order</label>
										<div class="col-sm-2">                             
										<select class="form-control sorder select2" style="width: 100%;"
										name="sorder">
										<option value="recent" {{ (old('sorder', $homefront['sorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
										<option value="featured" {{ (old('sorder', $homefront['sorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
										</select>
										</div>
										</div>
										
										<div class="form-group  ">
										<label for="faccommo"
										class="col-sm-2 control-label">Accommodation</label>
										<div class="col-sm-2">
										<input type="checkbox" name="faccommo"
										{{ old('faccommo',(empty($homefront['faccommo'])?0:1))?'checked':''}}>
										
										</div>
										<label for="fprop"
										class="col-sm-2 control-label">Accommodation Order</label>
										<div class="col-sm-2">                             
										<select class="form-control accorder select2" style="width: 100%;"
										name="accorder">
										<option value="recent" {{ (old('accorder', $homefront['accorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
										<option value="featured" {{ (old('accorder', $homefront['accorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
										</select>
										</div>
										</div>
										
										<div class="form-group  ">
										<label for="faccommo"
										class="col-sm-2 control-label">Portfolio</label>
										<div class="col-sm-2">
										<input type="checkbox" name="faport"
										{{ old('faport',(empty($homefront['faport'])?0:1))?'checked':''}}>
										
										</div>
										<label for="portfolio"
										class="col-sm-2 control-label">Portfolio Order</label>
										<div class="col-sm-2">                             
										<select class="form-control portorder select2" style="width: 100%;"
										name="portorder">
										<option value="recent" {{ (old('portorder', $homefront['portorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
										<option value="featured" {{ (old('portorder', $homefront['portorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
										</select>
										</div>
										</div>
										
										<div class="form-group  ">
										<label for="faccommo"
										class="col-sm-2 control-label">Blog</label>
										<div class="col-sm-2">
										<input type="checkbox" name="fablog"
										{{ old('fablog',(empty($homefront['fablog'])?0:1))?'checked':''}}>
										
										</div>
										<label for="blog"
										class="col-sm-2 control-label">Blog Order</label>
										<div class="col-sm-2">                             
										<select class="form-control blogorder select2" style="width: 100%;"
										name="blogorder">
										<option value="recent" {{ (old('blogorder', $homefront['blogorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
										<option value="featured" {{ (old('blogorder', $homefront['blogorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
										</select>
										</div>
										</div>
										
										<div class="form-group  ">
										<label for="testimonial"
                                        class="col-sm-2  control-label">Meet the team</label>
										<div class="col-sm-8">
                                        <input type="checkbox" name="testimonial"
										{{  old('testimonial',(empty($homefront['testimonial'])?0:1))?'checked':''}}>
										</div>
										</div>
										
										
										<!-- /.box-body -->
										
										<div class="box-footer">
											@csrf
											<div class="col-md-2">
											</div>
											
											<div class="col-md-8">
												<div class="btn-group pull-right">
													<button type="submit" class="btn btn-primary">{{ trans('admin.submit') }}</button>
												</div>
												
												<div class="btn-group pull-left">
													<button type="reset" class="btn btn-warning">{{ trans('admin.reset') }}</button>
												</div>
											</div>
										</div>
										
										<!-- /.box-footer -->
									</form>
									
								</div>
							</div>
						</div>
						@endsection
						
						@push('styles')
						<!-- Select2 -->
						<link rel="stylesheet" href="{{ asset('admin/AdminLTE/bower_components/select2/dist/css/select2.min.css')}}">
						
						{{-- switch --}}
						<link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-switch.min.css')}}">
						
						@endpush
						
						@push('scripts')
						<!-- Select2 -->
						<script src="{{ asset('admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
						
						<!--ckeditor-->
						<script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
						<script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>
						
						{{-- switch --}}
						<script src="{{ asset('admin/plugin/bootstrap-switch.min.js')}}"></script>
						
						<script type="text/javascript">
							$("[name='top'],[name='status'],[name='fprop'],[name='fnews'],[name='fproduct'],[name='fservice'],[name='faccommo'],[name='testimonial'],[name='faport'],[name='fablog']").bootstrapSwitch();
						</script>
						
						<script type="text/javascript">
							$(document).ready(function() {
								$('.select2').select2();
								$('textarea.editor').ckeditor(
								{
									filebrowserImageBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=content',
									filebrowserImageUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=content&_token={{csrf_token()}}',
									filebrowserBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=Files',
									filebrowserUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=file&_token={{csrf_token()}}',
									filebrowserWindowWidth: '900',
									filebrowserWindowHeight: '500'
								}
								);
							});
							
						</script>
						
					@endpush																														