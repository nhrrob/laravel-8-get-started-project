@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Role') }}</div>

                <div class="card-body">

                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action='{{ route("admin.roles.store") }}' enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Name">
                            @error('name')
                            <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <a class="btn btn-danger mr-1" href='{{ route("admin.roles.index") }}' type="submit">Cancel</a>
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection