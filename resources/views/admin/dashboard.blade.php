@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    <h4>Welcome, Admin!</h4>
                    <p>You have full access to the system.</p>
                    <ul>
                        <li>Manage Users</li>
                        <li>View Reports</li>
                        <li>Manage Settings</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
