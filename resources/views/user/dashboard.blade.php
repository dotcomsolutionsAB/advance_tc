{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Dashboard</div>

                <div class="card-body">
                    <h4>Welcome, {{ Auth::user()->username }}!</h4>
                    <p>You have limited access to the system.</p>
                    <ul>
                        <li>View Your Profile</li>
                        <li>Edit Your Information</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    <p>Your role: {{ auth()->user()->role }}</p>
                    <p>Your Email: {{ auth()->user()->email }}</p>
                    <p>Your Phone: {{ auth()->user()->mobile }}</p>
                    
                    <!-- You can add other user-specific content here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
