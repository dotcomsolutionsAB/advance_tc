<style>
    td{
        border:2px solid black;
    }
</style>
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
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <th>id</th>
                            <th>name</th>
                            <th>type</th>
                            <th>specification</th>
                            <th>start</th>
                            <th>end</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>CARBON STEEL BW FITTINGS SCH 40 </td>
                                <td>physical</td>
                                <td>"temperature":250</td>
                                <td>"pre_start":70</td>
                                <td>"pre_end":72</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Add admin-specific content here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    new DataTable('#example', {
    responsive: true
});
</script>
