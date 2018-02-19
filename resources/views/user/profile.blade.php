@extends('templates.master')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>User's Profile</h1>
        <hr>
        <h2>My Orders</h2>
        @foreach($orders as $order)   
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($order->cart->items as $item)   
                        <li class="list-group-item">
                            <span class="badge">${{ $item['item_price'] }}</span>
                            {{ $item['item_object']->title }} | {{ $item['item_qty'] }} {{ str_plural('Unit', $item['item_qty']) }}
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="panel-footer">
                <b>Total Price: ${{ $order->cart->total_price }}</b>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection