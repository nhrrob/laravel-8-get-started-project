@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <h4>Welcome, {{auth()->user()->name}}!</h4>

                </div>
            </div>
        </div>
    </div>

    <div class="p-3"></div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('NHR Laravel Wiki') }}</div>

                <div class="card-body">
                    <p>A wiki for Laravel. Covers issue solutions as well as basic concepts of Laravel. Includes popular package related instructions as wll.</p>
                    <p>
                        <a class="btn btn-primary" href="https://github.com/nhrrob/laravelwiki" target="_blank">NHR Laravel Wiki</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('NHR Crud Generator') }}</div>

                <div class="card-body">
                    <p>This package provides an artisan command to generate a basic crud with Restful API support</p>
                    <p>
                        <a class="btn btn-primary" href="https://github.com/nhrrob/crudgenerator" target="_blank">NHR Crud Generator</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="p-3"></div>

        <div class="col-md-12">
            <p class="alert alert-info text-center">Browse above repositories and inspire me with a star :)</p>
        </div>
    </div>
</div>
@endsection