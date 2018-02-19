@extends('templates.master')

@section('content')
@if(!session('cart'))
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <h1>No items in the Cart!</h1>
    </div>
</div>
@else
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <ul class="list-group">
            @foreach($cart->items as $product)   
                <li class="list-group-item">
                    <span class="badge">{{ $product['item_qty'] }}</span>
                    <b>{{ $product['item_object']->title }}</b>&nbsp;
                    <span class="label label-success">${{ $product['item_price'] }}</span>&nbsp;
                    <div class="btn-group">
                        <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            Action<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('product.reduce_by_one', $product['item_object']->id) }}">Reduce by 1</a></li>
                            <li><a href="{{ route('product.remove_item', $product['item_object']->id) }}">Reduce All</a></li>
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>

        <span class="total-price">Total: ${{ $cart->total_price }}</span>
        
        <hr>
        
        <a href="{{ route('product.checkout') }}" class="btn btn-success">Checkout</a>
    </div>
</div>
@endif
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('css/app.css') }}"/>
@endsection