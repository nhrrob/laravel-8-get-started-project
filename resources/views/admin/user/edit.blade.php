@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action='{{ route("admin.users.update", $user->id) }}' enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Name" value="{{$user->name}}">
                            @error('name')
                            <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email" value="{{$user->email}}">
                            @error('email')
                            <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="role">
                                <!-- default: user -->
                                <option value="3">Role</option>
                                @foreach($roles as $singleRole)
                                <option value="{{$singleRole->id}}" {{ $singleRole->id == optional($user->roles)[0]->id ? 'selected' : '' }}>{{ $singleRole->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="New Password" value="">
                            <p class="alert-success p-2 br-1s mt-2">Keep blank if you don't want to change</p>
                            @error('password')
                            <label class="text-danger">{{ $message }}</label>
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