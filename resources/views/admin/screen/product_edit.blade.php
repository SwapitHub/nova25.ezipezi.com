@extends('admin.layout')

@section('main')
<style>
    #start-add {
        margin: 20px;
    }

    .select-product {
        margin: 10px 0;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $title_description??'' }}</h2>

                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="{{ route('admin_product.index') }}" class="btn  btn-flat btn-default" title="List"><i
                                class="fa fa-list"></i><span class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('admin_product.edit',['id'=>$product['id']]) }}" method="post" accept-charset="UTF-8"
                class="form-horizontal" id="form-main" enctype="multipart/form-data">

@if (sc_config('product_kind'))
            <div class="col-xs-12" id="start-add">
                <div class="col-md-4"></div>
                <div class="col-md-4 form-group">
                    <div class="input-group input-group-sm" style="width: 300px;text-align: center;">
                        <b>{{ trans('product.type') }}:</b> {{ $kinds[$product->kind]??'' }}
                    </div>
                </div>
            </div>    
@endif


                <div class="box-body">
                    <div class="fields-group">

                        {{-- Descriptions --}}
                        @php
                        $descriptions = $product->descriptions->keyBy('lang')->toArray();
                        @endphp

                        @foreach ($languages as $code => $language)

                        <div class="form-group">
                            <label class="col-sm-2  control-label"></label>
                            <div class="col-sm-8">
                                <b>{{ $language->name }}</b>
                                {!! sc_image_render($language->icon,'20px','20px') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('protype') ? ' has-error' : '' }}">
                                <label for="protype" class="col-sm-2 control-label">Product type</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm protype select2" style="width: 100%;"
                                    name="protype">
                                    <option value=""></option>
                                    <?php foreach($protype as $type) { ?>
                                    <option value="{{ $type->id }}" <?php if(isset($product['protype'])) { 
                                        if($product['protype']==$type->id) echo "selected"; }  ?> >
                                        
                                            {{ $type->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('protype'))
                                        <span class="help-block">
                                            {{ $errors->first('protype') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                         <div class="form-group {{ $errors->has('procat') ? ' has-error' : '' }}">
                                <label for="procat" class="col-sm-2 control-label">Product Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm procat select2" style="width: 100%;"
                                    name="procat">
                                    <?php foreach($procat as $cat) { ?>
                                    <option value="{{ $cat->id }}" <?php if(isset($product['procat'])) { 
                                        if($product['procat']==$cat->id) echo "selected"; }  ?> >
                                        
                                            {{ $cat->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('procat'))
                                        <span class="help-block">
                                            {{ $errors->first('procat') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('provincia') ? ' has-error' : '' }}">
                                <label for="provincia" class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm provincia select2" style="width: 100%;"
                                    name="provincia">
                                    <option value=""></option>
                                    <?php foreach ($provi as $pro) { ?>
                                    <option value="{{ $pro->id }}" <?php if(isset($product['provincia'])) { 
                                        if($product['provincia']==$pro->id) echo "selected"; }  ?> >
                                        
                                            {{ $pro->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('provincia'))
                                        <span class="help-block">
                                            {{ $errors->first('provincia') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                         <div class="form-group {{ $errors->has('localidad') ? ' has-error' : '' }}">
                                <label for="provincia" class="col-sm-2 control-label">State</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm localidad select2" style="width: 100%;"
                                    name="localidad">
                                    <?php foreach ($states as $state) { ?>
                                    <option value="{{ $state->id }}" <?php if(isset($product['state'])) { 
                                        if($product['state']==$state->id) echo "selected"; }  ?> >
                                        
                                            {{ $state->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('localidad'))
                                        <span class="help-block">
                                            {{ $errors->first('localidad') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="provincia" class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm location select2" style="width: 100%;"
                                    name="location">
                                    <?php foreach ($subloc as $loc) { ?>
                                    <option value="{{ $loc->id }}" <?php if(isset($product['location'])) { 
                                        if($product['location']==$loc->id) echo "selected"; }  ?>>
                                        
                                            {{ $loc->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('location'))
                                        <span class="help-block">
                                            {{ $errors->first('location') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                        <div class="form-group   {{ $errors->has('descriptions.'.$code.'.name') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__name"
                                class="col-sm-2  control-label">{{ trans('product.name') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>

                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__name" name="descriptions[{{ $code }}][name]"
                                        value="{!!old('descriptions.'.$code.'.name',($descriptions[$code]['name']??'')) !!}"
                                        class="form-control {{ $code.'__name' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.name'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.name') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.keyword') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__keyword"
                                class="col-sm-2  control-label">{{ trans('product.keyword') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__keyword"
                                        name="descriptions[{{ $code }}][keyword]"
                                        value="{!! old('descriptions.'.$code.'.keyword',($descriptions[$code]['keyword']??'')) !!}"
                                        class="form-control {{ $code.'__keyword' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.keyword'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.keyword') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.description') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__description"
                                class="col-sm-2  control-label">{{ trans('product.description') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__description"
                                        name="descriptions[{{ $code }}][description]"
                                        value="{!! old('descriptions.'.$code.'.description',($descriptions[$code]['description']??'')) !!}"
                                        class="form-control {{ $code.'__description' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.description'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.description') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div
                            class="form-group {{ $errors->has('introduction') ? ' has-error' : '' }}">
                            <label for="introduction"
                                class="col-sm-2 control-label">Introduction</label>
                            <div class="col-sm-8">
                                <textarea id="introduction" 
                                    name="introduction" class="editor">
                                        {!! old('introduction',($product['introduction']??'')) !!}
                                    </textarea>
                               @if ($errors->has('introduction'))
                                <span class="help-block">
                                    {{ $errors->first('introduction') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @if ($product->kind == SC_PRODUCT_SINGLE)
                        <div
                            class="form-group {{ $errors->has('descriptions.'.$code.'.content') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__content"
                                class="col-sm-2 control-label">{{ trans('product.content') }}</label>
                            <div class="col-sm-8">
                                <textarea id="{{ $code }}__content" class="editor"
                                    name="descriptions[{{ $code }}][content]">
                                        {!! old('descriptions.'.$code.'.content',($descriptions[$code]['content']??'')) !!}
                                    </textarea>
                                @if ($errors->has('descriptions.'.$code.'.content'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.content') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @endforeach
                        {{-- //Descriptions --}}


                        {{-- Category --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <hr>

                        @php
                        $listCate = [];
                        $category = old('category',$product->categories->pluck('id')->toArray());
                        if(is_array($category)){
                            foreach($category as $value){
                                $listCate[] = (int)$value;
                            }
                        }
                        @endphp

                        <!-- <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category"
                                class="col-sm-2 control-label">{{ trans('product.admin.select_category') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm category select2" multiple="multiple"
                                    data-placeholder="{{ trans('product.admin.select_category') }}" style="width: 100%;"
                                    name="category[]">
                                    <option value=""></option>
                                    @foreach ($categories as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (count($listCate) && in_array($k, $listCate))?'selected':'' }}>{{ $v }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('category') }}
                                </span>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        {{-- //Category --}}

                        {{-- Images --}}
                        <div class="form-group   {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-sm-2  control-label">{{ trans('product.image') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="image" name="image"
                                        value="{!! old('image',$product->image) !!}" class="form-control input-sm image"
                                        placeholder="" />
                                    <span class="input-group-btn">
                                        <a data-input="image" data-preview="preview_image" data-type="product"
                                            class="btn btn-sm btn-primary lfm">
                                            <i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
                                        </a>
                                    </span>
                                </div>
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('image') }}
                                </span>
                                @endif
                                <div id="preview_image" class="img_holder">
                                    @if (old('image',$product->image))
                                        <img src="{{ asset(old('image',$product->image)) }}">
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="text" id="image_alt" name="image_alt" value="{{ old('image_alt',$product['image_alt']??'') }}" class="form-control input-sm imagealt" placeholder="Image alt text">
                                  
                                    </div>
                                <?php $addmore = 0; ?>
                                <?php $ttlimg = 0; ?>
                                @if(!empty($subImages))
                                @foreach($subImages as $key => $sub_image)  
                                @if ($sub_image)
                                <?php $addmore=1; 
                                 $ttlimg = count($subImages); ?>
                                <div class="group-image">
                                    <input type="hidden" name="imageid[]" value="{{ $sub_image->id }}">
                                    
                                    <div class="input-group"><input type="text" id="sub_image_{{ $key }}"
                                            name="sub_image[]" value="{!! $sub_image->image !!}"
                                            class="form-control input-sm sub_image" placeholder="" /><span
                                            class="input-group-btn"><span><a data-input="sub_image_{{ $key }}"
                                                    data-preview="preview_sub_image_{{ $key }}" data-type="product"
                                                    class="btn btn-sm btn-flat btn-primary lfm"><i
                                                        class="fa fa-picture-o"></i>
                                                    {{trans('product.admin.choose_image')}}</a></span><span
                                                title="Remove" class="btn btn-flat btn-sm btn-danger removeImage" data-src="{{ $sub_image->id }}"><i
                                                    class="fa fa-times"></i></span></span></div>
                                    <div id="preview_sub_image_{{ $key }}" class="img_holder"><img
                                            src="{{ asset($sub_image->image) }}"></div>
                                            <div class="input-group">
                                    <input type="text" id="imagealt" name="imagealt[]"
                                        value="{{ old('imagealt',$sub_image['imagealt']??'') }}"
                                        class="form-control input-sm imagealt" placeholder="Image alt text" />
                                  
                                    </div>
                                </div>

                                @endif
                                @endforeach
                                @else
                                @endif
                                <input type="hidden" name="addmore" class="addmore" value="{{ $addmore }}">
                                <input type="hidden" name="newimage" class="newimage" >
                                    <button type="button" id="add_sub_image" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_sub_image') }}
                                </button>

                            </div>
                        </div>
                        {{-- //Images --}}


                        {{-- Sku --}}
                        <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                            <label for="sku" class="col-sm-2 control-label">{{ trans('product.sku') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" style="width: 100px;" id="sku" name="sku"
                                        value="{!! old('sku',$product->sku) !!}" class="form-control input-sm sku"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sku'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('sku') }}
                                </span>
                                @else
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ trans('product.sku_validate') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Sku --}}


                        {{-- Alias --}}
                        <div class="form-group {{ $errors->has('alias') ? ' has-error' : '' }}">
                            <label for="alias" class="col-sm-2 control-label">{!! trans('product.alias') !!}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="alias" name="alias"
                                        value="{!! old('alias', $product->alias) !!}" class="form-control input-sm alias"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('alias'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('alias') }}
                                </span>
                                @else
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ trans('product.alias_validate') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Alias --}}

                        <div class="form-group {{ $errors->has('branch') ? ' has-error' : '' }}">
                                <label for="branch" class="col-sm-2 control-label">Branch</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm branch select2" style="width: 100%;"
                                    name="branch">
                                    <option value=""></option>
                                    <?php foreach($branch as $br) { ?>
                                    <option value="{{ $br->id }}" <?php if(isset($product['branch'])) { 
                                        if($product['branch']==$br->id) echo "selected"; }  ?>>
                                        
                                            {{ $br->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('branch'))
                                        <span class="help-block">
                                            {{ $errors->first('branch') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                         <div class="form-group {{ $errors->has('author') ? ' has-error' : '' }}">
                                <label for="author" class="col-sm-2 control-label">Contact</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm author select2" style="width: 100%;"
                                    name="author[]"  multiple="multiple">
                                    <option value=""></option>
                                    <?php $exauthor = explode (",", $product->author);
                                    foreach($users as $author) { ?>
                                    <option value="{{ $author->id }}" <?php if(isset($product['author'])) { 
                                         if (in_array($author->id, $exauthor)) echo "selected"; } ?>  >
                                        
                                            {{ $author->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('author'))
                                        <span class="help-block">
                                            {{ $errors->first('author') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                         <div class="form-group">
                                <label for="listedby" class="col-sm-2 control-label">Listed By</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm listedby select2" style="width: 100%;">
                                <?php $listedby = App\Admin\Models\AdminUser::GetAdminUser($product->userid); ?>
                                    <option value="{{ $listedby->name }}">{{ $listedby->name }}</option>
                                    
                                    </select>
                              
                            </div>
                        </div>
                         


@if (sc_config('product_brand'))
                        {{-- Brand --}}
                        <div class="form-group  {{ $errors->has('brand_id') ? ' has-error' : '' }}">
                            <label for="brand_id" class="col-sm-2 control-label">{{ trans('product.brand') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm brand_id select2" style="width: 100%;"
                                    name="brand_id">
                                    <option value=""></option>
                                    @foreach ($brands as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('brand_id') ==$k || (!old() && $product->brand_id ==$k) ) ? 'selected':'' }}>
                                        {{ $v->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('brand_id') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Brand --}}
@endif

@if (sc_config('product_vendor'))
                        {{-- Vendor --}}
                        <div class="form-group  {{ $errors->has('vendor_id') ? ' has-error' : '' }}">
                            <label for="vendor_id" class="col-sm-2 control-label">{{ trans('product.vendor') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm vendor_id select2" style="width: 100%;"
                                    name="vendor_id">
                                    <option value=""></option>
                                    @foreach ($vendors as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('vendor_id') ==$k || (!old() && $product->vendor_id ==$k) ) ? 'selected':'' }}>
                                        {{ $v->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('vendor_id'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('vendor_id') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Vendor --}}
@endif

@if (sc_config('product_cost'))
                        {{-- Cost --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE)
                        <div class="form-group  kind kind0 kind1  {{ $errors->has('cost') ? ' has-error' : '' }}">
                            <label for="cost" class="col-sm-2  control-label">{{ trans('product.cost') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="cost" name="cost"
                                        value="{!! old('cost',$product->cost) !!}" class="form-control input-sm cost"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('cost'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('cost') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Cost --}}
@endif

@if (sc_config('product_price'))
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        {{-- Price --}}
                        <div class="form-group   {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-sm-2  control-label">{{ trans('product.price') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="price" name="price"
                                        value="{!! old('price',$product->price) !!}" class="form-control input-sm price"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('price'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('price') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Price --}}
@endif

@if (sc_config('product_promotion'))
                        {{-- price promotion --}}
                        <div class="form-group  kind kind0 kind1">
                            <label for="price"
                                class="col-sm-2  control-label">{{ trans('product.price_promotion') }}</label>
                            <div class="col-sm-8">
                                @if (old('price_promotion') || $product->promotionPrice)
                                <div class="price_promotion">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="number" style="width: 100px;" id="price_promotion"
                                            name="price_promotion"
                                            value="{!! old('price_promotion',$product->promotionPrice->price_promotion) !!}"
                                            class="form-control input-sm price_promotion" placeholder="" />
                                        <span title="Remove" class="btn btn-flat btn-sm btn-danger removePromotion"><i
                                                class="fa fa-times"></i></span>
                                    </div>

                                    <div class="form-inline">
                                        <div class="input-group">
                                            {{ trans('product.price_promotion_start') }}<br>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar fa-fw"></i></span>
                                                <input type="text" style="width: 100px;" id="price_promotion_start"
                                                    name="price_promotion_start"
                                                    value="{!!old('price_promotion_start',$product->promotionPrice->date_start)!!}"
                                                    class="form-control input-sm price_promotion_start date_time"
                                                    placeholder="" />
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            {{ trans('product.price_promotion_end') }}<br>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar fa-fw"></i></span>
                                                <input type="text" style="width: 100px;" id="price_promotion_end"
                                                    name="price_promotion_end"
                                                    value="{!!old('price_promotion_end',$product->promotionPrice->date_end)!!}"
                                                    class="form-control input-sm price_promotion_end date_time"
                                                    placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" style="display: none;" id="add_product_promotion"
                                    class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product_promotion') }}
                                </button>
                                @else
                                <button type="button" id="add_product_promotion" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product_promotion') }}
                                </button>
                                @endif

                            </div>
                        </div>
                        {{-- //price promotion --}}
                        @endif
@endif

@if (sc_config('product_stock'))
                        {{-- Stock --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <div class="form-group  {{ $errors->has('stock') ? ' has-error' : '' }}">
                            <label for="stock" class="col-sm-2  control-label">{{ trans('product.stock') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="stock" name="stock"
                                        value="{!! old('stock',$product->stock) !!}" class="form-control input-sm stock"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('stock'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('stock') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Stock --}}
@endif

@if (sc_config('product_type'))
                        {{-- Type --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <hr>
                        <div class="form-group  kind kind0 kind1  {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-sm-2  control-label">{{ trans('product.type') }}</label>
                            <div class="col-sm-8">
                                @foreach ( $types as $key => $type)
                                <label class="radio-inline"><input type="radio" name="type" value="{!! $key !!}"
                                        {{ (old('type',$product->type) == $key)?'checked':'' }}>{{ $type }}</label>
                                @endforeach
                                @if ($errors->has('type'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('type') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Type --}}
@endif

@if (sc_config('product_virtual'))
                        {{-- Virtual --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <div class="form-group  kind kind0 kind1  {{ $errors->has('virtual') ? ' has-error' : '' }}">
                            <label for="virtual" class="col-sm-2  control-label">{{ trans('product.virtual') }}</label>
                            <div class="col-sm-8">
                                @foreach ( $virtuals as $key => $virtual)
                                <label class="radio-inline"><input type="radio" name="virtual" value="{{ $key }}"
                                        {{ (old('virtual',$product->virtual) == $key)?'checked':'' }}>{{ $virtual }}</label>
                                @endforeach
                                @if ($errors->has('virtual'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('virtual') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Virtual --}}
@endif

 <div
                            class="form-group  kind kind0 kind1  {{ $errors->has('startdate') ? ' has-error' : '' }}">
                            <label for="startdate"
                                class="col-sm-2  control-label">Date Listed</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                    <input type="text" style="width: 100px;" id="startdate" name="startdate"
                                        value="{!! old('startdate',($product['startdate']??'')) !!}"
                                        class="form-control input-sm startdate date_time" placeholder="" />
                                </div>
                                @if ($errors->has('startdate'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('startdate') }}
                                </span>
                                @endif
                            </div>
                        </div>

                                <div
                            class="form-group  kind kind0 kind1  {{ $errors->has('expire') ? ' has-error' : '' }}">
                            <label for="expire"
                                class="col-sm-2  control-label">Expire</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                    <input type="text" style="width: 100px;" id="expire" name="expire"
                                        value="{!! old('expire',($product['expire']??'')) !!}"
                                        class="form-control input-sm expire date_time" placeholder="" />
                                </div>
                                @if ($errors->has('expire'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('expire') }}
                                </span>
                                @endif
                            </div>
                        </div>

@if (sc_config('product_available'))
                        {{-- Date vailalable --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <div
                            class="form-group  kind kind0 kind1  {{ $errors->has('date_available') ? ' has-error' : '' }}">
                            <label for="date_available"
                                class="col-sm-2  control-label">{{ trans('product.date_available') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                    <input type="text" style="width: 100px;" id="date_available" name="date_available"
                                        value="{!!old('date_available',$product->date_available)!!}"
                                        class="form-control input-sm date_available date_time" placeholder="" />
                                </div>
                                @if ($errors->has('date_available'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('date_available') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Date vailalable --}}
@endif

                        {{-- Sort --}}
                        <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="sort" class="col-sm-2  control-label">{{ trans('product.sort') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="sort" name="sort"
                                        value="{!! old('sort',$product['sort']) !!}" class="form-control sort"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sort'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('sort') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Sort --}}

                        {{-- Status --}}
                        <div class="form-group  ">
                            <label for="status" class="col-sm-2  control-label">{{ trans('product.status') }}</label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="status"
                                            {{  old('status',(empty($product['status'])?0:1))?'checked':''}}>

                            </div>
                        </div>
                        {{-- //Status --}}

                         <div class="form-group  ">
                            <label for="featured" class="col-sm-2  control-label">Featured</label>
                            <div class="col-sm-8">
                               <input type="checkbox" name="featured"
                                            {{  old('featured',(empty($product['featured'])?0:1))?'checked':''}}>

                            </div>
                        </div>

                        <?php $extag = explode (",", $product->tags);
                                 
                                 foreach ($tagtype as $type ) { 
                                $tags = App\Models\ProTag::getTags($type->id); 
                                ?>
                                 <div class="form-group">
                                    
                                       
                                    <label for="{{ $type->name }}"
                                        class="col-sm-2  control-label">{{ $type->name }}</label>
                                    
                                    <div class="col-sm-8">
                                        <?php foreach ($tags as $tag) { ?>
                                         
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" <?php if (in_array($tag->id, $extag)) echo "checked"; ?> > {{ $tag->name }}
                                        <?php } ?>
                                           
                                    </div>
                                       
                                        
                                </div>
                            <?php } ?>

                            <h3>AUTHOR / SOURCE / CONTACT DETAILS</h3>
                             <div class="form-group   {{ $errors->has('notes') ? ' has-error' : '' }}">
                                    <label for="notes" class="col-sm-2  control-label">Notes</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <textarea class="form-control" name="notes">{!! old('notes',($product['notes']??'')) !!}</textarea>
                                           
                                           
                                        </div>
                                        @if ($errors->has('notes'))
                                        <span class="help-block">
                                            {{ $errors->first('notes') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="form-group   {{ $errors->has('add_regname') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Registered Name</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_regname" name="add_regname"
                                                value="{!! old('add_regname',($product['add_regname']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_regname'))
                                        <span class="help-block">
                                            {{ $errors->first('add_regname') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group   {{ $errors->has('add_fname') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Contact first name</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_fname" name="add_fname"
                                                value="{!! old('add_fname',($product['add_fname']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_fname'))
                                        <span class="help-block">
                                            {{ $errors->first('add_fname') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group   {{ $errors->has('add_lname') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Contact Last name</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_lname" name="add_lname"
                                                value="{!! old('add_lname',($product['add_lname']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_lname'))
                                        <span class="help-block">
                                            {{ $errors->first('add_lname') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group   {{ $errors->has('add_email') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Email address</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="email" id="add_email" name="add_email"
                                                value="{!! old('add_email',($product['add_email']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_email'))
                                        <span class="help-block">
                                            {{ $errors->first('add_email') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group   {{ $errors->has('add_postal1') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Postal 1</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_postal1" name="add_postal1"
                                                value="{!! old('add_postal1',($product['add_postal1']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_postal1'))
                                        <span class="help-block">
                                            {{ $errors->first('add_postal1') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                 <div class="form-group   {{ $errors->has('add_postal2') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Postal 2</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_postal2" name="add_postal2"
                                                value="{!! old('add_postal2',($product['add_postal2']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_postal2'))
                                        <span class="help-block">
                                            {{ $errors->first('add_postal2') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group   {{ $errors->has('add_postal3') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Postal 3</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_postal3" name="add_postal3"
                                                value="{!! old('add_postal3',($product['add_postal3']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_postal3'))
                                        <span class="help-block">
                                            {{ $errors->first('add_postal3') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                 <div class="form-group   {{ $errors->has('add_postcode') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Post Code</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_postal3" name="add_postcode"
                                                value="{!! old('add_postcode',($product['add_postcode']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_postcode'))
                                        <span class="help-block">
                                            {{ $errors->first('add_postcode') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group   {{ $errors->has('add_busiphone') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Business Tel</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_busiphone" name="add_busiphone"
                                                value="{!! old('add_busiphone',($product['add_busiphone']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_busiphone'))
                                        <span class="help-block">
                                            {{ $errors->first('add_busiphone') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group   {{ $errors->has('add_homephone') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Home Tel</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_homephone" name="add_homephone"
                                                value="{!! old('add_homephone',($product['add_homephone']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_homephone'))
                                        <span class="help-block">
                                            {{ $errors->first('add_homephone') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                 <div class="form-group   {{ $errors->has('add_cellphone') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-2  control-label">Cell</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="add_cellphone" name="add_cellphone"
                                                value="{!! old('add_cellphone',($product['add_cellphone']??'')) !!}" class="form-control"
                                                placeholder="" />
                                           
                                        </div>
                                        @if ($errors->has('add_cellphone'))
                                        <span class="help-block">
                                            {{ $errors->first('add_cellphone') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('add_mainloc') ? ' has-error' : '' }}">
                                <label for="add_mainloc" class="col-sm-2 control-label">Main Location</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm add_mainloc select2" style="width: 100%;"
                                    name="add_mainloc">
                                    <option value=""></option>
                                    <?php foreach ($provi as $pro) { ?>
                                    <option value="{{ $pro->id }}" <?php if(isset($product['add_mainloc'])) { 
                                        if($product['add_mainloc']==$pro->id) echo "selected"; }  ?> >
                                        
                                            {{ $pro->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('add_mainloc'))
                                        <span class="help-block">
                                            {{ $errors->first('add_mainloc') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                         <div class="form-group {{ $errors->has('add_subloc') ? ' has-error' : '' }}">
                                <label for="add_subloc" class="col-sm-2 control-label">Sub Location</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm add_subloc select2" style="width: 100%;"
                                    name="add_subloc">
                                     <option value=""></option>
                                    <?php foreach ($add_subloc as $state) { ?>
                                    <option value="{{ $state->id }}"  <?php if(isset($product['add_subloc'])) { 
                                        if($product['add_subloc']==$state->id) echo "selected"; }  ?> >
                                        
                                            {{ $state->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('add_subloc'))
                                        <span class="help-block">
                                            {{ $errors->first('add_subloc') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('add_loc') ? ' has-error' : '' }}">
                                <label for="add_loc" class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm add_loc select2" style="width: 100%;"
                                    name="add_loc">
                                     <option value=""></option>
                                    <?php foreach ($add_loc as $loc) { ?>
                                    <option value="{{ $loc->id }}" <?php if(isset($product['add_loc'])) { 
                                        if($product['add_loc']==$loc->id) echo "selected"; }  ?> >
                                        
                                            {{ $loc->name  }}</option>
                                    <?php } ?>
                                    </select>
                              @if ($errors->has('add_loc'))
                                        <span class="help-block">
                                            {{ $errors->first('add_loc') }}
                                        </span>
                                        @endif
                            </div>
                        </div>

                        <h2>Listing section</h1>

                            <div class="form-group  ">
                            <label for="fprop"
                                class="col-sm-2 control-label">Property</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fprop"
                                    {{ old('fprop',(empty($product['fprop'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Property Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control porder select2" style="width: 100%;"
                                    name="porder">
                                    <option value="recent" {{ (old('porder', $product['porder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('porder', $product['porder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                         <div class="form-group  ">
                            <label for="fnews"
                                class="col-sm-2 control-label">News</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fnews"
                                    {{ old('fnews',(empty($product['fnews'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">News Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control norder select2" style="width: 100%;"
                                    name="norder">
                                     <option value="recent" {{ (old('norder', $product['norder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('norder', $product['norder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                         <div class="form-group  ">
                            <label for="fproduct"
                                class="col-sm-2 control-label">Product</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fproduct"
                                    {{ old('fproduct',(empty($product['fproduct'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Product Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control proorder select2" style="width: 100%;"
                                    name="proorder">
                                     <option value="recent" {{ (old('proorder', $product['proorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('proorder', $product['proorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="fservice"
                                class="col-sm-2 control-label">Services</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fservice"
                                    {{ old('fservice',(empty($product['fservice'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Services Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control sorder select2" style="width: 100%;"
                                    name="sorder">
                                    <option value="recent" {{ (old('sorder', $product['sorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('sorder', $product['sorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="faccommo"
                                class="col-sm-2 control-label">Accommodation</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="faccommo"
                                    {{ old('faccommo',(empty($product['faccommo'])?0:1))?'checked':''}}>

                            </div>
                            <label for="fprop"
                                class="col-sm-2 control-label">Accommodation Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control accorder select2" style="width: 100%;"
                                    name="accorder">
                                    <option value="recent" {{ (old('accorder', $product['accorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('accorder', $product['accorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>
 <div class="form-group  ">
                            <label for="faccommo"
                                class="col-sm-2 control-label">Portfolio</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="faport"
                                    {{ old('faport',(empty($product['faport'])?0:1))?'checked':''}}>

                            </div>
                            <label for="portfolio"
                                class="col-sm-2 control-label">Portfolio Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control portorder select2" style="width: 100%;"
                                    name="portorder">
                                    <option value="recent" {{ (old('portorder', $product['portorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('portorder', $product['portorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="faccommo"
                                class="col-sm-2 control-label">Blog</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="fablog"
                                    {{ old('fablog',(empty($product['fablog'])?0:1))?'checked':''}}>

                            </div>
                            <label for="blog"
                                class="col-sm-2 control-label">Blog Order</label>
                            <div class="col-sm-2">                             
                                <select class="form-control blogorder select2" style="width: 100%;"
                                    name="blogorder">
                                    <option value="recent" {{ (old('blogorder', $product['blogorder']??'') ==  'recent')?'selected':'' }}>Recent</option>
                                    <option value="featured" {{ (old('blogorder', $product['blogorder']??'') ==  'featured')?'selected':'' }}>Featured (Random)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group  ">
                                    <label for="testimonial"
                                        class="col-sm-2  control-label">Meet the team</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="testimonial"
                                            {{  old('testimonial',(empty($product['testimonial'])?0:1))?'checked':''}}>
                                    </div>
                                </div>


@if (sc_config('product_kind'))
                        @if ($product->kind == SC_PRODUCT_GROUP)
                        {{-- List product in groups --}}
                        <hr>
                        <div class="form-group {{ $errors->has('productInGroup') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-8"><label>{{ trans('product.admin.select_product_in_group') }}</label>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('productInGroup') ? ' has-error' : '' }}">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                @php
                                $listgroups= [];
                                $groups = old('productInGroup',$product->groups->pluck('product_id')->toArray());
                                if(is_array($groups)){
                                foreach($groups as $value){
                                $listgroups[] = (int)$value;
                                }
                                }
                                @endphp
                                @if ($listgroups)
                                @foreach ($listgroups as $pID)
                                @if ((int)$pID)
                                @php
                                $newHtml = str_replace('value="'.(int)$pID.'"', 'value="'.(int)$pID.'" selected',
                                $htmlSelectGroup);
                                @endphp
                                {!! $newHtml !!}
                                @endif
                                @endforeach
                                @endif
                                <div id="position_group_flag"></div>
                                @if ($errors->has('productInGroup'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productInGroup') }}
                                </span>
                                @endif
                                <button type="button" id="add_product_in_group" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product') }}
                                </button>
                                @if ($errors->has('productInGroup'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productInGroup') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //end List product in groups --}}
                        @endif



                        @if ($product->kind == SC_PRODUCT_BUILD)
                        <hr>
                        {{-- List product build --}}
                        <div class="form-group {{ $errors->has('productBuild') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-8">
                                <label>{{ trans('product.admin.select_product_in_build') }}</label>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('productBuild') ? ' has-error' : '' }}">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="row"></div>

                                @php
                                $listBuilds= [];
                                $groups = old('productBuild',$product->builds->pluck('product_id')->toArray());
                                $groupsQty = old('productBuildQty',$product->builds->pluck('quantity')->toArray());
                                if(is_array($groups)){
                                foreach($groups as $key => $value){
                                $listBuilds[] = (int)$value;
                                $listBuildsQty[] = (int)$groupsQty[$key];
                                }
                                }
                                @endphp

                                @if ($listBuilds)
                                @foreach ($listBuilds as $key => $pID)
                                @if ((int)$pID && $listBuildsQty[$key])
                                @php
                                $newHtml = str_replace('value="'.(int)$pID.'"', 'value="'.(int)$pID.'" selected',
                                $htmlSelectBuild);
                                $newHtml = str_replace('name="productBuildQty[]" value="1" min=1',
                                'name="productBuildQty[]" value="'.$listBuildsQty[$key].'"', $newHtml);
                                @endphp
                                {!! $newHtml !!}
                                @endif
                                @endforeach
                                @endif
                                <div id="position_build_flag"></div>
                                @if ($errors->has('productBuild'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productBuild') }}
                                </span>
                                @endif
                                <button type="button" id="add_product_in_build" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product') }}
                                </button>
                                @if ($errors->has('productBuild') || $errors->has('productBuildQty'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productBuild') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //end List product build --}}
                        @endif
@endif


@if (sc_config('product_attribute'))
                    @if ($product->kind == SC_PRODUCT_SINGLE)
                        {{-- List product attributes --}}
                        <hr>
                        @if (!empty($attributeGroup))
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-8">
                                <label>{{ trans('product.attribute') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">

                                @php
                                $dataAtt = [];
                                if(old('attribute')){
                                    $dataAtt = old('attribute');
                                } else {
                                    $getDataAtt = $product->attributes->groupBy('attribute_group_id')->toArray();
                                    if(count($getDataAtt)) {
                                        foreach ($getDataAtt as $groupKey => $row) {
                                        $dataAtt[$groupKey] = array_column($row, 'name');
                                        $priceAttr[$groupKey] = array_column($row, 'price');
                                        }
                                        
                                       
                                    }
                                }
                                @endphp

                                @foreach ($attributeGroup as $attGroupId => $attName)
                                    <table width="100%">
                                        <tr>
                                            <td colspan="2"><b>{{ $attName }}:</b><br></td>
                                        </tr>
                                        
                                    @if (!empty($dataAtt[$attGroupId]))
                                   
                                        <?php $prcnt=0;  ?>
                                        @foreach ($dataAtt[$attGroupId] as $attValue)
                                        <?php $prcatt =  $priceAttr[$attGroupId][$prcnt]; 
                                        $prcnt++;  
                                         ?>
                                            @if ($attValue)
                                                @php
                                                $newHtml = str_replace('attribute_group', $attGroupId, $htmlProductAtrribute);
                                                $newHtml = str_replace('attribute_value', $attValue, $newHtml);
                                                $newHtml = str_replace('attribute_price', $attGroupId, $newHtml);
                                                $newHtml = str_replace('price_value', $prcatt, $newHtml);
                                                @endphp
                                                {!! $newHtml !!}
                                            @endif
                                        @endforeach


                                    @endif
                                        <tr>
                                            <td colspan="2"><br><button type="button"
                                                    class="btn btn-flat btn-success add-attribute"
                                                    data-id="{{ $attGroupId }}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    {{ trans('product.admin.add_attribute') }}
                                                </button><br></td>
                                        </tr>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        {{-- //end List product attributes --}}
                    @endif
@endif

                    </div>
                </div>



                <!-- /.box-body -->

                <div class="box-footer">
                    @csrf
                    <div class="col-md-2"></div>

                    <div class="col-md-8">
                        <div class="btn-group pull-right">
                             <a  href="{{ $product->getUrl() }}" class="btn btn-primary">Preview </a>
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

{{-- input image --}}
{{-- <link rel="stylesheet" href="{{ asset('admin/plugin/fileinput.min.css')}}"> --}}

@endpush

@push('scripts')
<!--ckeditor-->
<script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

{{-- input image --}}
{{-- <script src="{{ asset('admin/plugin/fileinput.min.js')}}"></script> --}}

{{-- switch --}}
<script src="{{ asset('admin/plugin/bootstrap-switch.min.js')}}"></script>

<script type="text/javascript">
    $("[name='top'],[name='status'],[name='featured'],[name='fprop'],[name='fnews'],[name='fproduct'],[name='fservice'],[name='faccommo'],[name='testimonial'],[name='faport'],[name='fablog']").bootstrapSwitch();
</script>

<script type="text/javascript">
    $('select.provincia').change(function(){
       var prov = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ route('admin_product.getloc') }}',
                data: {
                  prov:prov,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('select.localidad').html(data);
                   $('select.location').html('');
                }
            });
    });

    $('select.localidad').change(function(){
       var loc = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ route('admin_product.getsubloc') }}',
                data: {
                  loc:loc,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('select.location').html(data);
                }
            });
    });

    $('select.add_subloc').change(function(){
       var loc = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ route('admin_product.getsubloc') }}',
                data: {
                  loc:loc,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('select.add_loc').html(data);
                }
            });
    });
    $('select.add_mainloc').change(function(){
       var prov = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ route('admin_product.getloc') }}',
                data: {
                  prov:prov,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('select.add_subloc').html(data);
                   $('select.add_loc').html('');
                }
            });
    });

     $('select.protype').change(function(){
       var type = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ route('admin_product.getprotype') }}',
                data: {
                  type:type,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('select.procat').html(data);
                }
            });
    });
    // Promotion
$('#add_product_promotion').click(function(event) {
    $(this).before('<div class="price_promotion"><div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span><input type="number" style="width: 100px;"  id="price_promotion" name="price_promotion" value="0" class="form-control input-sm price" placeholder="" /><span title="Remove" class="btn btn-flat btn-sm btn-danger removePromotion"><i class="fa fa-times"></i></span></div><div class="form-inline"><div class="input-group">{{ trans('product.price_promotion_start') }}<br><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span><input type="text" style="width: 100px;"  id="price_promotion_start" name="price_promotion_start" value="" class="form-control input-sm price_promotion_start date_time" placeholder="" /></div></div><div class="input-group">{{ trans('product.price_promotion_end') }}<br><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span><input type="text" style="width: 100px;"  id="price_promotion_end" name="price_promotion_end" value="" class="form-control input-sm price_promotion_end date_time" placeholder="" /></div></div></div></div>');
    $(this).hide();
    $('.removePromotion').click(function(event) {
        $(this).closest('.price_promotion').remove();
        $('#add_product_promotion').show();
    });
    $('.date_time').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
});
$('.removePromotion').click(function(event) {
    $('#add_product_promotion').show();
    $(this).closest('.price_promotion').remove();
});
//End promotion

// Add sub images
var id_sub_image = {{ $ttlimg }};
$('#add_sub_image').click(function(event) {  
$('.newimage').val(1); 
    id_sub_image +=1;
    $(this).before('<div class="group-image"><div class="input-group nnnimg"><input type="text" id="sub_image_'+id_sub_image+'" name="new_image[]" value="" class="form-control input-sm sub_image" placeholder=""  /><span class="input-group-btn"><span><a data-input="sub_image_'+id_sub_image+'" data-preview="preview_sub_image_'+id_sub_image+'" data-type="product" class="btn btn-sm btn-flat btn-primary lfm"><i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}</a></span><span title="Remove" class="btn btn-flat btn-sm btn-danger removeImage"><i class="fa fa-times"></i></span></span></div><div id="preview_sub_image_'+id_sub_image+'" class="img_holder "></div><input type="hidden" name="newimg[]"><div class="input-group"><input type="text" id="imagealt" name="nimagealt[]"  class="form-control input-sm imagealt" placeholder="Image alt text" />  </div></div>');
    $('.removeImage').click(function(event) {       
         $(this).parents('.group-image').remove();
            if($('.nnnimg').is(':visible'))
             {                 
            }
            else
            {
                $('.newimage').val(0);  
            }
            
        });
    $('.lfm').filemanager();
});
    $('.removeImage').click(function(event) {
       if(confirm('Are you sure you want to delete it?')) {
        var imgid = $(this).data('src');
        var it = $(this);
         $.ajax({
                method: 'post',
                url: '{{ route('admin_product.deleteimg') }}',
                data: {
                  imgid:imgid,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {

                   it.closest('.group-image').remove();
                }
            });
        
       }
       
    });
//end sub images

// Select product in group
$('#add_product_in_group').click(function(event) {
    var htmlSelectGroup = '{!! $htmlSelectGroup !!}';
    $(this).before(htmlSelectGroup);
    $('.select2').select2();
    $('.removeproductInGroup').click(function(event) {
        $(this).closest('table').remove();
    });
});
$('.removeproductInGroup').click(function(event) {
    $(this).closest('table').remove();
});
//end select in group

// Select product in build
$('#add_product_in_build').click(function(event) {
    var htmlSelectBuild = '{!! $htmlSelectBuild !!}';
    $(this).before(htmlSelectBuild);
    $('.select2').select2();
    $('.removeproductBuild').click(function(event) {
        $(this).closest('table').remove();
    });
});
$('.removeproductBuild').click(function(event) {
    $(this).closest('table').remove();
});
//end select in build


// Select product attributes
$('.add-attribute').click(function(event) {
    var htmlProductAtrribute = '{!! $htmlProductAtrribute??'' !!}';
    var attGroup = $(this).attr("data-id");
    htmlProductAtrribute = htmlProductAtrribute.replace("attribute_group", attGroup);
    htmlProductAtrribute = htmlProductAtrribute.replace("attribute_price", attGroup);
    htmlProductAtrribute = htmlProductAtrribute.replace("attribute_value", "");
    htmlProductAtrribute = htmlProductAtrribute.replace("price_value", "");
    $(this).closest('tr').before(htmlProductAtrribute);
    $('.removeAttribute').click(function(event) {
        $(this).parents('tr').next('tr').remove();
        $(this).closest('tr').remove();
    });
});
$('.removeAttribute').click(function(event) {
     $(this).parents('tr').next('tr').remove();
     $(this).closest('tr').remove();
});
//end select attributes

$(document).ready(function() {
    $('.select2').select2()
});

//Date picker
$('.date_time').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd'
})

$('textarea.editor').ckeditor(
    {
        filebrowserImageBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=product',
        filebrowserImageUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=product&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=Files',
        filebrowserUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=file&_token={{csrf_token()}}',
        filebrowserWindowWidth: '900',
        filebrowserWindowHeight: '500'
    }
);
</script>

@endpush