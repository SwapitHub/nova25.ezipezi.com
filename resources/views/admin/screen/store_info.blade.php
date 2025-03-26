@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-6">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('store_info.admin.config_mode') }}</h3>
                </div>

                <div class="box-body table-responsive no-padding box-primary">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('store_info.admin.field') }}</th>
                                <th>{{ trans('store_info.admin.value') }}</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td>{{ trans('store_info.logo') }}
                                    <span class="input-group-btn">
                                        <a data-input="image" data-preview="preview_image" data-type="logo"
                                            class="btn btn-sm btn-flat btn-primary lfm">
                                            <i class="fa fa-picture-o"></i> {{ trans('product.admin.choose_image') }}
                                        </a>
                                    </span>

                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" id="image" name="logo" value="{{ $infos->logo }}"
                                            class="form-control input-sm image" placeholder="" />
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            {{ $errors->first('image') }}
                                        </span>
                                    @endif
                                    <div id="preview_image" class="img_holder">{!! sc_image_render($infos->logo, '100px') !!}</div>

                                </td>
                            </tr>
                            <tr>
                                <td>{{ trans('store_info.favicon_icon') }}
                                    <span class="input-group-btn">
                                        <a data-input="favicon_icon" data-preview="preview1_image" data-type="favicon_icon"
                                            class="btn btn-sm btn-flat btn-primary lfm">
                                            <i class="fa fa-picture-o"></i> {{ trans('product.admin.choose_image') }}
                                        </a>
                                    </span>

                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="hidden" id="favicon_icon" name="favicon_icon"
                                            value="{{ $infos->favicon_icon }}" class="form-control input-sm favicon_icon"
                                            placeholder="" />
                                    </div>
                                    @if ($errors->has('favicon_icon'))
                                        <span class="help-block">
                                            {{ $errors->first('favicon_icon') }}
                                        </span>
                                    @endif
                                    <div id="preview1_image" class="img_holder">{!! sc_image_render($infos->favicon_icon, '100px') !!}</div>

                                </td>
                            </tr>

                            <tr>
                                <td>{{ trans('store_info.phone') }}</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="phone"
                                        data-type="number" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="{{ trans('store_info.phone') }}" data-value="{{ $infos->phone }}"
                                        data-original-title="" title="">{{ $infos->phone }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('store_info.long_phone') }}</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="long_phone"
                                        data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="{{ trans('store_info.long_phone') }}"
                                        data-value="{{ $infos->long_phone }}" data-original-title=""
                                        title="">{{ $infos->long_phone }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('store_info.time_active') }}</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="time_active"
                                        data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="{{ trans('store_info.time_active') }}"
                                        data-value="{{ $infos->time_active }}" data-original-title=""
                                        title="">{{ $infos->time_active }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('store_info.address') }}</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="address"
                                        data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="{{ trans('store_info.address') }}" data-value="{{ $infos->address }}"
                                        data-original-title="" title="">{{ $infos->address }}</a></td>
                            </tr>
                            <tr>
                                <td>{{ trans('store_info.office') }}</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="office"
                                        data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="{{ trans('store_info.office') }}" data-value="{{ $infos->office }}"
                                        data-original-title="" title="">{{ $infos->office }}</a></td>
                            </tr>
                            <tr>
                                <td>{{ trans('store_info.warehouse') }}</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="warehouse"
                                        data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="{{ trans('store_info.warehouse') }}"
                                        data-value="{{ $infos->warehouse }}" data-original-title=""
                                        title="">{{ $infos->warehouse }}</a></td>
                            </tr>

                            <tr>
                                <td>Server email</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="email"
                                        data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="{{ trans('store_info.email') }}" data-value="{{ $infos->email }}"
                                        data-original-title="" title="">{{ $infos->email }}</a></td>
                            </tr>


                            <tr>
                                <td>Admin email</td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="admin_email" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="admin_email"
                                        data-value="{{ $infos->admin_email }}" data-original-title=""
                                        title="">{{ $infos->admin_email }}</a></td>
                            </tr>

                            </td>
                            </tr>

                            @foreach ($infosDescription as $obj => $infoDescription)
                                @if ($obj != 'maintain_content')
                                    <tr>
                                        <td>{{ trans('store_info.' . $obj) }}</td>
                                        <td>
                                            @foreach ($infoDescription as $codeLanguage => $des)
                                                {{ $languages[$codeLanguage] }}:<br>
                                                <i><a href="#" class="fied-required editable editable-click"
                                                        data-name="{{ $obj . '__' . $codeLanguage }}" data-type="text"
                                                        data-pk="" data-source=""
                                                        data-url="{{ route('admin_store_info.update') }}"
                                                        data-title="{{ trans('store_info.' . $obj) }}"
                                                        data-value="{{ $des }}" data-original-title=""
                                                        title="">{{ $des }}</a></i><br>
                                                <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                            @endforeach



                            <tr>
                                <td>Statcounter Project</td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="sc_project" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="sc_project"
                                        data-value="{{ $infos->sc_project }}" data-original-title=""
                                        title="">{{ $infos->sc_project }}</a></td>
                            </tr>

                            <tr>
                                <td>Statcounter Invis</td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="sc_invisible" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="sc_invisible"
                                        data-value="{{ $infos->sc_invisible }}" data-original-title=""
                                        title="">{{ $infos->sc_invisible }}</a></td>
                            </tr>

                            <tr>
                                <td>Statcounter Security</td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="sc_security" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="sc_security"
                                        data-value="{{ $infos->sc_security }}" data-original-title=""
                                        title="">{{ $infos->sc_security }}</a></td>
                            </tr>

                            <tr>
                                <td>Start date</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="startdate"
                                        data-type="date" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="startdate"
                                        data-value="{{ $infos->startdate }}" data-original-title=""
                                        title="">{{ $infos->startdate }}</a></td>
                            </tr>


                            <tr>
                                <td>Expiry date</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="enddate"
                                        data-type="date" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="enddate"
                                        data-value="{{ $infos->enddate }}" data-original-title=""
                                        title="">{{ $infos->enddate }}</a></td>
                            </tr>

                            <!--  <tr>
             <td>Google Analytics Key </td>
             <td><a href="#" class="fied-required editable editable-click" data-name="googlekey" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="googlekey" data-value="{{ $infos->googlekey }}" data-original-title="" title="">{{ $infos->googlekey }}</a></td>
            </tr> -->

                            <tr>
                                <td>Payfast (0 sandbox, 1 live)</td>
                                <td><a href="#" class="fied-required editable editable-click" data-name="payfast"
                                        data-type="number" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="payfast"
                                        data-value="{{ $infos->payfast }}" data-original-title=""
                                        title="">{{ $infos->payfast }}</a></td>
                            </tr>

                            <tr>
                                <td>Payfast Merchant Id</td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="merchant_id" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="merchant_id"
                                        data-value="{{ $infos->merchant_id }}" data-original-title=""
                                        title="">{{ $infos->merchant_id }}</a></td>
                            </tr>

                            <tr>
                                <td>Payfast Merchant Key </td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="merchant_key" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="merchant_key"
                                        data-value="{{ $infos->merchant_key }}" data-original-title=""
                                        title="">{{ $infos->merchant_key }}</a></td>
                            </tr>

                            <tr>
                                <td>reCaptcha Site Key </td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="reCaptcha_site_key" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}" data-title="reCaptcha_site_key"
                                        data-value="{{ $infos->reCaptcha_site_key }}" data-original-title=""
                                        title="">{{ $infos->reCaptcha_site_key }}</a></td>
                            </tr>

                            <tr>
                                <td>reCaptcha Secret Key </td>
                                <td><a href="#" class="fied-required editable editable-click"
                                        data-name="reCaptcha_secret_key" data-type="text" data-pk="" data-source=""
                                        data-url="{{ route('admin_store_info.update') }}"
                                        data-title="reCaptcha_secret_key" data-value="{{ $infos->reCaptcha_secret_key }}"
                                        data-original-title="" title="">{{ $infos->reCaptcha_secret_key }}</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="box box-primary">
                @foreach ($infosDescription as $obj => $infoDescription)
                    @if ($obj == 'maintain_content')
                        @foreach ($infoDescription as $codeLanguage => $des)
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('store_info.maintain_content') }}
                                    {{ $languages[$codeLanguage] }}</h3>
                            </div>
                            <div class="box-body table-responsive no-padding box-primary">
                                <a href="#" class="fied-required editable editable-click"
                                    data-name="{{ $obj . '__' . $codeLanguage }}" data-type="textarea" data-pk=""
                                    data-source="" data-url="{{ route('admin_store_info.update') }}"
                                    data-title="{{ trans('store_info.' . $obj) }}" data-value="{{ $des }}"
                                    data-original-title="" title="">{!! $des !!}</a>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
            <div class="box box-primary">

                <div class="form-group">
                    @csrf
                    <input type="text" name="logo_alt" id="logo_alt" class="form-control"
                        value="{{ $infos->logo_alt }}" placeholder="logo alt">
                </div>
                <div class="form-group">
                    <div class="btn-group pull-left">
                        <button type="submit" class="btn btn-primary" id="logoalt">Update logo alt</button>
                    </div>
                </div>

            </div>
        </div>






    </div>
@endsection


@push('styles')
    <!-- Ediable -->
    <link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-editable.css') }}">
    <style type="text/css">
        #maintain_content img {
            max-width: 100%;
        }
    </style>
@endpush

@push('scripts')
    <!-- Ediable -->
    <script src="{{ asset('admin/plugin/bootstrap-editable.min.js') }}"></script>

    <script type="text/javascript">
        // Editable
        $(document).ready(function() {

            $.fn.editable.defaults.mode = 'inline';
            $.fn.editable.defaults.params = function(params) {
                params._token = "{{ csrf_token() }}";
                return params;
            };
            $('.fied-required').editable({
                validate: function(value) {
                    if (value == '') {
                        return '{{ trans('admin.not_empty') }}';
                    }
                },
                success: function(data) {
                    if (data.stt == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        Toast.fire({
                            type: 'success',
                            title: '{{ trans('admin.msg_change_success') }}'
                        })
                    }
                }
            });
        });
    </script>


    <script type="text/javascript">
        {!! $script_sort ?? '' !!}
    </script>

    <script type="text/javascript">
        {{-- sweetalert2 --}}
        var selectedRows = function() {
            var selected = [];
            $('.grid-row-checkbox:checked').each(function() {
                selected.push($(this).data('id'));
            });

            return selected;
        }
    </script>
    <script>
        // Update store_info
        $("#logoalt").click(function() {
            if ($("#logo_alt").val() != '') {
                var APP_URL = {!! json_encode(url('/')) !!}
                APP_URL = APP_URL;
                var replit = $('#image').val().replace(APP_URL, "");
                $('#image').val(replit);
                $.ajax({
                        url: '{{ route('admin_store_info.update') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            "name": 'logo_alt',
                            "value": $("#logo_alt").val(),
                            "_token": "{{ csrf_token() }}",
                        },
                    })
                    .done(function(data) {
                        if (data.stt == 1) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                type: 'success',
                                title: '{{ trans('admin.msg_change_success') }}'
                            })
                        }
                    });
            }
        })

        //Logo
        $('[name="logo"]').change(function(event) {
            var APP_URL = {!! json_encode(url('/')) !!};
            APP_URL = APP_URL.replace(/\/$/, ''); // Ensure no trailing slash in APP_URL

            var imageInput = $('#image');
            console.log("Before replace:", imageInput.val());

            var replit = imageInput.val().replace(APP_URL, '').replace(/^\/\//, '/'); // Ensure single leading /
            console.log("After replace:", replit);

            imageInput.val(replit);
            // var APP_URL = {!! json_encode(url('/')) !!}
            // APP_URL = APP_URL;
            // var replit = $('#image').val().replace(APP_URL,"");
            // $('#image').val(replit);
            $.ajax({
                    url: '{{ route('admin_store_info.update') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        "name": 'logo',
                        "value": $(this).val(),
                        "_token": "{{ csrf_token() }}",
                    },
                })
                .done(function(data) {
                    if (data.stt == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        Toast.fire({
                            type: 'success',
                            title: '{{ trans('admin.msg_change_success') }}'
                        })
                    }
                });
        });
        $('[name="favicon_icon"]').change(function(event) {
            var APP_URL = {!! json_encode(url('/')) !!}
            APP_URL = APP_URL;
            var replit = $('#favicon_icon').val().replace(APP_URL, "");
            $('#favicon_icon').val(replit);
            $.ajax({
                    url: '{{ route('admin_store_info.update') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        "name": 'favicon_icon',
                        "value": $(this).val(),
                        "_token": "{{ csrf_token() }}",
                    },
                })
                .done(function(data) {
                    if (data.stt == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        Toast.fire({
                            type: 'success',
                            title: '{{ trans('admin.msg_change_success') }}'
                        })
                    }
                });
        });
        //End logo


        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            }).on('ifChanged', function(e) {
                var isChecked = e.currentTarget.checked;
                isChecked = (isChecked == false) ? 0 : 1;
                var name = $(this).attr('name');
                $.ajax({
                        url: '{{ route('admin_store_info.update') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            "name": name,
                            "value": isChecked,
                            "_token": "{{ csrf_token() }}",
                        },
                    })
                    .done(function(data) {
                        if (data.stt == 1) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                type: 'success',
                                title: '{{ trans('admin.msg_change_success') }}'
                            })
                        }
                    });

            });

        });
        //End update store_info
    </script>
@endpush
