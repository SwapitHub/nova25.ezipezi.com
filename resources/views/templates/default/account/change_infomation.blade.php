@extends($templatePath.'.shop_layout')

@section('main')
<div class="container">
    <div class="row justify-content-center change-info">
        <form method="POST" action="{{ route('member.post_change_infomation') }}">
                        @csrf
         <div class="form_content" id="collapseExample">
    
    <div class="w-full">
    <div class="user-details w-half">   
        <h2>User Details</h2>  

   
        
        @if (sc_config('customer_lastname'))
        <div class="form-group{{ $errors->has('reg_first_name') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_first_name'))?"input-error":"" }}"
                name="reg_first_name" placeholder="{{ trans('account.first_name') }}"
               value="{{ (old('reg_first_name'))?old('reg_first_name'):$dataUser['first_name']}}">
            @if ($errors->has('reg_first_name'))
            <span class="help-block">
                {{ $errors->first('reg_first_name') }}
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('reg_last_name') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_last_name'))?"input-error":"" }}"
                name="reg_last_name" placeholder="{{ trans('account.last_name') }}"required value="{{ (old('reg_last_name'))?old('reg_last_name'):$dataUser['last_name']}}">
            @if ($errors->has('last_name'))
            <span class="help-block">
                {{ $errors->first('reg_last_name') }}
            </span>
            @endif
        </div>
        @else
        <div class="form-group{{ $errors->has('reg_first_name') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_first_name'))?"input-error":"" }}"
                name="reg_first_name" placeholder="{{ trans('account.name') }}"
               value="{{ (old('reg_first_name'))?old('reg_first_name'):$dataUser['first_name']}}">
            @if ($errors->has('reg_first_name'))
            <span class="help-block">
                {{ $errors->first('reg_first_name') }}
            </span>
            @endif
        </div>
        @endif


       

        <div class="form-group{{ $errors->has('initials') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('initials'))?"input-error":"" }}"
                name="initials" placeholder="Initials"
               value="{{ (old('initials'))?old('initials'):$dataUser['initials']}}">
            @if ($errors->has('initials'))
            <span class="help-block">
                {{ $errors->first('initials') }}
            </span>
            @endif
        </div>
         <div class="form-group{{ $errors->has('salutation') ? ' has-error' : '' }}">
            <select class="form-control input-sm salutation select2" style="width: 100%;"
                                    name="salutation">
                                    <option value="">Salutation</option>
                                    <option value="Dr." <?php if(isset($dataUser['salutation'])) { 
                                        if($dataUser['salutation']=='Dr.') echo "selected"; }  ?> >Dr.</option>
                                    <option value="Miss" <?php if(isset($dataUser['salutation'])) { 
                                        if($dataUser['salutation']=='Miss') echo "selected"; }  ?> >Miss</option>
                                    <option value="Mr." <?php if(isset($dataUser['salutation'])) { 
                                        if($dataUser['salutation']=='Mr.') echo "selected"; }  ?> >Mr.</option>
                                    <option value="Mrs." <?php if(isset($dataUser['salutation'])) { 
                                        if($dataUser['salutation']=='Mrs.') echo "selected"; }  ?> >Mrs.</option>
                                    <option value="Ms." <?php if(isset($dataUser['salutation'])) { 
                                        if($dataUser['salutation']=='Ms.') echo "selected"; }  ?> >Ms.</option>
                                    <option value="Prof." <?php if(isset($dataUser['salutation'])) { 
                                        if($dataUser['salutation']=='Prof.') echo "selected"; }  ?> >Prof.</option>
                                    
                                    </select>
            @if ($errors->has('salutation'))
            <span class="help-block">
                {{ $errors->first('salutation') }}
            </span>
            @endif
        </div>

         <div class="form-group{{ $errors->has('idtype') ? ' has-error' : '' }}">
            <select class="form-control input-sm idtype select2" style="width: 100%;"
                                    name="idtype">
                                    <option value="">Id Type</option>
                                    <option <?php if(isset($dataUser['idtype'])) { 
                                        if($dataUser['idtype']=='South African ID') echo "selected"; }  ?>  value="South African ID"  >South African ID</option>
                                    <option <?php if(isset($dataUser['idtype'])) { 
                                        if($dataUser['idtype']=='Passport') echo "selected"; }  ?>  value="Passport" >Passport</option>
                                    
                                    
                                    </select>
            @if ($errors->has('idtype'))
            <span class="help-block">
                {{ $errors->first('idtype') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('idnumber') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('idnumber'))?"input-error":"" }}"
                name="idnumber" placeholder="ID number"
               value="{{ (old('idnumber'))?old('idnumber'):$dataUser['idnumber']}}">
            @if ($errors->has('idnumber'))
            <span class="help-block">
                {{ $errors->first('idnumber') }}
            </span>
            @endif
        </div>

</div>      
<div class="contact-details w-half">
        <h2>Contact Details</h2>        

        <div class="form-group{{ $errors->has('reg_email') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_email'))?"input-error":"" }}"
                name="reg_email" placeholder="{{ trans('account.email') }}" value="{{ (old('reg_email'))?old('reg_email'):$dataUser['email']}}">
            @if ($errors->has('reg_email'))
            <span class="help-block">
                {{ $errors->first('reg_email') }}
            </span>
            @endif
        </div>
        

         @if (sc_config('customer_phone'))
        <div class="form-group{{ $errors->has('reg_phone') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_phone'))?"input-error":"" }}"
                name="reg_phone" placeholder="Home Phone #"value="{{ (old('reg_phone'))?old('reg_phone'):$dataUser['phone']}}">
            @if ($errors->has('reg_phone'))
            <span class="help-block">
                {{ $errors->first('reg_phone') }}
            </span>
            @endif
        </div>
        @endif

        <div class="form-group{{ $errors->has('business_phone') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('business_phone'))?"input-error":"" }}"
                name="business_phone" placeholder="Business Phone #"value="{{ (old('business_phone'))?old('business_phone'):$dataUser['business_phone']}}">
            @if ($errors->has('business_phone'))
            <span class="help-block">
                {{ $errors->first('business_phone') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('cell_phone') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('cell_phone'))?"input-error":"" }}"
                name="cell_phone" placeholder="Cell #"value="{{ (old('cell_phone'))?old('cell_phone'):$dataUser['cell_phone']}}">
            @if ($errors->has('cell_phone'))
            <span class="help-block">
                {{ $errors->first('cell_phone') }}
            </span>
            @endif
        </div>

         <div class="form-group{{ $errors->has('skype') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('skype'))?"input-error":"" }}"
                name="skype" placeholder="Password Hint" value="{{ (old('skype'))?old('skype'):$dataUser['skype']}}">
            @if ($errors->has('skype'))
            <span class="help-block">
                {{ $errors->first('skype') }}
            </span>
            @endif
        </div>
        </div>

<div class="compeny-details w-half">
        <h2>Company Details</h2>

        <div class="form-group{{ $errors->has('reg_company') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_company'))?"input-error":"" }}"
                name="reg_company" placeholder="{{ trans('account.company') }}" value="{{ (old('reg_company'))?old('reg_company'):$dataUser['company']}}">
            @if ($errors->has('reg_company'))
            <span class="help-block">
                {{ $errors->first('reg_company') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('companyreg') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('companyreg'))?"input-error":"" }}"
                name="companyreg" placeholder="Company Reg #"
                 value="{{ (old('companyreg'))?old('companyreg'):$dataUser['companyreg']}}">
            @if ($errors->has('companyreg'))
            <span class="help-block">
                {{ $errors->first('companyreg') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('companyvat') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('companyvat'))?"input-error":"" }}"
                name="companyvat" placeholder="Company Vat #"
                value="{{ (old('companyvat'))?old('companyvat'):$dataUser['companyvat']}}">
            @if ($errors->has('companyvat'))
            <span class="help-block">
                {{ $errors->first('companyvat') }}
            </span>
            @endif
        </div>
    </div>  
    
    
        
<div class="shiping-details w-half">        
<h2>Shipping Address Details</h2>
       

        @if (sc_config('customer_address2'))
        <div class="form-group{{ $errors->has('reg_address1') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_address1'))?"input-error":"" }}"
                name="reg_address1" placeholder="{{ trans('account.address1') }}" value="{{ (old('reg_address1'))?old('reg_address1'):$dataUser['address1']}}">
            @if ($errors->has('reg_address1'))
            <span class="help-block">
                {{ $errors->first('reg_address1') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('reg_address2') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_address2'))?"input-error":"" }}"
                name="reg_address2" placeholder="{{ trans('account.address2') }}" value="{{ (old('reg_address2'))?old('reg_address2'):$dataUser['address2']}}">
            @if ($errors->has('reg_address2'))
            <span class="help-block">
                {{ $errors->first('reg_address2') }}
            </span>
            @endif
        </div>
        @else
        <div class="form-group{{ $errors->has('reg_address1') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_address1'))?"input-error":"" }}"
                name="reg_address1" placeholder="{{ trans('account.address') }}" value="{{ (old('reg_address1'))?old('reg_address1'):$dataUser['address1']}}">
            @if ($errors->has('reg_address1'))
            <span class="help-block">
                {{ $errors->first('reg_address1') }}
            </span>
            @endif
        </div>
        @endif


       
@php
    $country = (old('country'))?old('country'):$dataUser['country'];
@endphp
        @if (sc_config('customer_country'))
        <div class="form-group  {{ $errors->has('reg_country') ? ' has-error' : '' }}">
            <select class="form-control reg_country" style="width: 100%;" name="reg_country">
                <option>__{{ trans('account.country') }}__</option>
                @foreach ($countries as $k => $v)
                    <option value="{{ $k }}" {{ ($country ==$k) ? 'selected':'' }}>{{ $v }}</option>
                @endforeach
            </select>
            @if ($errors->has('reg_country'))
            <span class="help-block">
                {{ $errors->first('reg_country') }}
            </span>
            @endif
        </div>
        @endif

         <div class="form-group  {{ $errors->has('province') ? ' has-error' : '' }}">
            <select class="form-control province" style="width: 100%;" name="province">
                <option value="">Province</option>
                <?php foreach($states as $state)
                { ?>
                    <option value="{{ $state->id }}" <?php if(isset($dataUser['province'])) { 
                                        if($dataUser['province']==$state->id) echo "selected"; }  ?> >{{ $state->name }}</option>
                <?php } ?>
               
            </select>
            @if ($errors->has('province'))
            <span class="help-block">
                {{ $errors->first('province') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('suburb') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('suburb'))?"input-error":"" }}"
                name="suburb" placeholder="Suburb" value="{{ (old('suburb'))?old('suburb'):$dataUser['suburb']}}">
            @if ($errors->has('suburb'))
            <span class="help-block">
                {{ $errors->first('suburb') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('city'))?"input-error":"" }}"
                name="city" placeholder="City" value="{{ (old('city'))?old('city'):$dataUser['city']}}">
            @if ($errors->has('city'))
            <span class="help-block">
                {{ $errors->first('city') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('reg_postcode') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_postcode'))?"input-error":"" }}"
                name="reg_postcode" placeholder="{{ trans('account.postcode') }}" value="{{ (old('reg_postcode'))?old('reg_postcode'):$dataUser['postcode']}}">
            @if ($errors->has('reg_postcode'))
            <span class="help-block">
                {{ $errors->first('reg_postcode') }}
            </span>
            @endif
        </div>

</div>

  <div class="billing-details w-half">
        <h2>Billing Address Details</h2>
       

        @if (sc_config('customer_address2'))
        <div class="form-group{{ $errors->has('breg_address1') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('breg_address1'))?"input-error":"" }}"
                name="breg_address1" placeholder="{{ trans('account.address1') }}" value="{{ (old('breg_address1'))?old('breg_address1'):$dataUser['breg_address1']}}">
            @if ($errors->has('breg_address1'))
            <span class="help-block">
                {{ $errors->first('breg_address1') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('breg_address2') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('breg_address2'))?"input-error":"" }}"
                name="breg_address2" placeholder="{{ trans('account.address2') }}" value="{{ (old('breg_address2'))?old('breg_address2'):$dataUser['breg_address2']}}">
            @if ($errors->has('breg_address2'))
            <span class="help-block">
                {{ $errors->first('breg_address2') }}
            </span>
            @endif
        </div>
        @else
        <div class="form-group{{ $errors->has('breg_address1') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('breg_address1'))?"input-error":"" }}"
                name="breg_address1" placeholder="{{ trans('account.address') }}" value="{{ (old('breg_address1'))?old('breg_address1'):$dataUser['breg_address1']}}">
            @if ($errors->has('breg_address1'))
            <span class="help-block">
                {{ $errors->first('breg_address1') }}
            </span>
            @endif
        </div>
        @endif


       
@php
    $country = (old('country'))?old('country'):$dataUser['bcountry'];
@endphp
        @if (sc_config('customer_country'))
        <div class="form-group  {{ $errors->has('bcountry') ? ' has-error' : '' }}">
            <select class="form-control bcountry" style="width: 100%;" name="bcountry">
                <option>__{{ trans('account.country') }}__</option>
                @foreach ($countries as $k => $v)
                    <option value="{{ $k }}" {{ ($country ==$k) ? 'selected':'' }}>{{ $v }}</option>
                @endforeach
            </select>
            @if ($errors->has('bcountry'))
            <span class="help-block">
                {{ $errors->first('bcountry') }}
            </span>
            @endif
        </div>
        @endif

         <div class="form-group  {{ $errors->has('bprovince') ? ' has-error' : '' }}">
            <select class="form-control bprovince" style="width: 100%;" name="bprovince">
                <option value="">Province</option>
                <?php foreach($bstates as $state)
                { ?>
                    <option value="{{ $state->id }}" <?php if(isset($dataUser['bprovince'])) { 
                                        if($dataUser['bprovince']==$state->id) echo "selected"; }  ?> >{{ $state->name }}</option>
                <?php } ?>
               
            </select>
            @if ($errors->has('bprovince'))
            <span class="help-block">
                {{ $errors->first('bprovince') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('bsuburb') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('bsuburb'))?"input-error":"" }}"
                name="bsuburb" placeholder="Suburb" value="{{ (old('bsuburb'))?old('bsuburb'):$dataUser['bsuburb']}}">
            @if ($errors->has('bsuburb'))
            <span class="help-block">
                {{ $errors->first('bsuburb') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('bcity') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('bcity'))?"input-error":"" }}"
                name="bcity" placeholder="City" value="{{ (old('bcity'))?old('bcity'):$dataUser['bcity']}}">
            @if ($errors->has('bcity'))
            <span class="help-block">
                {{ $errors->first('bcity') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('breg_postcode') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('breg_postcode'))?"input-error":"" }}"
                name="breg_postcode" placeholder="{{ trans('account.postcode') }}" value="{{ (old('breg_postcode'))?old('breg_postcode'):$dataUser['breg_postcode']}}">
            @if ($errors->has('breg_postcode'))
            <span class="help-block">
                {{ $errors->first('breg_postcode') }}
            </span>
            @endif
        </div>

        
</div>
</div>       
        
        <div class="submit">
              
        <button type="submit" class="btn btn-primary">
         Update Information
         </button>
                         
        </div>
    </div>
</form>
       
                    
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
