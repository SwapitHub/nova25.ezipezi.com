<h2>{{ trans('account.title_register') }}</h2>
<form action="{{route('postRegister')}}" method="post" class="box">
    {!! csrf_field() !!}
    <div class="form_content {{ (old('check_red'))?'in':'' }}" id="collapseExample">
    
    <div class="w-full">
	<div class="user-details w-half">	
		<h2>User Details</h2>  

    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('username'))?"input-error":"" }}"
                name="username" placeholder="Username"
                value="{{ old('username') }}">
            @if ($errors->has('username'))
            <span class="help-block">
                {{ $errors->first('username') }}
            </span>
            @endif
        </div>
         <div class="form-group{{ $errors->has('reg_password') ? ' has-error' : '' }}">
            <input type="password"
                class="is_required validate account_input form-control {{ ($errors->has('reg_password'))?"input-error":"" }}"
                name="reg_password" placeholder="{{ trans('account.password') }}" value="">
            @if ($errors->has('reg_password'))
            <span class="help-block">
                {{ $errors->first('reg_password') }}
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('reg_password_confirmation') ? ' has-error' : '' }}">
            <input type="password"
                class="is_required validate account_input form-control {{ ($errors->has('reg_password_confirmation'))?"input-error":"" }}"
                placeholder="{{ trans('account.password_confirm') }}" name="reg_password_confirmation" value="">
            @if ($errors->has('reg_password_confirmation'))
            <span class="help-block">
                {{ $errors->first('reg_password_confirmation') }}
            </span>
            @endif
        </div>
        @if (sc_config('customer_lastname'))
        <div class="form-group{{ $errors->has('reg_first_name') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_first_name'))?"input-error":"" }}"
                name="reg_first_name" placeholder="{{ trans('account.first_name') }}"
                value="{{ old('reg_first_name') }}">
            @if ($errors->has('reg_first_name'))
            <span class="help-block">
                {{ $errors->first('reg_first_name') }}
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('reg_last_name') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_last_name'))?"input-error":"" }}"
                name="reg_last_name" placeholder="{{ trans('account.last_name') }}" value="{{ old('reg_last_name') }}">
            @if ($errors->has('reg_last_name'))
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
                value="{{ old('reg_first_name') }}">
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
                value="{{ old('initials') }}">
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
                                    <option value="Dr."  >Dr.</option>
                                    <option value="Miss" >Miss</option>
                                    <option value="Mr." >Mr.</option>
                                    <option value="Mrs."  >Mrs.</option>
                                    <option value="Ms."  >Ms.</option>
                                    <option value="Prof."  >Prof.</option>
                                    
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
                                    <option value="South African ID"  >South African ID</option>
                                    <option value="Passport" >Passport</option>
                                    
                                    
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
                value="{{ old('idnumber') }}">
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
                name="reg_email" placeholder="{{ trans('account.email') }}" value="{{ old('reg_email') }}">
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
                name="reg_phone" placeholder="Home Phone #" value="{{ old('reg_phone') }}">
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
                name="business_phone" placeholder="Business Phone #" value="{{ old('business_phone') }}">
            @if ($errors->has('business_phone'))
            <span class="help-block">
                {{ $errors->first('business_phone') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('cell_phone') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('cell_phone'))?"input-error":"" }}"
                name="cell_phone" placeholder="Cell #" value="{{ old('cell_phone') }}">
            @if ($errors->has('cell_phone'))
            <span class="help-block">
                {{ $errors->first('cell_phone') }}
            </span>
            @endif
        </div>

         <div class="form-group{{ $errors->has('skype') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('skype'))?"input-error":"" }}"
                name="skype" placeholder="Password Hint" value="{{ old('skype') }}">
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
                name="reg_company" placeholder="{{ trans('account.company') }}" value="{{ old('reg_company') }}">
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
                value="{{ old('companyreg') }}">
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
                value="{{ old('companyvat') }}">
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
                name="reg_address1" placeholder="{{ trans('account.address1') }}" value="{{ old('reg_address1') }}">
            @if ($errors->has('reg_address1'))
            <span class="help-block">
                {{ $errors->first('reg_address1') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('reg_address2') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_address2'))?"input-error":"" }}"
                name="reg_address2" placeholder="{{ trans('account.address2') }}" value="{{ old('reg_address2') }}">
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
                name="reg_address1" placeholder="{{ trans('account.address') }}" value="{{ old('reg_address1') }}">
            @if ($errors->has('reg_address1'))
            <span class="help-block">
                {{ $errors->first('reg_address1') }}
            </span>
            @endif
        </div>
        @endif


       

        @if (sc_config('customer_country'))
        <div class="form-group  {{ $errors->has('reg_country') ? ' has-error' : '' }}">
            <select class="form-control reg_country" style="width: 100%;" name="reg_country">
                <option>__{{ trans('account.country') }}__</option>
                @foreach ($countries as $k => $v)
                <option value="{{ $k }}" {{ (old('reg_country') ==$k) ? 'selected':'' }}>{{ $v }}</option>
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
                name="suburb" placeholder="Suburb" value="{{ old('suburb') }}">
            @if ($errors->has('suburb'))
            <span class="help-block">
                {{ $errors->first('suburb') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('city'))?"input-error":"" }}"
                name="city" placeholder="City" value="{{ old('city') }}">
            @if ($errors->has('city'))
            <span class="help-block">
                {{ $errors->first('city') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('reg_postcode') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_postcode'))?"input-error":"" }}"
                name="reg_postcode" placeholder="{{ trans('account.postcode') }}" value="{{ old('reg_postcode') }}">
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
                name="breg_address1" placeholder="{{ trans('account.address1') }}" value="{{ old('breg_address1') }}">
            @if ($errors->has('breg_address1'))
            <span class="help-block">
                {{ $errors->first('breg_address1') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('breg_address2') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('breg_address2'))?"input-error":"" }}"
                name="breg_address2" placeholder="{{ trans('account.address2') }}" value="{{ old('breg_address2') }}">
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
                name="breg_address1" placeholder="{{ trans('account.address') }}" value="{{ old('breg_address1') }}">
            @if ($errors->has('breg_address1'))
            <span class="help-block">
                {{ $errors->first('breg_address1') }}
            </span>
            @endif
        </div>
        @endif


       

        @if (sc_config('customer_country'))
        <div class="form-group  {{ $errors->has('bcountry') ? ' has-error' : '' }}">
            <select class="form-control bcountry" style="width: 100%;" name="bcountry">
                <option>__{{ trans('account.country') }}__</option>
                @foreach ($countries as $k => $v)
                <option value="{{ $k }}" {{ (old('bcountry') ==$k) ? 'selected':'' }}>{{ $v }}</option>
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
                name="bsuburb" placeholder="Suburb" value="{{ old('bsuburb') }}">
            @if ($errors->has('bsuburb'))
            <span class="help-block">
                {{ $errors->first('bsuburb') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('bcity') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('bcity'))?"input-error":"" }}"
                name="bcity" placeholder="City" value="{{ old('bcity') }}">
            @if ($errors->has('bcity'))
            <span class="help-block">
                {{ $errors->first('bcity') }}
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('breg_postcode') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('breg_postcode'))?"input-error":"" }}"
                name="breg_postcode" placeholder="{{ trans('account.postcode') }}" value="{{ old('breg_postcode') }}">
            @if ($errors->has('breg_postcode'))
            <span class="help-block">
                {{ $errors->first('breg_postcode') }}
            </span>
            @endif
        </div>

        @if (sc_config('customer_sex'))
        <div class="form-group{{ $errors->has('reg_sex') ? ' has-error' : '' }}">
            <label class="validate account_input {{ ($errors->has('reg_sex'))?"input-error":"" }}">{{ trans('account.sex') }}: </label>
            <label class="radio-inline"><input value="0" type="radio" name="reg_sex" {{ (old('reg_sex') == 0)?'checked':'' }}> {{ trans('account.sex_women') }}</label>
            <label class="radio-inline"><input value="1" type="radio" name="reg_sex" {{ (old('reg_sex') == 1)?'checked':'' }}> {{ trans('account.sex_men') }}</label>
            @if ($errors->has('reg_sex'))
            <span class="help-block">
                {{ $errors->first('reg_sex') }}
            </span>
            @endif
        </div>
        @endif

        @if (sc_config('customer_birthday'))
        <div class="form-group{{ $errors->has('reg_birthday') ? ' has-error' : '' }}">
            <input type="date"
                class="is_required validate account_input form-control {{ ($errors->has('reg_birthday'))?"input-error":"" }}"
                name="reg_birthday" data-date-format="YYYY-MM-DD"  placeholder="{{ trans('account.birthday') }}" value="{{ old('reg_birthday','2015-08-09') }}">
            @if ($errors->has('reg_birthday'))
            <span class="help-block">
                {{ $errors->first('reg_birthday') }}
            </span>
            @endif
        </div>
        @endif

        @if (sc_config('customer_group'))
        <div class="form-group{{ $errors->has('reg_group') ? ' has-error' : '' }}">
            <input type="text"
                class="is_required validate account_input form-control {{ ($errors->has('reg_group'))?"input-error":"" }}"
                name="reg_group" placeholder="{{ trans('account.group') }}" value="{{ old('reg_group') }}">
            @if ($errors->has('reg_group'))
            <span class="help-block">
                {{ $errors->first('reg_group') }}
            </span>
            @endif
        </div>
        @endif
</div>
</div>       
        <input type="hidden" name="check_red" value="1">
        <div class="submit">
            <button type="submit" name="SubmitCreate" class="btn btn-default">{{ trans('account.signup') }}</button>
        </div>
    </div>

</form>