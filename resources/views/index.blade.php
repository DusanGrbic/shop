@extends('templates.master')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@foreach($products->chunk(3) as $key=>$chunk)   
    <div class="row" id="{{ $key }}" >
        @foreach($chunk as $product)   
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{ $product->image_path }}" alt="{{ $product->title }}" class="img-responsive">
                    <div class="caption">
                        <h3>{{ $product->title }}</h3>
                        <p class="description">{{ $product->description }}</p>
                        <div class="clearfix">
                            <div class="pull-left price">${{ $product->price }}</div>
                            <a href="{{ route('product.add_to_cart', ['product_id' => $product->id, 'row_id' => $key]) }}" 
                               class="pull-right btn btn-success">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('css/app.css') }}"/>
@endsection
