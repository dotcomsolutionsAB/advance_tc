@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email or Mobile</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email or Mobile" required autofocus>
                        </div>
                    
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
