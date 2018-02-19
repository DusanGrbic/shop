@extends('templates.master')

@section('content')
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <h1>Checkout</h1>
        <h4><b>Your Total: ${{ $total }}</b></h4>
        <hr>
        
        <!-- Show errors if there are any -->
        <div class="alert alert-danger {{ !session('error') ? 'hidden' : ''  }}" id="charge-error">
            {{ session('error') }}
        </div>
        
        <form action="{{ route('product.checkout') }}" method="POST" id="ch-form">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="control-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="control-label">Card Holder Name</label>
                <input type="text" name="card_name" id="card-name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="control-label">Credit Card Number</label>
                <input type="text" name="card_number" id="card-number" class="form-control" required
                       value="4242 4242 4242 4242">
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">Card Expiry Month</label>
                        <input type="text" name="card_expiry_month" id="card-expiry-month" class="form-control" required
                               value="12">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">Card Expiry Year</label>
                        <input type="text" name="card_expiry_year" id="card-expiry-year" class="form-control" required
                               value="2020">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label">Card CVC</label>
                <input type="text" name="card_cvc" id="card-cvc" class="form-control" required
                       value="123">
            </div>
            
            <button class="btn btn-success" type="submit">Buy Now</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{ url('js/checkout.js') }}"></script>
@endsection
