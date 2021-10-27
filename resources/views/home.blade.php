@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="col-sm-6">
                    <div class="card">
                    <div class="card-body">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Add Customer</a>
                    </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
