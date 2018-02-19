@extends('templates.master')

@section('content')
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <h1>Create Accout</h1>
        <br>
        
        <!-- show signup errors if there are any -->
        @if($errors->count())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)   
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            <br>
        @endif
        
        <form action="{{ route('user.signup') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label class="control-label">Email</label>
                <input type="email" name="email" class="form-control" required
                       value="{{ request()->old('email') ? : '' }}">
            </div>
            
            <div class="form-group">
                <label class="control-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="control-label">Repeat Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create Account">
            </div>
        </form>
    </div>
</div>
@endsection