@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ $title_description ?? '' }}</h2>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="{{ route('admin_slider.index') }}" class="btn  btn-flat btn-default" title="List"><i
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

                            @foreach ($languages as $code => $language)
                                <div class="form-group">
                                    <label class="col-sm-2  control-label"></label>
                                    <div class="col-sm-8">
                                        <b>{{ $language->name }}</b>
                                        {!! sc_image_render($language->icon, '20px', '20px') !!}
                                    </div>
                                </div>
                            @endforeach
                            {{-- @php
                                dd($slider['name']);
                            @endphp --}}
                            <div
                                class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-2  control-label">name <span
                                        class="seo" title="SEO"><i class="fa fa-coffee"
                                            aria-hidden="true"></i></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="name" name="name" value="{{ old('name',isset($slider['name'])?$slider['name']:'' ) }}"
                                            class="form-control " placeholder="" />
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('keyword') ? ' has-error' : '' }}">
                                <label for="keyword" class="col-sm-2  control-label">keyword <span class="seo"
                                        title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="keyword" name="keyword" value="{!! old('keyword', isset($slider['keyword'])?$slider['keyword']:'' ?? '') !!}"
                                            class="form-control {{ 'keyword' }}" placeholder="" />
                                    </div>
                                    @if ($errors->has('keyword'))
                                        <span class="help-block">
                                            {{ $errors->first('keyword') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-sm-2  control-label">description <span class="seo"
                                        title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <textarea id="description" name="description" class="editor">
                                         {!! old('description', isset($slider['description'])?$slider['description']:'' ?? '') !!}"
                                    </textarea>

                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            {{ $errors->first('description') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr>

                            {{-- <div class="form-group  {{ $errors->has('parent') ? ' has-error' : '' }}"
                                style="display: none;">
                                <label for="parent"
                                    class="col-sm-2 asterisk control-label">{{ trans('slider.admin.select_slider') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control parent select2" style="width: 100%;" name="parent">
                                        <option value=""></option>
                                        @php
                                            $categories = [0 => '==ROOT=='] + $categories;
                                        @endphp
                                        @foreach ($categories as $k => $v)
                                            <option value="{{ $k }}"
                                                {{ old('parent', $slider['parent'] ?? '') == $k ? 'selected' : '' }}>
                                                {{ $v }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('parent'))
                                        <span class="help-block">
                                            {{ $errors->first('parent') }}
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="form-group   {{ $errors->has('alias') ? ' has-error' : '' }}">
                                <label for="alias" class="col-sm-2  control-label">alias</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="alias" name="alias" value="{!! old('alias', $slider['alias'] ?? '') !!}"
                                            class="form-control" placeholder="" />
                                    </div>
                                    @if ($errors->has('alias'))
                                        <span class="help-block">
                                            {{ $errors->first('alias') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                                <label for="sort" class="col-sm-2  control-label">{{ trans('sort') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="number" style="width: 100px;" id="sort" name="sort"
                                            value="{!! old() ? old('sort') : $slider['sort'] ?? 0 !!}" class="form-control sort" placeholder="" />
                                    </div>
                                    @if ($errors->has('sort'))
                                        <span class="help-block">
                                            {{ $errors->first('sort') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- <div class="form-group  ">
                                            <label for="top" class="col-sm-2  control-label">{{ trans('slider.top') }}</label>
                                            <div class="col-sm-8">
                                                <input type="checkbox" name="top"
                                                    {{ old('top', empty($slider['top']) ? 0 : 1) ? 'checked' : '' }}>
                                            </div>
                                        </div> -->

                            <div class="form-group  ">
                                <label for="status" class="col-sm-2  control-label">status</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" name="status"
                                        {{ old('status', empty($slider['status']) ? 0 : 1) ? 'checked' : '' }}>

                                </div>
                            </div>

                            {{-- <div class="form-group {{ $errors->has('page') ? ' has-error' : '' }}">
                                <label for="page" class="col-sm-2 control-label">page</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm page select2" style="width: 100%;"
                                        name="page">
                                        <option value=""></option>
                                        <?php foreach ($pages as $page) { ?>
                                        <option value="{{ $page->id }}" <?php if (isset($slider['page'])) {
                                            if ($slider['page'] == $page->id) {
                                                echo 'selected';
                                            }
                                        } ?>>

                                            {{ $page->title }}</option>
                                        <?php } ?>
                                    </select>
                                    @if ($errors->has('page'))
                                        <span class="help-block">
                                            {{ $errors->first('page') }}
                                        </span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="form-group  {{ $errors->has('startdate') ? ' has-error' : '' }}">
                                <label for="startdate" class="col-sm-2  control-label">Date Listed</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                        <input type="text" style="width: 100px;" id="startdate" name="startdate"
                                            value="{!! old('startdate', date('Y-m-d') ?? '') !!}"
                                            class="form-control input-sm startdate date_time" placeholder="" />
                                    </div>
                                    @if ($errors->has('startdate'))
                                        <span class="help-block">
                                            <i class="fa fa-info-circle"></i> {{ $errors->first('startdate') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group  {{ $errors->has('expire') ? ' has-error' : '' }}">
                                <label for="expire" class="col-sm-2  control-label">Expiry Date</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                        <input type="text" style="width: 100px;" id="expire" name="expire"
                                            value="{!! old('expire', $slider['expire'] ?? '') !!}" class="form-control input-sm expire date_time"
                                            placeholder="" />
                                    </div>
                                    @if ($errors->has('expire'))
                                        <span class="help-block">
                                            <i class="fa fa-info-circle"></i> {{ $errors->first('expire') }}
                                        </span>
                                    @endif
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
    <link rel="stylesheet" href="{{ asset('admin/AdminLTE/bower_components/select2/dist/css/select2.min.css') }}">

    {{-- switch --}}
    <link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-switch.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    {{-- switch --}}
    <script src="{{ asset('admin/plugin/bootstrap-switch.min.js') }}"></script>

    <script type="text/javascript">
        $("[name='top'],[name='status']").bootstrapSwitch();
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2()
        });
    </script>
    <script type="text/javascript">
        $('textarea.editor').ckeditor({
            filebrowserImageBrowseUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}?type=page',
            filebrowserImageUploadUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}/upload?type=page&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}?type=Files',
            filebrowserUploadUrl: '{{ route('admin.home') . '/' . config('lfm.url_prefix') }}/upload?type=file&_token={{ csrf_token() }}',
            filebrowserWindowWidth: '900',
            filebrowserWindowHeight: '500'
        });
        //Date picker
        $('.date_time').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        })
    </script>
@endpush
