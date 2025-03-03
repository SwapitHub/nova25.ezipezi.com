@extends($templatePath.'.shop_layout')

@section('main')
<section class="account-detail">
<div class="container">
    <div class="row">
        <h2 class="title text-center">Welcome {{ $user->username }}</h2>
<ul>
    <li><span class="glyphicon glyphicon-forward"></span> <a href="{{ route('member.change_password') }}">{{ trans('account.change_password') }}</a></li>
    <li><span class="glyphicon glyphicon-forward"></span> <a href="{{ route('member.change_infomation') }}">Change Information</a></li>
    <li><span class="glyphicon glyphicon-forward"></span> <a href="{{ route('member.order_list') }}">{{ trans('account.order_list') }}</a></li>
     <li><span class="glyphicon glyphicon-forward"></span> <a href="{{ route('member.favourite_list') }}">Favourites List</a></li>
</ul>
    </div>
</div>
</section>
@endsection

@section('breadcrumb')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">{{ trans('front.home') }}</a></li>
          <li class="active">{{ $title }}</li>
        </ol>
      </div>
@endsection
