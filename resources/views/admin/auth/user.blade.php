@extends('admin.layout')

@section('main')
   <div class="row">
      <div class="col-md-12">
         <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ $title_description??'' }}</h2>
                   <?php if(empty($user)) { ?> 
                    <h4>If new user belongs to new branch, Please <a href="{{ route('admin_branch.create') }}">Add A Branch</a> first.</h4>
               <?php } ?>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="{{ route('admin_user.index') }}" class="btn  btn-flat btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"  enctype="multipart/form-data">


                    <div class="box-body">
                        <div class="fields-group">

                            <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-2  control-label">First name</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="name" name="name" value="{{ old('name',$user['name']??'')}}" class="form-control name" placeholder="" />   
                                    </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-sm-2  control-label">Last name</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="last_name" name="last_name" value="{{ old('last_name',$user['last_name']??'')}}" class="form-control last_name" placeholder="" />   
                                    </div>
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                {{ $errors->first('last_name') }}
                                            </span>
                                        @endif
                                </div>
                            </div>  

                            <div class="form-group   {{ $errors->has('salutation') ? ' has-error' : '' }}">
                                <label for="salutation" class="col-sm-2  control-label">Salutation</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm salutation select2" style="width: 100%;"
                                    name="salutation">    
                                    <option value=""></option>
                                    <option value="Dr." {{ (old('salutation', $user['salutation']??'') ==  'Dr.')?'selected':'' }}  >Dr.</option>
                                    <option value="Miss" {{ (old('salutation', $user['salutation']??'') ==  'Miss.')?'selected':'' }}  >Miss</option>
                                    <option value="Mr." {{ (old('salutation', $user['salutation']??'') ==  'Mr.')?'selected':'' }} >Mr.</option>
                                    <option value="Mrs." {{ (old('salutation', $user['salutation']??'') ==  'Mrs.')?'selected':'' }}  >Mrs.</option>
                                    <option value="Ms."  {{ (old('salutation', $user['salutation']??'') ==  'Ms.')?'selected':'' }} >Ms.</option>
                                    <option value="Prof." {{ (old('salutation', $user['salutation']??'') ==  'Prof.')?'selected':'' }}  >Prof.</option>
                                    
                                    </select>
                                        @if ($errors->has('salutation'))
                                            <span class="help-block">
                                                {{ $errors->first('salutation') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('position') ? ' has-error' : '' }}">
                                    <label for="position" class="col-sm-2  control-label">Position </label>
                                    <div class="col-sm-8">
                                        
                                    <select class="form-control input-sm position select2" style="width: 100%;"
                                    name="position">
                                    <option value=""></option>
                                    
                                    <?php foreach ($positions as $pro) { ?>
                                    <option value="{{ $pro->id }}" {{ (old('position', $user['position']??'') ==  $pro->id)?'selected':'' }}  >
                                        
                                            {{ $pro->name  }}</option>
                                    <?php } ?>
                                   
                                    </select>
                                        
                                        @if ($errors->has('position'))
                                        <span class="help-block">
                                            {{ $errors->first('position') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="form-group   {{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-sm-2  control-label">{{ trans('user.user_name') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="username" name="username" value="{{ old('username',$user['username']??'') }}" class="form-control username" placeholder="" />
                                    </div>
                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                {{ $errors->first('username') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                             <div class="form-group   {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-sm-2  control-label">{{ trans('user.password') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="password"   id="password" name="password" value="{{ old('password')??'' }}" class="form-control password" placeholder="" />
                                    </div>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @else
                                            @if ($user)
                                                <span class="help-block">
                                                     {{ trans('user.admin.keep_password') }}
                                                 </span>
                                            @endif
                                        @endif
                                </div>
                            </div>
                            <div class="form-group   {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password" class="col-sm-2  control-label">{{ trans('user.password_confirmation') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="password"   id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation')??'' }}" class="form-control password_confirmation" placeholder="" />
                                    </div>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                {{ $errors->first('password_confirmation') }}
                                            </span>
                                        @else
                                            @if ($user)
                                                <span class="help-block">
                                                     {{ trans('user.admin.keep_password') }}
                                                 </span>
                                            @endif
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label for="avatar" class="col-sm-2  control-label">{{ trans('user.avatar') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="avatar" name="avatar" value="{{ old('avatar',$user['avatar']??'') }}" class="form-control input-sm avatar image" placeholder=""  />
                                       <span class="input-group-btn">
                                         <a data-input="avatar" data-preview="preview_avatar" data-type="avatar" class="btn btn-sm btn-primary lfm">
                                           <i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
                                         </a>
                                       </span>
                                    </div>
                                        @if ($errors->has('avatar'))
                                            <span class="help-block">
                                                {{ $errors->first('avatar') }}
                                            </span>
                                        @endif
                                    <div id="preview_avatar" class="img_holder"><img src="{{ old('avatar',$user['avatar']??'') }}"></div>
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-2  control-label">Email</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="email"   id="email" name="email" value="{{ old('email',$user['email']??'') }}" class="form-control email" placeholder="" />
                                    </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('business_phone') ? ' has-error' : '' }}">
                                <label for="business_phone" class="col-sm-2  control-label">Business Phone</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="business_phone" name="business_phone" value="{{ old('business_phone',$user['business_phone']??'') }}" class="form-control business_phone" placeholder="" />
                                    </div>
                                        @if ($errors->has('business_phone'))
                                            <span class="help-block">
                                                {{ $errors->first('business_phone') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                             <div class="form-group   {{ $errors->has('home_phone') ? ' has-error' : '' }}">
                                <label for="home_phone" class="col-sm-2  control-label">Messaging App</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="home_phone" name="home_phone" value="{{ old('home_phone',$user['home_phone']??'') }}" class="form-control home_phone" placeholder="" />
                                    </div>
                                        @if ($errors->has('home_phone'))
                                            <span class="help-block">
                                                {{ $errors->first('home_phone') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('cell_number') ? ' has-error' : '' }}">
                                <label for="home_phone" class="col-sm-2  control-label">Mobile Number</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="cell_number" name="cell_number" value="{{ old('cell_number',$user['cell_number']??'') }}" class="form-control cell_number" placeholder="" />
                                    </div>
                                        @if ($errors->has('cell_number'))
                                            <span class="help-block">
                                                {{ $errors->first('cell_number') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                             <div class="form-group   {{ $errors->has('skype_name') ? ' has-error' : '' }}">
                                <label for="skype_name" class="col-sm-2  control-label">Social Media Primary </label>

                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="skype_name" name="skype_name" value="{{ old('skype_name',$user['skype_name']??'') }}" class="form-control skype_name" placeholder="" />
                                    </div>
                                        @if ($errors->has('skype_name'))
                                            <span class="help-block">
                                                {{ $errors->first('skype_name') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                             <div class="form-group   {{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <label for="facebook" class="col-sm-2  control-label">Social Media Secondary</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="facebook" name="facebook" value="{{ old('facebook',$user['facebook']??'') }}" class="form-control facebook" placeholder="" />
                                    </div>
                                        @if ($errors->has('facebook'))
                                            <span class="help-block">
                                                {{ $errors->first('facebook') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                <label for="twitter" class="col-sm-2  control-label">Social media Optional 3</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="twitter" name="twitter" value="{{ old('twitter',$user['twitter']??'') }}" class="form-control twitter" placeholder="" />
                                    </div>
                                        @if ($errors->has('twitter'))
                                            <span class="help-block">
                                                {{ $errors->first('twitter') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('bbm') ? ' has-error' : '' }}">
                                <label for="bbm" class="col-sm-2  control-label">Social media Optional 4</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="bbm" name="bbm" value="{{ old('bbm',$user['bbm']??'') }}" class="form-control bbm" placeholder="" />
                                    </div>
                                        @if ($errors->has('bbm'))
                                            <span class="help-block">
                                                {{ $errors->first('bbm') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('branch') ? ' has-error' : '' }}">
                                <label for="branch" class="col-sm-2  control-label">Branch</label>
                                <div class="col-sm-8">
                                     <select class="form-control input-sm branch select2" style="width: 100%;"
                                    name="branch">
                                    <option value=""></option>
                                    <?php foreach($branch as $br) { ?>
                                    <option value="{{ $br->id }}" {{ (old('branch', $user['branch']??'') ==  $br->id)?'selected':'' }}  >
                                        
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

                            <div class="form-group   {{ $errors->has('brief') ? ' has-error' : '' }}">
                                <label for="brief" class="col-sm-2  control-label">Brief</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"   id="brief" name="brief" value="{{ old('brief',$user['brief']??'') }}" class="form-control brief" placeholder="" />
                                    </div>
                                        @if ($errors->has('brief'))
                                            <span class="help-block">
                                                {{ $errors->first('brief') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group   {{ $errors->has('background') ? ' has-error' : '' }}">
                                <label for="brief" class="col-sm-2  control-label">Background</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                       <textarea name="background" class="form-control background">{{ old('background',$user['background']??'') }}</textarea>
                                        
                                    </div>
                                        @if ($errors->has('background'))
                                            <span class="help-block">
                                                {{ $errors->first('background') }}
                                            </span>
                                        @endif
                                </div>
                            </div>


                           

                            

{{-- select roles --}}
                            <div class="form-group  {{ $errors->has('roles') ? ' has-error' : '' }}">
        @php
        $listRoles = [];
            $old_roles = old('roles',($user)?$user->roles->pluck('id')->toArray():'');
            if(is_array($old_roles)){
                foreach($old_roles as $value){
                    $listRoles[] = (int)$value;
                }
            }
        @endphp
                                <label for="roles" class="col-sm-2  control-label">{{ trans('user.admin.select_roles') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm roles select2"  data-placeholder="{{ trans('user.admin.select_roles') }}" style="width: 100%;" name="roles" >
                                        <option value=""></option>
                                        @foreach ($roles as $k => $v)
                                            <option value="{{ $k }}"  {{ (count($listRoles) && in_array($k, $listRoles))?'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('roles'))
                                            <span class="help-block">
                                                {{ $errors->first('roles') }}
                                            </span>
                                        @endif
                                </div>
                            </div>
{{-- //select roles --}}

{{-- select permission --}}
                            <div class="form-group  {{ $errors->has('permission') ? ' has-error' : '' }}">
        @php
        $listPermission = [];
        $old_permission = old('permission',($user?$user->permissions->pluck('id')->toArray():''));
            if(is_array($old_permission)){
                foreach($old_permission as $value){
                    $listPermission[] = (int)$value;
                }
            }
        @endphp
                                <label for="permission" class="col-sm-2  control-label">{{ trans('user.admin.select_permission') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm permission select2"  multiple="multiple" data-placeholder="{{ trans('user.admin.select_permission') }}" style="width: 100%;" name="permission[]" >
                                        <option value=""></option>
                                        @foreach ($permission as $k => $v)
                                            <option value="{{ $k }}"  {{ (count($listPermission) && in_array($k, $listPermission))?'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('permission'))
                                            <span class="help-block">
                                                {{ $errors->first('permission') }}
                                            </span>
                                        @endif
                                </div>
                            </div>
{{-- //select permission --}}
                         <div class="form-group  ">
                                    <label for="display"
                                        class="col-sm-2 control-label">Display</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="display"
                                            {{  old('display',(empty($user['display'])?0:1))?'checked':''}}>
                                            
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
    $("[name='top'],[name='status'],[name='display']").bootstrapSwitch();
</script>

<script type="text/javascript">

$(document).ready(function() {
    $('.select2').select2()
});



</script>

@endpush
