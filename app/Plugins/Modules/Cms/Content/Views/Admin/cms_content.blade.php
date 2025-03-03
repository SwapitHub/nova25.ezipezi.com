@extends('admin.layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $title_description??'' }}</h2>

                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="{{ route('admin_cms_content.index') }}" class="btn  btn-flat btn-default"
                            title="List"><i class="fa fa-list"></i><span class="hidden-xs">
                                {{ trans('admin.back_list') }}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                enctype="multipart/form-data">


                <div class="box-body">
                    <div class="fields-group">
                        @php
                        $descriptions = $content?$content->descriptions->keyBy('lang')->toArray():[];
                        @endphp

                        @foreach ($languages as $code => $language)

                        <div class="form-group">
                            <label class="col-sm-2  control-label"></label>
                            <div class="col-sm-8">
                                <b>{{ $language->name }}</b>
                                {!! sc_image_render($language->icon,'20px','20px') !!}
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.title') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__title"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Content.title') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__title" name="descriptions[{{ $code }}][title]"
                                        value="{{ old()? old('descriptions.'.$code.'.title'):($descriptions[$code]['title']??'') }}"
                                        class="form-control {{ $code.'__title' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.title'))
                                <span class="help-block">
                                    {{ $errors->first('descriptions.'.$code.'.title') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.keyword') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__keyword"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Content.keyword') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__keyword"
                                        name="descriptions[{{ $code }}][keyword]"
                                        value="{{ old()?old('descriptions.'.$code.'.keyword'):($descriptions[$code]['keyword']??'') }}"
                                        class="form-control {{ $code.'__keyword' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.keyword'))
                                <span class="help-block">
                                    {{ $errors->first('descriptions.'.$code.'.keyword') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.description') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__description"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Content.description') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__description"
                                        name="descriptions[{{ $code }}][description]"
                                        value="{{ old()?old('descriptions.'.$code.'.description'):($descriptions[$code]['description']??'') }}"
                                        class="form-control {{ $code.'__description' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.description'))
                                <span class="help-block">
                                    {{ $errors->first('descriptions.'.$code.'.description') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group {{ $errors->has('descriptions.'.$code.'.content') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__content"
                                class="col-sm-2 control-label">{{ trans('page.content') }}</label>
                            <div class="col-sm-8">
                                <textarea id="{{ $code }}__content" class="editor"
                                    name="descriptions[{{ $code }}][content]">
                                        {{ old('descriptions.'.$code.'.content',($descriptions[$code]['content']??'')) }}
                                    </textarea>
                                @if ($errors->has('descriptions.'.$code.'.content'))
                                <span class="help-block">
                                    {{ $errors->first('descriptions.'.$code.'.content') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <hr>

                        <div class="form-group  {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id"
                                class="col-sm-2 asterisk control-label">{{ trans('Modules/Cms/Content::Content.admin.select_category') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control category_id select2" style="width: 100%;"
                                    name="category_id">
                                    <option value=""></option>
                                    @foreach ($categories as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('category_id',$content['category_id']??'') ==$k) ? 'selected':'' }}>
                                        {{ $v }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block">
                                    {{ $errors->first('category_id') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group   {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Content.image') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="image" name="image"
                                        value="{{ old('image',$content['image']??'') }}"
                                        class="form-control input-sm image" placeholder="" />
                                    <span class="input-group-btn">
                                        <a data-input="image" data-preview="preview_image" data-type="content"
                                            class="btn btn-sm btn-primary lfm">
                                            <i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
                                        </a>
                                    </span>
                                </div>
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    {{ $errors->first('image') }}
                                </span>
                                @endif

                                <div id="preview_image" class="img_holder">
                                    @if (old('image',$content['image']??''))
                                    <img src="{{ asset(old('image',$content['image']??'')) }}">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group   {{ $errors->has('alias') ? ' has-error' : '' }}">
                            <label for="alias"
                                class="col-sm-2  control-label">{!! trans('Modules/Cms/Content::Content.alias') !!}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="alias" name="alias" value="{!! old('alias',($content['alias']??'')) !!}"
                                        class="form-control alias" placeholder="" />
                                </div>
                                @if ($errors->has('alias'))
                                <span class="help-block">
                                    {{ $errors->first('alias') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="sort"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Content.sort') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="sort" name="sort"
                                        value="{{ old()?old('sort'):$content['sort']??0 }}" class="form-control sort"
                                        placeholder="" />
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
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Content.status') }}</label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="status"
                                    {{ old('status',(empty($content['status'])?0:1))?'checked':''}}>

                            </div>
                        </div>


                        <div class="form-group  ">
                            <label for="footer"
                                class="col-sm-2  control-label">Footer</label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="footer"
                                    {{ old('footer',(empty($content['footer'])?0:1))?'checked':''}}>

                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="testimonial"
                                class="col-sm-2  control-label">Meet the team</label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="testimonial"
                                    {{ old('testimonial',(empty($content['testimonial'])?0:1))?'checked':''}}>

                            </div>
                        </div>

                        <h2>Listing section</h1>

                            <div class="form-group  ">
                            <label for="fprop"
                                class="col-sm-2 control-label">Property</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fprop"
                                    {{ old('fprop',(empty($content['fprop'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Property Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control porder select2" style="width: 100%;"
                                    name="porder">
                                    <option value="recent" {{ (old('porder', $content['porder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('porder', $content['porder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                         <div class="form-group  ">
                            <label for="fnews"
                                class="col-sm-2 control-label">News</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fnews"
                                    {{ old('fnews',(empty($content['fnews'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">News Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control norder select2" style="width: 100%;"
                                    name="norder">
                                     <option value="recent" {{ (old('norder', $content['norder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('norder', $content['norder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                         <div class="form-group  ">
                            <label for="fproduct"
                                class="col-sm-2 control-label">Product</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fproduct"
                                    {{ old('fproduct',(empty($content['fproduct'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Product Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control proorder select2" style="width: 100%;"
                                    name="proorder">
                                     <option value="recent" {{ (old('proorder', $content['proorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('proorder', $content['proorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="fservice"
                                class="col-sm-2 control-label">Services</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fservice"
                                    {{ old('fservice',(empty($content['fservice'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Services Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control sorder select2" style="width: 100%;"
                                    name="sorder">
                                    <option value="recent" {{ (old('sorder', $content['sorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('sorder', $content['sorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="faccommo"
                                class="col-sm-2 control-label">Accommodation</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="faccommo"
                                    {{ old('faccommo',(empty($content['faccommo'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Accommodation Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control accorder select2" style="width: 100%;"
                                    name="accorder">
                                    <option value="recent" {{ (old('accorder', $content['accorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('accorder', $content['accorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                         <div class="form-group  ">
                            <label for="faccommo"
                                class="col-sm-2 control-label">Portfolio</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="faport"
                                    {{ old('faport',(empty($content['faport'])?0:1))?'checked':''}}>

                            </div>
                            <label for="portfolio"
                                class="col-sm-2 control-label">Portfolio Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control portorder select2" style="width: 100%;"
                                    name="portorder">
                                    <option value="recent" {{ (old('portorder', $content['portorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('portorder', $content['portorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="faccommo"
                                class="col-sm-2 control-label">Blog</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fablog"
                                    {{ old('fablog',(empty($content['fablog'])?0:1))?'checked':''}}>

                            </div>
                            <label for="blog"
                                class="col-sm-2 control-label">Blog Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control blogorder select2" style="width: 100%;"
                                    name="blogorder">
                                    <option value="recent" {{ (old('blogorder', $content['blogorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('blogorder', $content['blogorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>



                <!-- /.box-body -->

                <div class="box-footer">
                    @csrf
                    <div class="col-md-2">
                    </div>

                    <div class="col-md-8">
                        <div class="btn-group pull-right">
                            <?php if($content) { ?>
                             <a href="{{url('/entry/'.$content->alias)}}.php" class="btn btn-primary">Preview </a>
                            <?php } ?>
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
<!--ckeditor-->
<script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

{{-- switch --}}
<script src="{{ asset('admin/plugin/bootstrap-switch.min.js')}}"></script>

<script type="text/javascript">
    $("[name='top'],[name='status'],[name='footer'],[name='fprop'],[name='fnews'],[name='fproduct'],[name='fservice'],[name='faccommo'],[name='testimonial'],[name='faport'],[name='fablog']").bootstrapSwitch();
</script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2()
});



</script>
<script type="text/javascript">
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
</script>
@endpush