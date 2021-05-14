@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

                <div class="card-body">

                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action='{{ route("admin.users.store") }}' enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Name" value="{{old('name')}}">
                            @error('name')
                            <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email" value="{{old('email')}}">
                            @error('email')
                            <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <p class="alert-danger p-2 br-1s mt-2">Default password: password</p>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="role">
                                <!-- default: user -->
                                <option value="3">Role</option>
                                @foreach($roles as $singleRole)
                                <option value="{{$singleRole->id}}" {{ $singleRole->id == old('role') ? 'selected' : '' }} >{{ $singleRole->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <label id="-error" class="error" for="">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <a class="btn btn-danger mr-1" href='{{ route("admin.users.index") }}' type="submit">Cancel</a>
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection