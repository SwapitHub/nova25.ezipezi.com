@extends($templatePath.'.shop_layout')

@section('main')
<section >
<div class="container">
    <div class="row orders-page">
        <h2 class="title text-center">{{ $title }}</h2>
@if (count($favlist) ==0)
    <div class="col-md-12 text-danger">
        There is no favourite item 
    </div>
@else
<table class="table box  table-bordered table-responsive">
    <thead>
      <tr>
        <th style="width: 50px;">No.</th>
        <th style="width: 150px;">Name</th>        
        <th>Created date</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach($favlist as $list)
    <?php $item = App\Models\ShopUser::getFavItem($list->tbl_data,$list->post_id); ?>
        <!-- @php
            $n = (isset($n)?$n:0);
            $n++;
            // $order = App\Models\ShopProduct::find($item->id);
        @endphp -->
    <tr>
        <td><span class="item_21_id">{{ $n }}</span></td>
        <td><span class="item_21_sku"><a href="{{ url($list->page_data.'/'.$item->alias) }}"><img src="{{ asset($item->image) }}" class="img-thumbnail"></a><a href="{{ url($list->page_data.'/'.$item->alias) }}"> {{ $item->name }} </a></span></td>        
        <td>{{ $list->create_date }}</td>
        
        
    </tr>

    

    @endforeach
    </tbody>
  </table>

@endif
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
