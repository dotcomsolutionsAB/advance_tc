@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    <p>Your role: {{ auth()->user()->role }}</p>

                    <!-- Add admin-specific content here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
