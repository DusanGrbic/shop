@extends('templates.master')

@section('content')
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <h1>Sign In</h1>
        <br>
        
        <!-- Show signin errors if there are any -->
        @if($errors->count())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)   
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('user.signin') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label class="control-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ session('email') ? : '' }}">
            </div>
            
            <div class="form-group">
                <label class="control-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Sign In">
                <br><br>
                <p>Don't have an account? <a href="{{ route('user.signup') }}">Sign Up</a> instead</p>
            </div>
        </form>
    </div>
</div>
@endsection