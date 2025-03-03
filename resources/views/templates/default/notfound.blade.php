@extends($templatePath.'.shop_layout')


@section('main')

    <section >
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-danger text-center" style="padding:100px;">
                   <h1 style="color: red">{{ $msg??'' }}</h1>
                </div>
                </div>
            </div>
        </section>
<!-- /.col -->
@endsection
