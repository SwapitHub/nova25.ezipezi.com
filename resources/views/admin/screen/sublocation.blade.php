@extends('admin.layout')

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $title_description??'' }}</h2>

                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="{{ route('admin_subloc.index') }}" class="btn  btn-flat btn-default" title="List"><i
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
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="provincia" class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm provincia select2" style="width: 100%;"
                                    name="provincia">
                                    <option value=""></option>
                                    <?php foreach ($provi as $pro) { ?>
                                    <option value="{{ $pro->id }}" <?php if(isset($sublocation['provincia'])) { 
                                        if($sublocation['provincia']==$pro->id) echo "selected"; }  ?>  >
                                        
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

                         <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="provincia" class="col-sm-2 control-label">State</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm localidad select2" style="width: 100%;"
                                    name="localidad">
                                    <?php foreach ($states as $state) { ?>
                                    <option value="{{ $state->id }}" <?php if(isset($sublocation['state'])) { 
                                        if($sublocation['state']==$state->id) echo "selected"; }  ?>  >
                                        
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


                                <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-2  control-label">Location <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="name" name="name"
                                                value="{!! old('name',($sublocation['name']??'')) !!}" class="form-control"
                                                placeholder="" />
                                        </div>
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                 

                                <div class="form-group   {{ $errors->has('alias') ? ' has-error' : '' }}">
                                    <label for="alias" class="col-sm-2  control-label">{!! trans('alias') !!}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="alias" name="alias"
                                                value="{!! old('alias',($sublocation['alias']??'')) !!}" class="form-control"
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
                                                value="{!! old('url',($sublocation['url']??'')) !!}" class="form-control"
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
                                                value="{!! old('sort',($sublocation['sort']??0)) !!}"
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
                                        class="col-sm-2  control-label">{{ trans('sublocation.status') }}</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="status"
                                            {{  old('status',(empty($sublocation['status'])?0:1))?'checked':''}}>
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
<link rel="stylesheet" href="{{ asset('admin/AdminLTE/bower_components/select2/dist/css/select2.min.css')}}">

{{-- switch --}}
<link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-switch.min.css')}}">

@endpush

@push('scripts')
<!-- Select2 -->
<script src="{{ asset('admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

{{-- switch --}}
<script src="{{ asset('admin/plugin/bootstrap-switch.min.js')}}"></script>

<script type="text/javascript">
    $("[name='top'],[name='status']").bootstrapSwitch();
</script>

<script type="text/javascript">
    $(document).ready(function() {
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
                }
            });
    });

    $('.select2').select2()
});

</script>

@endpush