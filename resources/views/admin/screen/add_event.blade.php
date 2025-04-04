@extends('admin.layout')

@section('main')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ $title_description ?? '' }}</h2>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="{{ route('admin_event.index') }}" class="btn  btn-flat btn-default" title="List"><i
                                    class="fa fa-list"></i><span class="hidden-xs">
                                    {{ trans('admin.back_list') }}</span></a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal"
                    id="form-main" enctype="multipart/form-data">


                    <div class="box-body">
                        <div class="fields-group">


                            <div class="box-body">
                                <div class="fields-group">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="provincia" class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm provincia select2" style="width: 100%;"
                                                name="provincia">
                                                <option value=""></option>
                                                <?php foreach ($provi as $pro) { ?>
                                                <option value="{{ $pro->id }}" <?php if (isset($event['provincia'])) {
                                                    if ($event['provincia'] == $pro->id) {
                                                        echo 'selected';
                                                    }
                                                } ?>>

                                                    {{ $pro->name }}</option>
                                                <?php } ?>
                                            </select>
                                            @if ($errors->has('provincia'))
                                                <span class="help-block">
                                                    {{ $errors->first('provincia') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="provincia" class="col-sm-2 control-label">State</label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm localidad select2" style="width: 100%;"
                                                name="localidad">
                                                <?php foreach ($states as $state) { ?>
                                                <option value="{{ $state->id }}" <?php if (isset($event['state'])) {
                                                    if ($event['state'] == $state->id) {
                                                        echo 'selected';
                                                    }
                                                } ?>>

                                                    {{ $state->name }}</option>
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
                                                <option value="{{ $loc->id }}" <?php if (isset($event['location'])) {
                                                    if ($event['location'] == $loc->id) {
                                                        echo 'selected';
                                                    }
                                                } ?>>

                                                    {{ $loc->name }}</option>
                                                <?php } ?>
                                            </select>
                                            @if ($errors->has('location'))
                                                <span class="help-block">
                                                    {{ $errors->first('location') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-sm-2  control-label">Event name </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="name" name="name"
                                                    value="{!! old('name', $event['name'] ?? '') !!}" class="form-control" placeholder="" />
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('introduction') ? ' has-error' : '' }}">
                                        <label for="introduction" class="col-sm-2 control-label">Introduction</label>
                                        <div class="col-sm-8">
                                            <textarea id="introduction" name="introduction" class="editor">
                                        {!! old('introduction', $event['introduction'] ?? '') !!}
                                    </textarea>
                                            @if ($errors->has('introduction'))
                                                <span class="help-block">
                                                    {{ $errors->first('introduction') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label for="content" class="col-sm-2 control-label">content</label>
                                        <div class="col-sm-8">
                                            <textarea id="content" class="editor" name="content">
                                        {!! old('content', $event['content'] ?? '') !!}
                                    </textarea>
                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                                    {{ $errors->first('content') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('embedcode') ? ' has-error' : '' }}">
                                        <label for="embedcode" class="col-sm-2 control-label">Youtube/Google Map embed
                                            code</label>
                                        <div class="col-sm-8">
                                            <textarea id="embedcode" name="embedcode" class="form-control">{!! old('embedcode', $event['embedcode'] ?? '') !!}</textarea>
                                            @if ($errors->has('embedcode'))
                                                <span class="help-block">
                                                    {{ $errors->first('embedcode') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('rsvp_link') ? ' has-error' : '' }}">
                                        <label for="rsvp_link" class="col-sm-2 control-label">RSVP Now Link </label>
                                        <div class="col-sm-8">
                                            <textarea id="rsvp_link" name="rsvp_link" class="form-control">{!! old('rsvp', $event['rsvp_link'] ?? '') !!}</textarea>
                                            @if ($errors->has('rsvp_link'))
                                                <span class="help-block">
                                                    {{ $errors->first('rsvp_link') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('read_more_link') ? ' has-error' : '' }}">
                                        <label for="read_more_link" class="col-sm-2 control-label">Read More Link </label>
                                        <div class="col-sm-8">
                                            <textarea id="read_more_link" name="read_more_link" class="form-control">{!! old('rsvp', $event['read_more_link'] ?? '') !!}</textarea>
                                            @if ($errors->has('read_more_link'))
                                                <span class="help-block">
                                                    {{ $errors->first('read_more_link') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    

                                    <!--    <div
                                class="form-group {{ $errors->has('contact') ? ' has-error' : '' }}">
                                <label for="contact"
                                    class="col-sm-2 control-label">Contact Details</label>
                                <div class="col-sm-8">
                                    <textarea id="contact" class="editor" name="contact">
                                        {!! old('contact', $event['contact'] ?? '') !!}
                                    </textarea>
                                   @if ($errors->has('contact'))
    <span class="help-block">
                                        {{ $errors->first('contact') }}
                                    </span>
    @endif
                                </div>
                            </div> -->



                                    <div class="form-group   {{ $errors->has('street1') ? ' has-error' : '' }}">
                                        <label for="street1" class="col-sm-2  control-label">Street Address1 </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="street1" name="street1"
                                                    value="{!! old('street1', $event['street1'] ?? '') !!}" class="form-control"
                                                    placeholder="" />
                                            </div>
                                            @if ($errors->has('street1'))
                                                <span class="help-block">
                                                    {{ $errors->first('street1') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group   {{ $errors->has('street2') ? ' has-error' : '' }}">
                                        <label for="street2" class="col-sm-2  control-label">Street Address2 </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="street2" name="street2"
                                                    value="{!! old('street2', $event['street2'] ?? '') !!}" class="form-control"
                                                    placeholder="" />
                                            </div>
                                            @if ($errors->has('street2'))
                                                <span class="help-block">
                                                    {{ $errors->first('street2') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group   {{ $errors->has('street3') ? ' has-error' : '' }}">
                                        <label for="street3" class="col-sm-2  control-label">Street Address3 </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="street3" name="street3"
                                                    value="{!! old('street3', $event['street3'] ?? '') !!}" class="form-control"
                                                    placeholder="" />
                                            </div>
                                            @if ($errors->has('street3'))
                                                <span class="help-block">
                                                    {{ $errors->first('street3') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group   {{ $errors->has('longitude') ? ' has-error' : '' }}">
                                        <label for="longitude" class="col-sm-2  control-label">longitude </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="longitude" id="longitude" name="longitude"
                                                    value="{!! old('longitude', $event['longitude'] ?? '') !!}" class="form-control"
                                                    placeholder="" />
                                            </div>
                                            @if ($errors->has('longitude'))
                                                <span class="help-block">
                                                    {{ $errors->first('longitude') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group   {{ $errors->has('lattitude') ? ' has-error' : '' }}">
                                        <label for="lattitude" class="col-sm-2  control-label">lattitude </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="lattitude" name="lattitude"
                                                    value="{!! old('lattitude', $event['lattitude'] ?? '') !!}" class="form-control"
                                                    placeholder="" />
                                            </div>
                                            @if ($errors->has('lattitude'))
                                                <span class="help-block">
                                                    {{ $errors->first('lattitude') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group  kind kind0 kind1  {{ $errors->has('startdate') ? ' has-error' : '' }}">
                                        <label for="startdate" class="col-sm-2  control-label">Event Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar fa-fw"></i></span>
                                                <input type="text" style="width: 100px;" id="startdate"
                                                    name="startdate" value="{!! old('startdate', date('Y-m-d') ?? '') !!}"
                                                    class="form-control input-sm startdate date_time" placeholder="" />
                                            </div>
                                            @if ($errors->has('startdate'))
                                                <span class="help-block">
                                                    <i class="fa fa-info-circle"></i> {{ $errors->first('startdate') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group  kind kind0 kind1  {{ $errors->has('eventtime') ? ' has-error' : '' }}">
                                        <label for="eventtime" class="col-sm-2  control-label">Event Time</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-clock-o fa-fw"></i></span>
                                                <input type="time" style="width: 100px;" id="eventtime"
                                                    name="eventtime" value="{!! old('eventtime', date('Y-m-d') ?? '') !!}"
                                                    class="form-control input-sm eventtime " placeholder="" />
                                            </div>
                                            @if ($errors->has('eventtime'))
                                                <span class="help-block">
                                                    <i class="fa fa-info-circle"></i> {{ $errors->first('eventtime') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    

                                    {{-- <div
                                        class="form-group  kind kind0 kind1  {{ $errors->has('expire') ? ' has-error' : '' }}">
                                        <label for="expire" class="col-sm-2  control-label">Expiry Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar fa-fw"></i></span>
                                                <input type="text" style="width: 100px;" id="expire"
                                                    name="expire" value="{!! old('expire', $event['expire'] ?? '') !!}"
                                                    class="form-control input-sm expire date_time" placeholder="" />
                                            </div>
                                            @if ($errors->has('expire'))
                                                <span class="help-block">
                                                    <i class="fa fa-info-circle"></i> {{ $errors->first('expire') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div> --}}

                                    <div class="form-group   {{ $errors->has('alias') ? ' has-error' : '' }}">
                                        <label for="alias"
                                            class="col-sm-2  control-label">Tickets Available</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="tickets_available" name="tickets_available"
                                                    value="{!! old('tickets_available', $event['tickets_available'] ?? '') !!}" class="form-control"
                                                    placeholder="" />
                                            </div>
                                            @if ($errors->has('tickets_available'))
                                                <span class="help-block">
                                                    {{ $errors->first('tickets_available') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group   {{ $errors->has('alias') ? ' has-error' : '' }}">
                                        <label for="alias"
                                            class="col-sm-2  control-label">{!! trans('alias') !!}</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="alias" name="alias"
                                                    value="{!! old('alias', $event['alias'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('url', $event['url'] ?? '') !!}" class="form-control"
                                                    placeholder="" />
                                            </div>
                                            @if ($errors->has('url'))
                                                <span class="help-block">
                                                    {{ $errors->first('url') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group   {{ $errors->has('image') ? ' has-error' : '' }}">
                                        <label for="image" class="col-sm-2  control-label">image</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" id="image" name="image"
                                                    value="{{ old('image', $event['image'] ?? '') }}"
                                                    class="form-control input-sm image" placeholder="" />
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="preview_image"
                                                        data-type="portfolio" class="btn btn-sm btn-primary lfm">
                                                        <i class="fa fa-picture-o"></i>
                                                        {{ trans('product.admin.choose_image') }}
                                                    </a>
                                                </span>
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="help-block">
                                                    {{ $errors->first('image') }}
                                                </span>
                                            @endif
                                            <div id="preview_image" class="img_holder">
                                                @if (old('image', $event['image'] ?? ''))
                                                    <img src="{{ asset(old('image', $event['image'] ?? '')) }}">
                                                @endif

                                            </div>
                                            <div class="input-group">
                                                <input type="text" id="image_alt" name="image_alt"
                                                    value="{{ old('image_alt', $event['image_alt'] ?? '') }}"
                                                    class="form-control input-sm imagealt" placeholder="Image alt text" />

                                            </div>


                                            @if (!empty(old('sub_image')))
                                                @foreach (old('sub_image') as $key => $sub_image)
                                                    @if ($sub_image)
                                                        <div class="group-image">
                                                            <div class="input-group"><input type="text"
                                                                    id="sub_image_{{ $key }}" name="sub_image[]"
                                                                    value="{!! $sub_image !!}"
                                                                    class="form-control input-sm sub_image"
                                                                    placeholder="" /><span
                                                                    class="input-group-btn"><span><a
                                                                            data-input="sub_image_{{ $key }}"
                                                                            data-preview="preview_sub_image_{{ $key }}"
                                                                            data-type="portfolio"
                                                                            class="btn btn-sm btn-flat btn-primary lfm"><i
                                                                                class="fa fa-picture-o"></i>
                                                                            {{ trans('product.admin.choose_image') }}</a></span><span
                                                                        title="Remove"
                                                                        class="btn btn-flat btn-sm btn-danger removeImage"><i
                                                                            class="fa fa-times"></i></span></span></div>
                                                            <div id="preview_sub_image_{{ $key }}"
                                                                class="img_holder"><img src="{{ asset($sub_image) }}">
                                                            </div>
                                                            <div class="input-group">
                                                                <input type="text" id="imagealt" name="imagealt"
                                                                    value="{{ old('imagealt', $event['imagealt'] ?? '') }}"
                                                                    class="form-control input-sm imagealt"
                                                                    placeholder="Image alt text" />

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif

                                            <button type="button" id="add_sub_image" class="btn btn-flat btn-success">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                {{ trans('product.admin.add_sub_image') }}
                                            </button>

                                        </div>
                                    </div>



                                    <div class="form-group {{ $errors->has('eventtype') ? ' has-error' : '' }}">
                                        <label for="eventtype" class="col-sm-2 control-label">Event type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm eventtype select2" style="width: 100%;"
                                                name="eventtype">
                                                <option value=""></option>
                                                <?php foreach($eventtype as $type) { ?>
                                                <option value="{{ $type->id }}" <?php if (isset($event['eventtype'])) {
                                                    if ($event['eventtype'] == $type->id) {
                                                        echo 'selected';
                                                    }
                                                } ?>>

                                                    {{ $type->name }}</option>
                                                <?php } ?>
                                            </select>
                                            @if ($errors->has('eventtype'))
                                                <span class="help-block">
                                                    {{ $errors->first('eventtype') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group {{ $errors->has('audience_type') ? ' has-error' : '' }}">
                                        <label for="eventtype" class="col-sm-2 control-label">Audience Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm eventtype select2" style="width: 100%;"
                                                name="audience_type">
                                                <option value="All Welcome">All Welcome</option>
                                                <option value="Child Friendly">Child Friendly</option>
                                                <option value="Adults Only">Adults Only</option>
                                                <option value="Over 16">Over 16</option>
                                            </select>
                                            @if ($errors->has('audience_type'))
                                                <span class="help-block">
                                                    {{ $errors->first('audience_type') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('branch') ? ' has-error' : '' }}">
                                        <label for="branch" class="col-sm-2 control-label">Branch</label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm branch select2" style="width: 100%;"
                                                name="branch">
                                                <option value=""></option>
                                                <?php foreach($branch as $br) { ?>
                                                <option value="{{ $br->id }}" <?php if (isset($event['branch'])) {
                                                    if ($event['branch'] == $br->id) {
                                                        echo 'selected';
                                                    }
                                                } ?>>

                                                    {{ $br->name }}</option>
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
                                                name="author[]" multiple="multiple">
                                                <option value=""></option>
                                                <?php foreach($users as $author) { ?>
                                                <option value="{{ $author->id }}" <?php if (isset($event['author'])) {
                                                    if ($event['author'] == $author->id) {
                                                        echo 'selected';
                                                    }
                                                } ?>>

                                                    {{ $author->name }}</option>
                                                <?php } ?>
                                            </select>
                                            @if ($errors->has('author'))
                                                <span class="help-block">
                                                    {{ $errors->first('author') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                                        <label for="sort" class="col-sm-2  control-label">{{ trans('sort') }}</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="number" style="width: 100px;" min=0 id="sort"
                                                    name="sort" value="{!! old('sort', $event['sort'] ?? 0) !!}"
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
                                                {{ old('status', empty($event['status']) ? 0 : 1) ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group  ">
                                        <label for="featured" class="col-sm-2  control-label">Featured</label>
                                        <div class="col-sm-8">
                                            <input type="checkbox" name="featured"
                                                {{ old('featured', empty($event['featured']) ? 0 : 1) ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <?php foreach ($tagtype as $type ) { 
                                $tags = App\Models\EventTag::getTags($type->id); 
                                ?>
                                    <div class="form-group tags">


                                        <label for="{{ $type->name }}"
                                            class="col-sm-2  control-label">{{ $type->name }}</label>

                                        <div class="col-sm-8">
                                            <?php foreach ($tags as $tag) { ?>

                                            <input type="checkbox" name="tags[]"
                                                value="{{ $tag->id }}">{{ $tag->name }}
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
                                                <textarea class="form-control" name="notes">{!! old('notes', $event['notes'] ?? '') !!}</textarea>


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
                                                    value="{!! old('add_regname', $event['add_regname'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_fname', $event['add_fname'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_lname', $event['add_lname'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_email', $event['add_email'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_postal1', $event['add_postal1'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_postal2', $event['add_postal2'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_postal3', $event['add_postal3'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_postcode', $event['add_postcode'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_busiphone', $event['add_busiphone'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_homephone', $event['add_homephone'] ?? '') !!}" class="form-control"
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
                                                    value="{!! old('add_cellphone', $event['add_cellphone'] ?? '') !!}" class="form-control"
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
                                                <option value="{{ $pro->id }}">

                                                    {{ $pro->name }}</option>
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
                                                <?php foreach ($states as $state) { ?>
                                                <option value="{{ $state->id }}">

                                                    {{ $state->name }}</option>
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
                                                <?php foreach ($subloc as $loc) { ?>
                                                <option value="{{ $loc->id }}">

                                                    {{ $loc->name }}</option>
                                                <?php } ?>
                                            </select>
                                            @if ($errors->has('add_loc'))
                                                <span class="help-block">
                                                    {{ $errors->first('add_loc') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <h2>Listing section</h1>

                                <div class="form-group  ">
                                    <label for="fprop" class="col-sm-2 control-label">Property</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="fprop"
                                            {{ old('fprop', empty($event['fprop']) ? 0 : 1) ? 'checked' : '' }}>

                                    </div>
                                    <label for="fprop" class="col-sm-2 control-label">Property Order</label>
                                    <div class="col-sm-2">
                                        <select class="form-control porder select2" style="width: 100%;" name="porder">
                                            <option value="recent"
                                                {{ old('porder', $event['porder'] ?? '') == 'recent' ? 'selected' : '' }}>
                                                Recent</option>
                                            <option value="featured"
                                                {{ old('porder', $event['porder'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                Featured (Random)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label for="fnews" class="col-sm-2 control-label">News</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="fnews"
                                            {{ old('fnews', empty($event['fnews']) ? 0 : 1) ? 'checked' : '' }}>

                                    </div>
                                    <label for="fprop" class="col-sm-2 control-label">News Order</label>
                                    <div class="col-sm-2">
                                        <select class="form-control norder select2" style="width: 100%;" name="norder">
                                            <option value="recent"
                                                {{ old('norder', $event['norder'] ?? '') == 'recent' ? 'selected' : '' }}>
                                                Recent</option>
                                            <option value="featured"
                                                {{ old('norder', $event['norder'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                Featured (Random)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label for="fproduct" class="col-sm-2 control-label">Product</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="fproduct"
                                            {{ old('fproduct', empty($event['fproduct']) ? 0 : 1) ? 'checked' : '' }}>

                                    </div>
                                    <label for="fprop" class="col-sm-2 control-label">Product Order</label>
                                    <div class="col-sm-2">
                                        <select class="form-control proorder select2" style="width: 100%;"
                                            name="proorder">
                                            <option value="recent"
                                                {{ old('proorder', $event['proorder'] ?? '') == 'recent' ? 'selected' : '' }}>
                                                Recent</option>
                                            <option value="featured"
                                                {{ old('proorder', $event['proorder'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                Featured (Random)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label for="fservice" class="col-sm-2 control-label">Services</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="fservice"
                                            {{ old('fservice', empty($event['fservice']) ? 0 : 1) ? 'checked' : '' }}>

                                    </div>
                                    <label for="fprop" class="col-sm-2 control-label">Services Order</label>
                                    <div class="col-sm-2">
                                        <select class="form-control sorder select2" style="width: 100%;" name="sorder">
                                            <option value="recent"
                                                {{ old('sorder', $event['sorder'] ?? '') == 'recent' ? 'selected' : '' }}>
                                                Recent</option>
                                            <option value="featured"
                                                {{ old('sorder', $event['sorder'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                Featured (Random)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label for="faccommo" class="col-sm-2 control-label">Accommodation</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="faccommo"
                                            {{ old('faccommo', empty($event['faccommo']) ? 0 : 1) ? 'checked' : '' }}>

                                    </div>
                                    <label for="fprop" class="col-sm-2 control-label">Accommodation Order</label>
                                    <div class="col-sm-2">
                                        <select class="form-control accorder select2" style="width: 100%;"
                                            name="accorder">
                                            <option value="recent"
                                                {{ old('accorder', $event['accorder'] ?? '') == 'recent' ? 'selected' : '' }}>
                                                Recent</option>
                                            <option value="featured"
                                                {{ old('accorder', $event['accorder'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                Featured (Random)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="faccommo" class="col-sm-2 control-label">Portfolio</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="faport"
                                            {{ old('faport', empty($event['faport']) ? 0 : 1) ? 'checked' : '' }}>

                                    </div>
                                    <label for="portfolio" class="col-sm-2 control-label">Portfolio Order</label>
                                    <div class="col-sm-2">
                                        <select class="form-control portorder select2" style="width: 100%;"
                                            name="portorder">
                                            <option value="recent"
                                                {{ old('portorder', $event['portorder'] ?? '') == 'recent' ? 'selected' : '' }}>
                                                Recent</option>
                                            <option value="featured"
                                                {{ old('portorder', $event['portorder'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                Featured (Random)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label for="faccommo" class="col-sm-2 control-label">Blog</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="fablog"
                                            {{ old('fablog', empty($event['fablog']) ? 0 : 1) ? 'checked' : '' }}>

                                    </div>
                                    <label for="blog" class="col-sm-2 control-label">Blog Order</label>
                                    <div class="col-sm-2">
                                        <select class="form-control blogorder select2" style="width: 100%;"
                                            name="blogorder">
                                            <option value="recent"
                                                {{ old('blogorder', $event['blogorder'] ?? '') == 'recent' ? 'selected' : '' }}>
                                                Recent</option>
                                            <option value="featured"
                                                {{ old('blogorder', $event['blogorder'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                Featured (Random)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="tott"
                                        class="col-sm-2  control-label">Talk of the town</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="tott"
                                            {{  old('tott',(empty($event['tott'])?0:1))?'checked':''}}>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label for="testimonial" class="col-sm-2  control-label">Meet the team</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="testimonial"
                                            {{ old('testimonial', empty($event['testimonial']) ? 0 : 1) ? 'checked' : '' }}>
                                    </div>
                                </div>



                                <!-- /.box-body -->

                                <div class="box-footer">
                                    @csrf
                                    <div class="col-md-2">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="btn-group pull-right">
                                            <button type="submit"
                                                class="btn btn-primary">{{ trans('admin.submit') }}</button>
                                        </div>

                                        <div class="btn-group pull-left">
                                            <button type="reset"
                                                class="btn btn-warning">{{ trans('admin.reset') }}</button>
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
    <link rel="stylesheet" href="{{ asset('admin/AdminLTE/bower_components/select2/dist/css/select2.min.css') }}">

    {{-- switch --}}
    <link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-switch.min.css') }}">
@endpush

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!--ckeditor-->
    <script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>

    {{-- switch --}}
    <script src="{{ asset('admin/plugin/bootstrap-switch.min.js') }}"></script>

    <script type="text/javascript">
        $("[name='tott'],[name='top'],[name='status'],[name='featured'],[name='fprop'],[name='fnews'],[name='fproduct'],[name='fservice'],[name='faccommo'],[name='testimonial'],[name='faport'],[name='fablog']")
            .bootstrapSwitch();
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select.provincia').change(function() {
                var prov = $(this).val();
                $.ajax({
                    method: 'post',
                    url: '{{ route('admin_product.getloc') }}',
                    data: {
                        prov: prov,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('select.localidad').html(data);
                        $('select.location').html('');
                    }
                });
            });

            $('select.localidad').change(function() {
                var loc = $(this).val();
                $.ajax({
                    method: 'post',
                    url: '{{ route('admin_product.getsubloc') }}',
                    data: {
                        loc: loc,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('select.location').html(data);
                    }
                });
            });

            $('select.add_mainloc').change(function() {
                var prov = $(this).val();
                $.ajax({
                    method: 'post',
                    url: '{{ route('admin_product.getloc') }}',
                    data: {
                        prov: prov,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('select.add_subloc').html(data);
                        $('select.add_loc').html('');
                    }
                });
            });

            $('select.add_subloc').change(function() {
                var loc = $(this).val();
                $.ajax({
                    method: 'post',
                    url: '{{ route('admin_product.getsubloc') }}',
                    data: {
                        loc: loc,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('select.add_loc').html(data);
                    }
                });
            });

            $('.select2').select2();
            $('.date_time').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            })
        });
        $('textarea.editor').ckeditor({
            filebrowserImageBrowseUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}?type=content',
            filebrowserImageUploadUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}/upload?type=content&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}?type=Files',
            filebrowserUploadUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}/upload?type=file&_token={{ csrf_token() }}',
            filebrowserWindowWidth: '900',
            filebrowserWindowHeight: '500'
        });

        var id_sub_image = {{ old('sub_image') ? count(old('sub_image')) : 0 }};
        $('#add_sub_image').click(function(event) {
            id_sub_image += 1;
            $(this).before('<div class="group-image"><div class="input-group"><input type="text" id="sub_image_' +
                id_sub_image +
                '" name="sub_image[]" value="" class="form-control input-sm sub_image" placeholder=""  /><span class="input-group-btn"><span><a data-input="sub_image_' +
                id_sub_image + '" data-preview="preview_sub_image_' + id_sub_image +
                '" data-type="portfolio" class="btn btn-sm btn-flat btn-primary lfm"><i class="fa fa-picture-o"></i> {{ trans('product.admin.choose_image') }}</a></span><span title="Remove" class="btn btn-flat btn-sm btn-danger removeImage"><i class="fa fa-times"></i></span></span></div><div id="preview_sub_image_' +
                id_sub_image +
                '" class="img_holder"></div><div class="input-group"><input type="text" id="imagealt" name="imagealt[]"  class="form-control input-sm imagealt" placeholder="Image alt text" />  </div></div>'
                );
            $('.removeImage').click(function(event) {
                $(this).parents('.group-image').remove();
            });
            $('.lfm').filemanager();
        });
        $('.removeImage').click(function(event) {
            $(this).parents('.group-image').remove();
        });
    </script>
@endpush
